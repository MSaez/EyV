<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadDesabolladuraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividad Desabolladuras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-desabolladura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Actividad Desabolladura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DES_ID',
            'OT_ID',
            'EMP_RUT',
            'DES_DESCRIPCION:ntext',
            'DES_HORAS',
            // 'DES_PRECIO',
            // 'DES_ESTADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
