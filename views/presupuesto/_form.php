<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\models\Cliente;
use app\models\Vehiculo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */
/* @var $form yii\widgets\ActiveForm */
$JS_DESABOLLADURA = 'function sumar_total_desabolladura(){

	id = 0;
	suma = 0;
	existe = true;
	while(existe){

		var idFull = "actividaddesabolladura-"+id+"-des_precio";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!=""){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_subtotal").value=suma;

}';

$JS_PINTURA = 'function sumar_total_pintura(){

	id = 0;
	suma = 0;
	existe = true;
	while(existe){

		var idFull = "actividadpintura-"+id+"-pin_precio";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!=""){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_subtotal").value=suma;

}';

$JS_INSUMOS = 'function sumar_total_insumos(){

	id = 0;
	suma = 0;
	ptotal = 0;
	existe = true;
	while(existe){

		var idPrecio = "insumo-"+id+"-ins_precio_unitario";
		var idCantidad = "insumo-"+id+"-ins_cantidad";
		var idTotal = "insumo-"+id+"-ins_total";
		try{campo = document.getElementById(idPrecio);
			if(document.getElementById(idPrecio).value!="" && document.getElementById(idCantidad).value!=""){
				ptotal = parseInt(document.getElementById(idPrecio).value) * parseInt(document.getElementById(idCantidad).value)
				document.getElementById(idTotal).value=ptotal;
				suma = suma + ptotal;
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_subtotal").value=suma;

}';

$JS_SERVICIOS = 'function sumar_total_servicio(){

	id = 0;
	suma = 0;
	existe = true;
	while(existe){

		var idFull = "otrosservicios-"+id+"-os_precio";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!=""){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_subtotal").value=suma;

}';

$JS_IVA = 'function calcular_iva(){
                iva = 0;
                iva = parseInt(document.getElementById("ot-ot_subtotal").value) * 0.19;
                document.getElementById("ot-ot_iva").value=iva;
}';

$JS_TOTAL = 'function calcular_total(){
                total = 0;
                total = parseInt(document.getElementById("ot-ot_subtotal").value) + parseInt(document.getElementById("ot-ot_iva").value=iva);
                console.log(total);
                document.getElementById("ot-ot_total").value=total;
}';



$this->registerJs($JS_DESABOLLADURA, \yii\web\VIEW::POS_HEAD);
$this->registerJs($JS_IVA, \yii\web\VIEW::POS_HEAD);
$this->registerJs($JS_TOTAL, \yii\web\VIEW::POS_HEAD);

?>

