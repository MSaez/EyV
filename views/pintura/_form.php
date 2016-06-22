<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadPintura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-pintura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PIN_ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
