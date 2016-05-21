<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadDesabolladura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-desabolladura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OT_ID')->textInput() ?>

    <?= $form->field($model, 'EMP_RUT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DES_DESCRIPCION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'DES_HORAS')->textInput() ?>

    <?= $form->field($model, 'DES_PRECIO')->textInput() ?>

    <?= $form->field($model, 'DES_ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
