<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vehiculo */

$this->title = $model->VEH_PATENTE;
$this->params['breadcrumbs'][] = ['label' => 'Vehículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehiculo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['Actualizar', 'id' => $model->VEH_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['Eliminar', 'id' => $model->VEH_ID], [
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
            'VEH_ID',
            [                      
                'label' => 'Marca', // se modifica la columna de la id de marca para que muestre su nombre
                'value' => $model->mAR->MAR_NOMBRE,
            ],
            [                      
                'label' => 'Modelo', // se modifica la columna de la id de marca para que muestre su nombre
                'value' => $model->mOD->MOD_NOMBRE,
            ],
            [                      
                'label' => 'Propietario', // se modifica la columna de la id de marca para que muestre su nombre
                'value' => $model->cLI->CLI_NOMBRES.' '.$model->cLI->CLI_PATERNO.' '.$model->cLI->CLI_MATERNO,
            ],
            'VEH_ANIO',
            'VEH_CHASIS',
            'VEH_MOTOR',
            'VEH_COLOR',
            'VEH_PATENTE',
        ],
    ]) ?>

</div>
