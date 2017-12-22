<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Credencial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credencial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contrasena')->passwordInput(['maxlength' => true, 'value' => '']) ?>

    <div class="form-group">
        <!-- <p class="text-center"> -->
          <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="<?= Yii::$app->request->baseUrl ?>" class="btn btn-danger">Regresar</a>
        <!-- </p> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
