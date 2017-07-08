<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DespachoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Despachos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despacho-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'OD_ID',
            'OT_ID',
            [
                'attribute' => 'OD_FECHA',
                'value' => 'OD_FECHA',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'OD_FECHA',
                    'type' => DatePicker::TYPE_INPUT,
                    'language' => 'es',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
                    'options' => [],
                ]),
            ],
            'OD_OBSERVACINES:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
