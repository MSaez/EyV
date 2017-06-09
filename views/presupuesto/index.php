<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Vehiculo;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\PresupuestoSearch */ 

$this->title = 'Presupuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo Presupuesto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
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
                    ]
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
                    ]
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
            'OT_TOTAL_HORAS',
            ['class' => '\kartik\grid\ActionColumn',
            'buttons' => [
                'confirmar' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ', ['presupuesto/confirmar','id'=>$model->OT_ID], ['title' => 'Confirmar Presupuesto']);
                },
            ],
            'template' => '{update} {view} {confirmar}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>





