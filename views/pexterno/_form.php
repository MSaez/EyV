<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoExternos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-externos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
    
    <?= $form->field($model, 'PEXT_FACTURA')->textInput() ?>

    <?= $form->field($model, 'PEXT_VALOR')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
