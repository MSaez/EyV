<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoExternosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-externos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PEXT_ID') ?>

    <?= $form->field($model, 'OS_ID') ?>

    <?= $form->field($model, 'PEXT_FACTURA') ?>

    <?= $form->field($model, 'PEXT_VALOR') ?>

    <?= $form->field($model, 'PEXT_FECHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
