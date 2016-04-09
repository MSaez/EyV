<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = 'Actualizar Modelo: ' . $model->MOD_NOMBRE.' '.$model->MOD_VARIANTE;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MOD_NOMBRE.' '.$model->MOD_VARIANTE, 'url' => ['view', 'id' => $model->MOD_ID]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
