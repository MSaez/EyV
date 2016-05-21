<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadPintura */

$this->title = $model->PIN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actividad Pinturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-pintura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PIN_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PIN_ID], [
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
            'PIN_ID',
            'EMP_RUT',
            'OT_ID',
            'PIN_DESCRIPCION:ntext',
            'PIN_HORAS',
            'PIN_PRECIO',
            'PIN_ESTADO',
        ],
    ]) ?>

</div>
