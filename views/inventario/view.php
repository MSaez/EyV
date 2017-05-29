<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = $model->INV_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar Datos', ['update', 'id' => $model->INV_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar Insumo', ['delete', 'id' => $model->INV_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este insumo?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'INV_ID',
            //'OT_ID',
            //'INS_ID',
            'INV_NOMBRE',
            'INV_CANTIDAD',
            'INV_PRECIO_UNITARIO',
            'INV_TOTAL',
        ],
    ]) ?>

</div>
