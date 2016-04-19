<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = $model->OT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->OT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->OT_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'OT_ID',
            'OD_ID',
            'CBR_ID',
            'VEH_ID',
            'CLI_ID',
            'OT_INICIO',
            'OT_ENTREGA',
            'OT_OBSERVACIONES:ntext',
            'OT_SUBTOTAL',
            'OT_IVA',
            'OT_TOTAL',
            'OT_TOTAL_HORAS',
        ],
    ]) ?>
    
    <h1>Actividades de desabolladura</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'EMP_RUT',
                'DES_DESCRIPCION',
                'DES_HORAS',
                'DES_PRECIO',
                'DES_ESTADO',

            ],

        ]); ?>
   <?php Pjax::end(); ?>

</div>
