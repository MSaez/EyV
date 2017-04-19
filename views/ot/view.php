<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = 'Orden de Trabajo cód. : '.$model->OT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<!-- Codigo modal -->

<?php
    Modal::begin([
    'options' => [
        'id' => 'modal-asignar-desabolladura',
        'tabindex' => false // important for Select2 to work properly
    ],
    'header' => '<h2>Asignar Trabajador</h2>']);
    Modal::end();
?>
<?php
    Modal::begin([
    'options' => [
        'id' => 'modal-estado-desabolladura',
        
    ],
    'header' => '<h2>Actualizar Estado</h2>']);
    Modal::end();
?>
<?php
    Modal::begin([
    'options' => [
        'id' => 'modal-asignados-desabolladura',
        
    ],
    'header' => '<h2>Listado de Trabajadores Asignados</h2>']);
    Modal::end();
?>
<?php
    Modal::begin([
    'options' => [
        'id' => 'modal-asignar-pintura',
        'tabindex' => false // important for Select2 to work properly
    ],
    'header' => '<h2>Asignar Trabajador</h2>']);
    Modal::end();
?>
<?php
    Modal::begin([
    'options' => [
        'id' => 'modal-estado-pintura',
        
    ],
    'header' => '<h2>Actualizar Estado</h2>']);
    Modal::end();
?>
<?php
    Modal::begin([
    'options' => [
        'id' => 'modal-asignados-pintura',
        
    ],
    'header' => '<h2>Listado de Trabajadores Asignados</h2>']);
    Modal::end();
?>
<!-- ------------ -->

<div class="ot-view">
        
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar', ['update', 'id' => $model->OT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Generar Orden de Compra', ['genordencompra', 'id' => $model->OT_ID], ['class' => 'btn btn-primary']) ?>

    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'OT_ID',
            'OD_ID',
            'CBR_ID',
            [                      
                'label' => 'Vehículo', 
                'value' => $model->vEH->VEH_PATENTE,
            ],
            [                      
                'label' => 'Cliente', 
                'value' => $model->cLI->CLI_NOMBRES.' '.$model->cLI->CLI_PATERNO.' '.$model->cLI->CLI_MATERNO,
            ],
            'OT_INICIO',
            'OT_ENTREGA',
            'OT_OBSERVACIONES:ntext',
            'OT_ESTADO',
            'OT_SUBTOTAL',
            'OT_IVA',
            'OT_TOTAL',
            'OT_TOTAL_HORAS',
        ],
    ]) ?>
    
    <h1>Actividades de desabolladura</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProviderDesabolladura,
            //'filterModel' => $searchModel,
            'columns' => [

                 //['class' => 'yii\grid\SerialColumn'],
                'DES_ID',
                'DES_DESCRIPCION',
                'DES_HORAS',
                'DES_PRECIO',
                'DES_ESTADO',
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'template' => '{asignarTrabajadorDes}{mostrarTrabajadoresDes}{actualizarEstadoDes} ',
                    'buttons' => [
                    'asignarTrabajadorDes' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Asignar Trabajador','id' => 'popupModal-asignar-desabolladura']; 
                                                    $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['desabolladura/asignartrabajador','id'=>$model->DES_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'mostrarTrabajadoresDes' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Ver Trabajadores', 'id' => 'popupModal-asignados-desabolladura']; 
                                                    $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['desabolladura/vertrabajadores','id'=>$model->DES_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'actualizarEstadoDes' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Actualizar Estado', 'id' => 'popupModal-estado-desabolladura']; 
                                                    $icon = '<span class="glyphicon glyphicon-refresh"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['desabolladura/actualizarestado','id'=>$model->DES_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    ]
                ]

            ],
            

        ]); ?>
   <?php Pjax::end(); ?>
    
    <h1>Actividades de pintura</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProviderPintura,
            //'filterModel' => $searchModel,
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'PIN_ID',
                'PIN_DESCRIPCION',
                'PIN_HORAS',
                'PIN_PRECIO',
                'PIN_ESTADO',
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'template' => '{asignarTrabajadorPin}{mostrarTrabajadoresPin}{actualizarEstadoPin} ',
                    'buttons' => [
                    'asignarTrabajadorPin' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Asignar Trabajador', 'id' => 'popupModal-asignar-pintura'];
                                                    $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['pintura/asignartrabajador','id'=>$model->PIN_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'mostrarTrabajadoresPin' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Ver Trabajadores', 'id' => 'popupModal-asignados-pintura']; 
                                                    $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['pintura/vertrabajadores','id'=>$model->PIN_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'actualizarEstadoPin' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Actualizar Estado', 'id' => 'popupModal-estado-pintura']; 
                                                    $icon = '<span class="glyphicon glyphicon-refresh"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['pintura/actualizarestado','id'=>$model->PIN_ID]);
                                                    return Html::a($label, $url, $options);
                                      }
                    ]
                ]

            ],
            

        ]); ?>
   <?php Pjax::end(); ?>
    
    <h1>Insumos</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProviderInsumo,
            //'filterModel' => $searchModel,
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'INS_NOMBRE',
                'INS_CANTIDAD',
                'INS_PRECIO_UNITARIO',
                'INS_TOTAL',
            ],

        ]); ?>
   <?php Pjax::end(); ?>
    
    <h1>Servicios Externos</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProviderServicios,
            //'filterModel' => $searchModel,
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'OS_DESCRIPCION:text',
                'OS_PRECIO',
            ],

        ]); ?>
   <?php Pjax::end(); ?>

</div>

<?php $this->registerJs("$(function() {
   $('#popupModal-asignar-desabolladura').click(function(e) {
     e.preventDefault();
     $('#modal-asignar-desabolladura').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>

<?php $this->registerJs("$(function() {
   $('#popupModal-estado-desabolladura').click(function(e) {
     e.preventDefault();
     $('#modal-estado-desabolladura').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>
<?php $this->registerJs("$(function() {
   $('#popupModal-asignados-desabolladura').click(function(e) {
     e.preventDefault();
     $('#modal-asignados-desabolladura').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>
<?php $this->registerJs("$(function() {
   $('#popupModal-asignar-pintura').click(function(e) {
     e.preventDefault();
     $('#modal-asignar-pintura').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>

<?php $this->registerJs("$(function() {
   $('#popupModal-estado-pintura').click(function(e) {
     e.preventDefault();
     $('#modal-estado-pintura').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>
<?php $this->registerJs("$(function() {
   $('#popupModal-asignados-pintura').click(function(e) {
     e.preventDefault();
     $('#modal-asignados-pintura').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>