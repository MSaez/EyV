<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Insumo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insumo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OT_ID')->textInput() ?>

    <?= $form->field($model, 'PINS_ID')->textInput() ?>

    <?= $form->field($model, 'INS_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'INS_CANTIDAD')->textInput() ?>

    <?= $form->field($model, 'INS_PRECIO_UNITARIO')->textInput() ?>

    <?= $form->field($model, 'INS_TOTAL')->textInput() ?>

    <?= $form->field($model, 'INS_RECIBIDO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
