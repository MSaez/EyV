<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Inventario;

/* @var $this yii\web\View */
/* @var $model app\models\Insumo */
/* @var $form yii\widgets\ActiveForm */

$JS = 'function obtenerTotal(){
	total = 0;
	total = parseInt(document.getElementById("insumo-ins_cantidad").value) * parseInt(document.getElementById("insumo-ins_precio_unitario").value)
	document.getElementById("insumo-ins_total").value=total;
}';

$this->registerJs($JS, \yii\web\VIEW::POS_HEAD);
?>

<div class="insumo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>
    
    <?= $form->field($model, 'inventario_id')->label("Insumo en Bodega")->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Inventario::find()->all(),'INV_ID','itemCantidad'),
        'options' =>   ['placeholder' => 'Seleccione un Insumo ...',
                        'onchange' => '
                            $.post( "index.php?r=inventario/unitario&id='.'"+$(this).val(), function( data) {
                            $( "input#insumo-ins_precio_unitario" ).val( data );
                        });
                        
                        $.post( "index.php?r=inventario/nombre&id='.'"+$(this).val(), function( data) {
                            $( "input#insumo-ins_nombre" ).val( data );
                        });'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>
    
    <?php Yii::$app->session->set('inventario_id', $model->inventario_id); ?>
    
    <?= $form->field($model, 'INS_NOMBRE')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'INS_CANTIDAD')->label("Cantidad a Retirar")->textInput(['onkeyup' => 'obtenerTotal();']) ?>

    <?= $form->field($model, 'INS_PRECIO_UNITARIO')->textInput(['readonly' => true, 'value' => 0]) ?>

    <?= $form->field($model, 'INS_TOTAL')->label("Valor Retiro")->textInput(['readonly' => true, 'value' => 0]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
