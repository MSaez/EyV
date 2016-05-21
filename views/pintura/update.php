<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadPintura */

$this->title = 'Update Actividad Pintura: ' . $model->PIN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actividad Pinturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PIN_ID, 'url' => ['view', 'id' => $model->PIN_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividad-pintura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
