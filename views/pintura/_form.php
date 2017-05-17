<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

?>

<?php
    $this->title = 'Actualizar Estado';
    $this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['/ot/index']];
    $this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajo Folio: '.$model->OT_ID, 'url' => ['ot/view', 'id' => $model->OT_ID]];
    $this->params['breadcrumbs'][] = 'Actualizar Estado';
?>
<h1>Actualizar estado actividad: <?= $model->PIN_DESCRIPCION ?></h1>
<div class="actividad-pintura-form">

    <?php $form = ActiveForm::begin(); ?>
   
    <?= $form->field($model, 'PIN_ESTADO')->widget(Select2::classname(), [
        'data' => ['Pendiente' => 'Pendiente',
                   'Ejecutando' => 'En ejecución',
                   'Terminado' => 'Terminado',
                   'Cancelado' => 'Cancelado'],
        'options' => ['placeholder' => 'Seleccione un estado...',],
        'pluginOptions' => ['allowClear' => true],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
