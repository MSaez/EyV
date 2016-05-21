<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadDesabolladuraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-desabolladura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DES_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'EMP_RUT') ?>

    <?= $form->field($model, 'DES_DESCRIPCION') ?>

    <?= $form->field($model, 'DES_HORAS') ?>

    <?php // echo $form->field($model, 'DES_PRECIO') ?>

    <?php // echo $form->field($model, 'DES_ESTADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
