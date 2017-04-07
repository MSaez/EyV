<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = 'Nuevo Presupuesto';
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDesabolladura' => $modelsDesabolladura,
        'modelsPintura' => $modelsPintura,
        'modelsInsumo' => $modelsInsumo,
        'modelsServicios' => $modelsServicios,
    ]) ?>

</div>
