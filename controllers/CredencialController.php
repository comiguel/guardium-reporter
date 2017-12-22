<?php

namespace app\controllers;

use Yii;
use app\models\Credencial;
use app\models\CredencialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Functions;

/**
 * CredencialController implements the CRUD actions for Credencial model.
 */
class CredencialController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Credencial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CredencialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Credencial model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Credencial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Credencial();
        $model->scenario = 'creando';
        if ($model->load(Yii::$app->request->post())) {
          // $model->usuario = Functions::encrypt_decrypt('encrypt', $model->usuario, $model->id);
          $model->contrasena = Functions::encrypt_decrypt('encrypt', $model->contrasena, $model->id);
          if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
          }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Credencial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'actualizando';
        $usuario = $model->usuario;
        $contrasena = $model->contrasena;
        if ($model->load(Yii::$app->request->post())) {
          // if($usuario !== Functions::encrypt_decrypt('encrypt', $model->usuario, $model->id) && $model->usuario !== $usuario){
          //   $model->usuario = Functions::encrypt_decrypt('encrypt', $model->usuario, $model->id);
          // }else{
          //   $model->usuario = $usuario;
          // }
          if($contrasena !== Functions::encrypt_decrypt('encrypt', $model->contrasena, $model->id) && $model->contrasena !== $contrasena && $model->contrasena !== ''){
            $model->contrasena = Functions::encrypt_decrypt('encrypt', $model->contrasena, $model->id);
          }else{
            $model->contrasena = $contrasena;
          }
          if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
          }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Credencial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Credencial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Credencial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Credencial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
