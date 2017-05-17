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
        <?= Html::a('Actualizar Datos', ['update', 'id' => $model->MOD_ID], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      
                'label' => 'Marca', // se modifica la columna de la id de marca para que muestre su nombre
                'value' => $model->mAR->MAR_NOMBRE,
            ],
            'MOD_NOMBRE',
            'MOD_VARIANTE',
        ],
    ]) ?>

</div>
