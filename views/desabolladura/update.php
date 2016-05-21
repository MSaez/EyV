<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadDesabolladura */

$this->title = 'Update Actividad Desabolladura: ' . $model->DES_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actividad Desabolladuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DES_ID, 'url' => ['view', 'id' => $model->DES_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actividad-desabolladura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
