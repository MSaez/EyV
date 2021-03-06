<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'CLI_RUT:rut',
            'CLI_NOMBRES',
            'CLI_PATERNO',
            'CLI_MATERNO',
            'CLI_TELEFONO',
            // 'CLI_DIRECCION:ntext',
            ['class' => '\kartik\grid\ActionColumn',
             'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
