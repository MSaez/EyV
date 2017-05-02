<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Despacho */

$this->title = 'Update Despacho: ' . $model->OD_ID;
$this->params['breadcrumbs'][] = ['label' => 'Despachos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->OD_ID, 'url' => ['view', 'id' => $model->OD_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="despacho-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
