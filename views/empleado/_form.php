<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EMP_RUT')->textInput(['data-rut' => 'true', 'maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_NOMBRES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_PATERNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_MATERNO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
