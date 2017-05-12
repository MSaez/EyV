<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CobrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cobros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cobros-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'CBR_ID',
            'OT_ID',
            'CBR_VALOR',
            'CBR_FECHA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
