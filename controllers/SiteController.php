<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Functions;

use yii\httpclient\Client;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTesting()
    {
        $data = Functions::csv_to_array('files/CLARO05.csv');
        echo json_encode($data);
    }

    public function actionApiClient() {
        $client = new Client([
            // 'baseUrl' => 'https://10.38.96.56:8443/restAPI/online_report'
            // 'baseUrl' => 'https://claroprod946.clarochile.org:8443/restAPI/online_report'
            'transport' => 'yii\httpclient\CurlTransport'
        ]);

        $request = $client->createRequest()
        ->setMethod('post')
        // ->setUrl('https://10.38.96.56:8443/restAPI/online_report')
        ->setUrl('https://10.41.1.49:8443/restAPI/online_report')
        ->setHeaders(['Authorization' => 'Bearer 8d45e052-6727-4d5f-a1e6-7c9f22e51434'])
        ->setOptions([
            // 'ssl' . Inflector::underscore
            // 'sslVerifyPeer' => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT => 0,
            // 'sslCafile' => Yii::$app->basePath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Guardium.crt',
        ])
        ->setContent('{"indexFrom":"1","fetchSize":"30000","reportName":"Informe - Accesos detallados","reportParameter":
{"QUERY_FROM_DATE":"2017-11-22 00:00:00","QUERY_TO_DATE":"2017-11-30 00:00:00","SHOW_ALIASES":"TRUE","REMOTE_SOURCE":"claroprod109.clarochile.org","s1":"%","u1":"%","c1":"%","v1":"%","o1":"%table_user%","full_sql":"%13834987%"}}');
        /*$request = $client->createRequest()
        ->setMethod('post')
        ->setUrl('https://10.41.1.49:8443/oauth/token')
        // ->setUrl('https://10.38.96.56:8443/oauth/token')
        // ->setHeaders(['Authorization' => 'Bearer ee8f7268-1479-4442-b778-bffe5d451a53'])
        ->setOptions([
            // 'ssl' . Inflector::underscore
            // 'sslVerifyPeer' => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            // 'sslCafile' => Yii::$app->basePath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Guardium.crt',
        ])
        ->setData(["username" => "admin",
            "password" => "Claro.2017",
            "client_id" => "insighti2",
            "client_secret" => "76953ee3-5bbf-4e83-b5a3-5a583ca79b88",
            "grant_type" => "password"
        ]);*/

        $result = $request->send()->data;
        echo json_encode($result);
        /*$client = new Client();
        // $response = $client->get('api', ['results' => 500]);
        echo json_encode($client->createRequest()->setUrl('https://randomuser.me/api')->setMethod('get')->send()->getData());*/
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
