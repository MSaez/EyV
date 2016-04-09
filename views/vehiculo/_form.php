<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Marca;
use app\models\Modelo;


/* @var $this yii\web\View */
/* @var $model app\models\Vehiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehiculo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <!--Código para DropDown de Clientes-->
    <?= $form->field($model, 'CLI_ID')->dropDownList(
        ArrayHelper::map(Cliente::find()->all(),'CLI_ID','nombreCompleto'),
        ['prompt' => 'Seleccione un cliente']
    ) ?>
    
    <!--Código para DropDown de Marcas-->
    <?= $form->field($model, 'MAR_ID')->dropDownList(
        ArrayHelper::map(Marca::find()->all(),'MAR_ID','MAR_NOMBRE'),
        ['prompt' => 'Seleccione una marca',
         'onchange' => '
                $.post( "index.php?r=modelo/list&id='.'"+$(this).val(), function( data) {
                    $( "select#vehiculo-mod_id" ).html( data );
                });']
    ) ?>

    <!--Código para DropDown de Modelos-->
    <?= $form->field($model, 'MOD_ID')->dropDownList(
        ArrayHelper::map(Modelo::find()->all(),'MOD_ID','MOD_NOMBRE'),
        ['prompt' => 'Seleccione un modelo']
    ) ?>

    <?= $form->field($model, 'VEH_ANIO')->textInput() ?>

    <?= $form->field($model, 'VEH_CHASIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VEH_MOTOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VEH_COLOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VEH_PATENTE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
