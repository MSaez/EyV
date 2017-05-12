<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Despacho */

$this->title = $model->OD_ID;
$this->params['breadcrumbs'][] = ['label' => 'Despachos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despacho-view">

    <h1><?= "Orden de Despacho" ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->OD_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Generar Documento de entrega', ['imprimir', 'id' => $model->OD_ID], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'OD_ID',
            'OT_ID',
            'OD_FECHA',
            'OD_OBSERVACINES:ntext',
        ],
    ]) ?>

</div>
