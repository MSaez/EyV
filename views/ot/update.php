<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = 'Update Ot: ' . $model->OT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->OT_ID, 'url' => ['view', 'id' => $model->OT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
