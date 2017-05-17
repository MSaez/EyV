<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagoInsumos */

$this->title = 'Ingresar Factura Proveedor Insumo';
$this->params['breadcrumbs'][] = ['label' => 'Pago Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-insumos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
