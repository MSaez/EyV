<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InsumoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insumo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'INS_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'PINS_ID') ?>

    <?= $form->field($model, 'INV_ID') ?>

    <?= $form->field($model, 'INS_NOMBRE') ?>

    <?php // echo $form->field($model, 'INS_CANTIDAD') ?>

    <?php // echo $form->field($model, 'INS_PRECIO_UNITARIO') ?>

    <?php // echo $form->field($model, 'INS_TOTAL') ?>

    <?php // echo $form->field($model, 'INS_RECIBIDO') ?>

    <?php // echo $form->field($model, 'INS_REUTILIZADO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
