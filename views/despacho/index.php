<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'OD_FECHA',
            'OD_OBSERVACINES:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
