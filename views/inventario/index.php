<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarioSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Inventario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'INV_ID',
            'OT_ID',
            'INS_ID',
            'INV_NOMBRE',
            'INV_CANTIDAD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
