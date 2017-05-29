<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InsumoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insumo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Insumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'INS_ID',
            'OT_ID',
            'PINS_ID',
            'INV_ID',
            'INS_NOMBRE',
            // 'INS_CANTIDAD',
            // 'INS_PRECIO_UNITARIO',
            // 'INS_TOTAL',
            // 'INS_RECIBIDO',
            // 'INS_REUTILIZADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
