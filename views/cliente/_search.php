<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CLI_ID') ?>

    <?= $form->field($model, 'CLI_NOMBRES') ?>

    <?= $form->field($model, 'CLI_PATERNO') ?>

    <?= $form->field($model, 'CLI_MATERNO') ?>

    <?= $form->field($model, 'CLI_RUT') ?>

    <?php // echo $form->field($model, 'CLI_TELEFONO') ?>

    <?php // echo $form->field($model, 'CLI_DIRECCION') ?>

    <?php // echo $form->field($model, 'CLI_IND_CONDUCTA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