<div class="ot-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'CLI_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Cliente::find()->all(),'CLI_ID','nombreCompleto'),
        'options' => ['placeholder' => 'Seleccione un Cliente ...',
                      'onchange' => '
                            $.post( "index.php?r=vehiculo/list&id='.'"+$(this).val(), function( data) {
                            $( "select#ot-veh_id" ).html( data );
                      });'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'VEH_ID')->dropDownList(
        ArrayHelper::map(Vehiculo::find()->all(),'VEH_ID','VEH_PATENTE'),
        ['prompt' => 'Seleccione un vehículo']
    ) ?>
    
    <?= $form->field($model, 'OT_INICIO')->widget(\yii\jui\DatePicker::classname(), [
            //'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'style' => 'width:25%',]
    ]) ?>
    
    <?= $form->field($model, 'OT_ENTREGA')->widget(\yii\jui\DatePicker::classname(), [
            //'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'style' => 'width:25%']
    ]) ?>
    
    <?= $form->field($model, 'OT_ESTADO')->dropDownList(['Presupuesto' => 'Presupuesto',
                                                         'Pendiente' => 'Pendiente',
                                                         'OT' => 'En ejecución',
                                                         'Terminado' => 'Terminado',
                                                         'Cancelado' => 'Cancelado'],['prompt'=>'Seleccione un estado']); ?>

    <?= $form->field($model, 'OT_OBSERVACIONES')->textarea(['rows' => 6]) ?>
    
        
    <!-- codigo definitivo -->
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_desabolladura', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items_desabolladura', // required: css class selector
        'widgetItem' => '.item_desabolladura', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item_desabolladura', // css class
        'deleteButton' => '.remove-item_desabolladura', // css class
        'model' => $modelsDesabolladura[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'DES_DESCRIPCION',
            'DES_HORAS',
            'DES_PRECIO',
            'DES_ESTADO',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-cog"></i> Actividades de Desabolladura
                <button type="button" class="add-item_desabolladura btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items_desabolladura"><!-- widgetBody -->
             <?php foreach ($modelsDesabolladura as $i => $modelDesabolladura): ?>
                <div class="item_desabolladura panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Actividad</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item_desabolladura btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelDesabolladura->isNewRecord) {
                                echo Html::activeHiddenInput($modelDesabolladura, "[{$i}]DES_ID");
                            }
                        ?>
                                     
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_DESCRIPCION")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_HORAS")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_PRECIO")->textInput(['maxlength' => true, 'onBlur'=>'sumar_total_desabolladura();calcular_iva();calcular_total();']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_ESTADO")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->    
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
    <!-- fin codigo -->

    
    <!-- codigo definitivo -->
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_pintura', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items_pintura', // required: css class selector
        'widgetItem' => '.item_pintura', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item_pintura', // css class
        'deleteButton' => '.remove-item_pintura', // css class
        'model' => $modelsPintura[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'PIN_DESCRIPCION',
            'PIN_HORAS',
            'PIN_PRECIO',
            'PIN_ESTADO',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-cog"></i> Actividades de Pintura
                <button type="button" class="add-item_pintura btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items_pintura"><!-- widgetBody -->
             <?php foreach ($modelsPintura as $i => $modelPintura): ?>
                <div class="item_pintura panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Actividad</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item_pintura btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelPintura->isNewRecord) {
                                echo Html::activeHiddenInput($modelPintura, "[{$i}]PIN_ID");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelPintura, "[{$i}]PIN_DESCRIPCION")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelPintura, "[{$i}]PIN_HORAS")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPintura, "[{$i}]PIN_PRECIO")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPintura, "[{$i}]PIN_ESTADO")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
    <!-- fin codigo -->
    
    <!-- codigo definitivo -->
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_insumo', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items_insumo', // required: css class selector
        'widgetItem' => '.item_insumo', // required: css class
        'limit' => 99, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item_insumo', // css class
        'deleteButton' => '.remove-item_insumo', // css class
        'model' => $modelsInsumo[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'INS_NOMBRE',
            'INS_CANTIDAD',
            'INS_PRECIO_UNITARIO',
            'INS_TOTAL',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-cog"></i> Insumos
                <button type="button" class="add-item_insumo btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items_insumo"><!-- widgetBody -->
             <?php foreach ($modelsInsumo as $i => $modelInsumo): ?>
                <div class="item_insumo panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Actividad</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item_insumo btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelInsumo->isNewRecord) {
                                echo Html::activeHiddenInput($modelInsumo, "[{$i}]INS_ID");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($modelInsumo, "[{$i}]INS_NOMBRE")->textInput(['maxlength' => true]) ?>
                            </div>    
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelInsumo, "[{$i}]INS_CANTIDAD")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelInsumo, "[{$i}]INS_PRECIO_UNITARIO")->textInput(['maxlength' => true,
                                                                                                        ]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelInsumo, "[{$i}]INS_TOTAL")->textInput(['maxlength' => true,
                                                                                              'style' => 'text-align: right']) ?>
                            </div>
                                                        
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
    <!-- fin codigo -->
    
    <!-- codigo definitivo -->
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_servicio', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items_servicio', // required: css class selector
        'widgetItem' => '.item_servicio', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item_servicio', // css class
        'deleteButton' => '.remove-item_servicio', // css class
        'model' => $modelsServicios[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'OS_DESCRIPCION',
            'OS_PRECIO',            
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-cog"></i> Servicios Externos
                <button type="button" class="add-item_servicio btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Añadir</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items_servicio"><!-- widgetBody -->
             <?php foreach ($modelsServicios as $i => $modelServicio): ?>
                <div class="item_servicio panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Servicio</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item_servicio btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelServicio->isNewRecord) {
                                echo Html::activeHiddenInput($modelServicio, "[{$i}]OS_ID");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-10">
                                <?= $form->field($modelServicio, "[{$i}]OS_DESCRIPCION")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelServicio, "[{$i}]OS_PRECIO")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
    <!-- fin codigo -->
    
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'OT_SUBTOTAL')->textInput(['size' => 8, 'value' => '0']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'OT_IVA')->textInput(['size' => 8, 'value' => '0']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'OT_TOTAL')->textInput(['size' => 8, 'value' => '0']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'OT_TOTAL_HORAS')->textInput(['size' => 8, 'value' => '0']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

