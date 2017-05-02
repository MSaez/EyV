<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pagos */

$this->title = 'Create Pagos';
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
