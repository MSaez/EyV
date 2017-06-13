<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagoInsumosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pago de Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-insumos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Folio OT',
                'value' => 'iNS.OT_ID',
                
            ],
            [
                'attribute' => 'Insumo',
                'value' => 'iNS.INS_NOMBRE',
            ],
            'PINS_FACTURA',
            'PINS_VALOR',
            [
                'attribute' => 'PINS_FECHA',
                'value' => 'PINS_FECHA',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'PINS_FECHA',
                    'type' => DatePicker::TYPE_INPUT,
                    'language' => 'es',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
                    'options' => [],                    
                ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
