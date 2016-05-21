<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadDesabolladura */

$this->title = $model->DES_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actividad Desabolladuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-desabolladura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->DES_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->DES_ID], [
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
            'DES_ID',
            'OT_ID',
            'EMP_RUT',
            'DES_DESCRIPCION:ntext',
            'DES_HORAS',
            'DES_PRECIO',
            'DES_ESTADO',
        ],
    ]) ?>

</div>
