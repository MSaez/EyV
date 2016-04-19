<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ot-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'VEH_ID')->textInput() ?>

    <?= $form->field($model, 'CLI_ID')->textInput() ?>

    <?= $form->field($model, 'OT_INICIO')->textInput() ?>

    <?= $form->field($model, 'OT_ENTREGA')->textInput() ?>
    
    <?= $form->field($model, 'OT_OBSERVACIONES')->textarea(['rows' => 6]) ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'OT_SUBTOTAL')->textInput(['size' => 8]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'OT_IVA')->textInput(['size' => 8]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'OT_TOTAL')->textInput(['size' => 8]) ?>
        </div>
    </div>
    <?= $form->field($model, 'OT_TOTAL_HORAS')->textInput() ?>

    
    <!-- codigo definitivo -->
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsDesabolladura[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'EMP_RUT',
            'DES_DESCRIPCION',
            'DES_HORAS',
            'DES_PRECIO',
            'DES_ESTADO',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-envelope"></i> Addresses
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
             <?php foreach ($modelsDesabolladura as $i => $modelDesabolladura): ?>
                <div class="item panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Address</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelDesabolladura->isNewRecord) {
                                echo Html::activeHiddenInput($modelDesabolladura, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($modelDesabolladura, "[{$i}]EMP_RUT")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_DESCRIPCION")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_HORAS")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelDesabolladura, "[{$i}]DES_PRECIO")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
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


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

