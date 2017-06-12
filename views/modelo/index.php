<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\select2\Select2;
use app\models\Marca;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModeloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Modelo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'MAR_ID', // se modifica la columna para que muestre los nombres de marca referenciando el nombre de la relación
                'value' => 'mAR.MAR_NOMBRE',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'MAR_ID',
                    'data' => ArrayHelper::map(Marca::find()->all(),'MAR_ID','MAR_NOMBRE'),
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'hideSearch' => false,
                    'options' => [
                        'placeholder' => 'Seleccione una Marca...',
                    ],
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],
            'MOD_NOMBRE',
            'MOD_VARIANTE',

            ['class' => '\kartik\grid\ActionColumn',
             'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
