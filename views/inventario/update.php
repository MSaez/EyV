<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Modificar Datos Insumo: '.$model->iNS->INS_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->INV_ID, 'url' => ['view', 'id' => $model->INV_ID]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
