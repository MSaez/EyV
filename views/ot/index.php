<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Vehiculo;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordenes de Trabajo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'OT_ID',
            [
                'attribute' => 'VEH_ID', 
                'value' => 'vEH.VEH_PATENTE',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'VEH_ID',
                    'data' => ArrayHelper::map(Vehiculo::find()->all(),'VEH_ID','VEH_PATENTE'),
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'hideSearch' => false,
                    'options' => [
                        'placeholder' => 'Seleccione un Vehiculo...',
                    ],
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],
            [
                'attribute' => 'CLI_ID', 
                'value' => 'cLI.nombreCompleto',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'CLI_ID',
                    'data' => ArrayHelper::map(Cliente::find()->all(),'CLI_ID','nombreCompleto'),
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'hideSearch' => false,
                    'options' => [
                        'placeholder' => 'Seleccione un Cliente...',
                    ],
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],
            [
                'attribute' => 'OT_INICIO',
                'value' => 'OT_INICIO',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'OT_INICIO',
                    'type' => DatePicker::TYPE_INPUT,
                    'language' => 'es',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
                    'options' => ['placeholder' => 'Fecha de Inicio ...'],
                ]),
            ],
           [
                'attribute' => 'OT_ENTREGA',
                'value' => 'OT_ENTREGA',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'OT_ENTREGA',
                    'type' => DatePicker::TYPE_INPUT,
                    'language' => 'es',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
                    'options' => ['placeholder' => 'Fecha de Entrega ...'],
                ]),
            ],
            // 'OT_OBSERVACIONES:ntext',
            // 'OT_SUBTOTAL',
            // 'OT_IVA',
            'OT_TOTAL',
            // 'OT_TOTAL_HORAS',
            [
                'attribute' => 'OT_ESTADO',
                'value' => 'OT_ESTADO',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'OT_ESTADO',
                    'data' => ['Pendiente' => 'Pendiente',
                               'Ejecutando' => 'En ejecución',
                               'Terminado' => 'Terminado',
                               'Cancelado' => 'Cancelado',
                               'Despachado' => 'Despachado',],                               
                    'options' => ['placeholder' => 'Seleccione un Estado...',],
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'hideSearch' => false,
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],
            ['class' => '\kartik\grid\ActionColumn',
             'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
