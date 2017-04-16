<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\PresupuestoSearch */ 

$this->title = 'Presupuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo Presupuesto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'VEH_ID',  
                'value' => 'vEH.VEH_PATENTE'
            ],
            [
                'attribute' => 'CLI_ID', 
                'value' => 'cLI.nombreCompleto'
            ],
            'OT_INICIO:Date',
            'OT_ENTREGA:Date',
            // 'OT_OBSERVACIONES:ntext',
            // 'OT_SUBTOTAL',
            // 'OT_IVA',
            'OT_TOTAL',
            'OT_TOTAL_HORAS',
            ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'confirmar' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ', ['presupuesto/confirmar','id'=>$model->OT_ID], ['title' => 'Confirmar Presupuesto']);
                },
            ],
            'template' => '{update} {view} {delete} {confirmar}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>





