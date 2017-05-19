<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = Yii::$app->formatter->asRut($model->US_RUT);
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <p>
        <?= Html::a('Actualizar Datos', ['update', 'id' => $model->US_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cambiar Contraseña', ['change-password'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Eliminar Usuario', ['delete', 'id' => $model->US_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Eliminar al Usuario: '.$model->US_USERNAME.'?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'US_ID',
            'US_USERNAME',
            'US_RUT:rut',
            'US_NOMBRES',
            'US_PATERNO',
            'US_MATERNO',
            'US_EMAIL:email',
            [                      
                'label' => 'Rol', 
                'value' => $model->getRole(),
            ],
            'US_CREADO',
            'US_ACTUALIZADO'
        ],
    ]) ?>

</div>
