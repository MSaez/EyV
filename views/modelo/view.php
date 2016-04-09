<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = $model->MOD_NOMBRE.' '.$model->MOD_VARIANTE;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->MOD_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->MOD_ID], [
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
            'MOD_ID',
            [                      
                'label' => 'Marca', // se modifica la columna de la id de marca para que muestre su nombre
                'value' => $model->mAR->MAR_NOMBRE,
            ],
            'MOD_NOMBRE',
            'MOD_VARIANTE',
        ],
    ]) ?>

</div>
