<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Despacho */

$this->title = 'Create Despacho';
$this->params['breadcrumbs'][] = ['label' => 'Despachos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despacho-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
