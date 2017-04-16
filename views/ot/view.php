<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = 'Orden de Trabajo cód. : '.$model->OT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
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
                                                    $options = ['title' => 'Asignar Trabajador']; 
                                                    $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['desabolladura/asignartrabajador','id'=>$model->DES_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'mostrarTrabajadoresDes' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Ver Trabajadores']; 
                                                    $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['desabolladura/vertrabajadores','id'=>$model->DES_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'actualizarEstadoDes' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Actualizar Estado']; 
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
                                                    $options = ['title' => 'Asignar Trabajador'];
                                                    $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['pintura/asignartrabajador','id'=>$model->PIN_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'mostrarTrabajadoresPin' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Ver Trabajadores']; 
                                                    $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['pintura/vertrabajadores','id'=>$model->PIN_ID]);
                                                    return Html::a($label, $url, $options);
                                      },
                    'actualizarEstadoPin' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Actualizar Estado']; 
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
