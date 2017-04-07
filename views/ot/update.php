<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = 'Actualizar Orden de Trabajo: ' . $model->OT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->OT_ID, 'url' => ['view', 'id' => $model->OT_ID]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="ot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDesabolladura' => $modelsDesabolladura,
        'modelsPintura' => $modelsPintura,
        'modelsInsumo' => $modelsInsumo,
        'modelsServicios' => $modelsServicios,
    ]) ?>

</div>
