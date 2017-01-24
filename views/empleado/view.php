<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = Yii::$app->formatter->asRut($model->EMP_RUT);
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->EMP_RUT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->EMP_RUT], [
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
            'EMP_RUT:rut',
            'EMP_NOMBRES',
            'EMP_PATERNO',
            'EMP_MATERNO',
        ],
    ]) ?>

</div>
