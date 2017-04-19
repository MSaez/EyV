<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'VEH_ID', 
                'value' => 'vEH.VEH_PATENTE'
            ],
            [
                'attribute' => 'CLI_ID', 
                'value' => 'cLI.nombreCompleto'
            ],
            'OT_INICIO',
            'OT_ENTREGA',
            // 'OT_OBSERVACIONES:ntext',
            // 'OT_SUBTOTAL',
            // 'OT_IVA',
            'OT_TOTAL',
            // 'OT_TOTAL_HORAS',
            'OT_ESTADO',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
