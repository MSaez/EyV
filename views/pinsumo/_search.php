<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoInsumosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-insumos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PINS_ID') ?>

    <?= $form->field($model, 'INS_ID') ?>

    <?= $form->field($model, 'PINS_FACTURA') ?>

    <?= $form->field($model, 'PINS_VALOR') ?>

    <?= $form->field($model, 'PINS_FECHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
