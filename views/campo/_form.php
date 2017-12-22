<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Campo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'nombre_parametro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etiqueta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_reporte')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>