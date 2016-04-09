<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EyvMarca */

$this->title = 'Nueva Marca';
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
