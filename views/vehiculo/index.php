<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VehiculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehículos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehiculo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Vehiculo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'VEH_PATENTE',
            [
                'attribute' => 'MAR_ID', // se modifica la columna para que muestre los nombres de marca referenciando el nombre de la relación
                'value' => 'mAR.MAR_NOMBRE'
            ],
            [
                'attribute' => 'MOD_ID', // se modifica la columna para que muestre los nombres de modelo referenciando el nombre de la relación
                'value' => 'mOD.MOD_NOMBRE'
            ],
            [
                'attribute' => 'CLI_ID', // se modifica la columna para que muestre los nombres de cliente referenciando el nombre de la relación
                'value' => 'cLI.nombreCompleto'
            ],
            'VEH_ANIO',
            // 'VEH_CHASIS',
            // 'VEH_MOTOR',
            // 'VEH_COLOR',
            ['class' => '\kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
