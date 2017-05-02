<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cobros */

$this->title = 'Update Cobros: ' . $model->CBR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Cobros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CBR_ID, 'url' => ['view', 'id' => $model->CBR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cobros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
