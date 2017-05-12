<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoInsumos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-insumos-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>
    
    <?= $form->field($model, 'PINS_FACTURA')->textInput() ?>

    <?= $form->field($model, 'PINS_VALOR')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
