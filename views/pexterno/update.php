<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoExternos */

$this->title = 'Corregir factura servicio externo: ' . $model->PEXT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pago Externos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PEXT_ID, 'url' => ['view', 'id' => $model->PEXT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pago-externos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
