<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagoExternosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pago Externos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-externos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Folio OT',
                'value' => 'oS.OT_ID',
                
            ],
            [
                'attribute' => 'Servicio Externo',
                'value' => 'oS.OS_DESCRIPCION',
            ],
            'PEXT_FACTURA',
            'PEXT_VALOR',
            'PEXT_FECHA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
