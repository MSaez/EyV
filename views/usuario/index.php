<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'US_ID',
            'US_USERNAME',
            'US_RUT',
            'US_NOMBRES',
            'US_PATERNO',
            'US_MATERNO',
            'US_EMAIL:email',
            // 'US_PASSWORD',
            // 'US_AUTHKEY',
            'US_CREADO',
            'US_ACTUALIZADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
