<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PagoExternos */

$this->title = $model->PEXT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pago Externos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-externos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PEXT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PEXT_ID], [
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
                'value' => $model->oS->OT_ID,
            ],
            [                      
                'label' => 'Servicio Externo', 
                'value' => $model->oS->OS_DESCRIPCION,
            ],
            'PEXT_FACTURA',
            'PEXT_VALOR',
            'PEXT_FECHA',
        ],
    ]) ?>

</div>
