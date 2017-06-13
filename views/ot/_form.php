<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Cliente;
use app\models\Vehiculo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('@web/js/ot.js');

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
    
    <?= $form->field($model, 'OT_INICIO')->widget(DatePicker::classname(), [
            'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
            'options' => ['class' => 'form-control', 'style' => 'width:25%',]
    ]) ?>
    
    <?= $form->field($model, 'OT_ENTREGA')->widget(DatePicker::classname(), [
            'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
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
        'limit' => 999, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item_desabolladura', // css class
        'deleteButton' => '.remove-item_desabolladura', // css class
        'model' => $modelsDesabolladura[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'DES_DESCRIPCION',
            'DES_HORAS',
            'DES_PRECIO',
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
                            <div class="col-sm-6">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_DESCRIPCION")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_HORAS")->textInput(['maxlength' => true, 'onkeyup' => 'sumar_total_horas_desabolladura();total_horas();', 'onclick' => 'sumar_total_horas_desabolladura();total_horas();']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_PRECIO")->textInput(['maxlength' => true, 'onkeyup'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();',
																																																		 											 'onclick'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();']) ?>
                            </div>
                        </div><!-- .row -->    
                        <?php
                            if (! $modelDesabolladura->isNewRecord) {
                                echo Html::activeHiddenInput($modelDesabolladura, "[{$i}]DES_ESTADO");
                            }
                        ?>
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
        'limit' => 999, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item_pintura', // css class
        'deleteButton' => '.remove-item_pintura', // css class
        'model' => $modelsPintura[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'PIN_DESCRIPCION',
            'PIN_HORAS',
            'PIN_PRECIO',
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
                            <div class="col-sm-6">
                                <?= $form->field($modelPintura, "[{$i}]PIN_DESCRIPCION")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelPintura, "[{$i}]PIN_HORAS")->textInput(['maxlength' => true, 'onkeyup' => 'sumar_total_horas_pintura(),total_horas();',
																																																										'onclick' => 'sumar_total_horas_pintura(),total_horas();']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPintura, "[{$i}]PIN_PRECIO")->textInput(['maxlength' => true, 'onkeyup'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();',
																																															 											  'onclick'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();']) ?>
                            </div>                            
                        </div><!-- .row -->
                        <?php
                            if (! $modelPintura->isNewRecord) {
                                echo Html::activeHiddenInput($modelPintura, "[{$i}]PIN_ESTADO");
                            }
                        ?>
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
        'limit' => 999, // the maximum times, an element can be added (default 999)
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
                                <?= $form->field($modelInsumo, "[{$i}]INS_CANTIDAD")->textInput(['maxlength' => true,
                                                                                                        'onkeyup'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();',
																																																 				'onclick'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();'
                                                                                                       ]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelInsumo, "[{$i}]INS_PRECIO_UNITARIO")->textInput(['maxlength' => true,
                                                                                                        'onkeyup'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();',
																																																				'onclick'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();'
                                                                                                       ]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelInsumo, "[{$i}]INS_TOTAL")->textInput(['maxlength' => true,
                                                                                              'style' => 'text-align: right']) ?>
                            </div>
                            <?php
                            if (! $modelInsumo->isNewRecord) {
                                echo Html::activeHiddenInput($modelInsumo, "[{$i}]INS_REUTILIZADO");
                            }
                            else{
                                echo Html::activeHiddenInput($modelInsumo, "[{$i}]INS_REUTILIZADO", ['value' => 0]);
                            }
                            ?>
                                                        
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
        'limit' => 999, // the maximum times, an element can be added (default 999)
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
                                <?= $form->field($modelServicio, "[{$i}]OS_PRECIO")->textInput(['maxlength' => true, 'onkeyup'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();',
																																															 												'onclick'=>'sumar_total_desabolladura();sumar_total_pintura();sumar_total_insumos();sumar_total_servicio();calcular_subtotal();calcular_iva();calcular_total();']) ?>
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-usd"></i> Totales</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TDESABOLLADURA')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TPINTURA')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TINSUMO')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TEXTERNO')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TREUTILIZADO')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_SUBTOTAL')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_IVA')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TOTAL')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'OT_TOTAL_HORAS')->textInput(['size' => 8, 'value' => '0']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

