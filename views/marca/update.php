<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EyvMarca */

$this->title = 'Actualizar Marca: ' . ' ' . $model->MAR_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MAR_NOMBRE, 'url' => ['view', 'id' => $model->MAR_ID]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="marca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

