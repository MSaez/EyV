<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'US_USERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_RUT')->textInput(['data-rut' => 'true', 'maxlength' => true]) ?>

    <?= $form->field($model, 'US_NOMBRES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_PATERNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_MATERNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'US_PASSWORD')->textInput(['maxlength' => true]) ?>
    
    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
