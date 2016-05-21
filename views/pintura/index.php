<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadPinturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividad Pinturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-pintura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Actividad Pintura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PIN_ID',
            'EMP_RUT',
            'OT_ID',
            'PIN_DESCRIPCION:ntext',
            'PIN_HORAS',
            // 'PIN_PRECIO',
            // 'PIN_ESTADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
