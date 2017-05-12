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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PINS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PINS_ID], [
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
            'PINS_FECHA',
        ],
    ]) ?>

</div>
