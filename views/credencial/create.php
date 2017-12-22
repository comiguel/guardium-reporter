<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Credencial */

$this->title = 'Create Credencial';
$this->params['breadcrumbs'][] = ['label' => 'Credencials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credencial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
