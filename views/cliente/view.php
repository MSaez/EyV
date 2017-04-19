<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::$app->formatter->asRut($model->CLI_RUT);
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CLI_ID',
            'CLI_NOMBRES',
            'CLI_PATERNO',
            'CLI_MATERNO',
            'CLI_RUT:rut',
            'CLI_TELEFONO',
            'CLI_DIRECCION:ntext',
        ],
    ]) ?>
    
        <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CLI_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->CLI_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
