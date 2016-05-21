<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadPinturaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-pintura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PIN_ID') ?>

    <?= $form->field($model, 'EMP_RUT') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'PIN_DESCRIPCION') ?>

    <?= $form->field($model, 'PIN_HORAS') ?>

    <?php // echo $form->field($model, 'PIN_PRECIO') ?>

    <?php // echo $form->field($model, 'PIN_ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
