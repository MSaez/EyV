<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */



$this->registerJsFile('@web/js/rut-cliente.js');
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CLI_RUT')->textInput(['data-rut' => 'true', 'maxlength' => 12, 'onkeyup' => 'verifica_rut();', 'onclick' => 'verifica_rut();']) ?>    
    
    <?= $form->field($model, 'CLI_NOMBRES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CLI_PATERNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CLI_MATERNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CLI_TELEFONO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CLI_DIRECCION')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    

</div>
