<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadPintura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-pintura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EMP_RUT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OT_ID')->textInput() ?>

    <?= $form->field($model, 'PIN_DESCRIPCION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PIN_HORAS')->textInput() ?>

    <?= $form->field($model, 'PIN_PRECIO')->textInput() ?>

    <?= $form->field($model, 'PIN_ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
