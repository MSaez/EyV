<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoInsumos */

$this->title = 'Corregir Factura Insumo: ' . $model->PINS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Pago Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PINS_ID, 'url' => ['view', 'id' => $model->PINS_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pago-insumos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
