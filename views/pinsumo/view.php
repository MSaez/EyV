<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PagoInsumos */

$this->title = $model->PINS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pago Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-insumos-view">

    <!--<h1><?php //echo Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Corregir Factura de Pago de Insumo', ['update', 'id' => $model->PINS_ID], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      
                'label' => 'Folio OT', 
                'value' => $model->iNS->OT_ID,
            ],
            [                      
                'label' => 'Insumo', 
                'value' => $model->iNS->INS_NOMBRE,
            ],
            'PINS_FACTURA',
            'PINS_VALOR',
            [
                'label' => 'Fecha de Pago',
                'value' => $model->PINS_FECHA,
                'format' => ['date', 'php:d/m/Y'],
            ],
        ],
    ]) ?>

</div>
