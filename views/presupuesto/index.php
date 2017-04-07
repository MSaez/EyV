<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presupuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo Presupuesto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
    yii\bootstrap\Modal::begin(['header' => '<h2>Confirmar Presupuesto</h2>','id' =>'modal']);
    yii\bootstrap\Modal::end();
?>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'VEH_ID',
            'CLI_ID',
            'OT_INICIO',
            'OT_ENTREGA',
            // 'OT_OBSERVACIONES:ntext',
            // 'OT_SUBTOTAL',
            // 'OT_IVA',
            'OT_TOTAL',
            'OT_TOTAL_HORAS',
            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'confirmar' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> ', ['presupuesto/confirmar','id'=>$model->OT_ID], ['id' => 'popupModal']);
                },
            ],
            'template' => '{update} {view} {delete} {confirmar}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php $this->registerJs("$(function() {
   $('#popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-body')
     .load($(this).attr('href'));
   });
});"); ?>



