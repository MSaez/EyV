<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarioSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'INV_ID',
            //'OT_ID',
            //'INS_ID',
            'INV_NOMBRE',
            'INV_CANTIDAD',
            'INV_PRECIO_UNITARIO',
            'INV_TOTAL',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
