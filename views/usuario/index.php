<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'US_USERNAME',
            'US_PASSWORD',
            'US_RUT:rut',
            'US_NOMBRES',
            'US_PATERNO',
            'US_MATERNO',
            'US_EMAIL:email',
            [
                'attribute' => 'US_ROL', 
                'value' => 'role',
            ],
            'US_CREADO',
            'US_ACTUALIZADO',

            ['class' => '\kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
