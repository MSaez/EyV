<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VehiculoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehiculo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'VEH_ID') ?>

    <?= $form->field($model, 'MAR_ID') ?>

    <?= $form->field($model, 'MOD_ID') ?>

    <?= $form->field($model, 'CLI_ID') ?>

    <?= $form->field($model, 'VEH_ANIO') ?>

    <?php // echo $form->field($model, 'VEH_CHASIS') ?>

    <?php // echo $form->field($model, 'VEH_MOTOR') ?>

    <?php // echo $form->field($model, 'VEH_COLOR') ?>

    <?php // echo $form->field($model, 'VEH_PATENTE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
