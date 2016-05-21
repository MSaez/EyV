<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActividadDesabolladura */

$this->title = 'Create Actividad Desabolladura';
$this->params['breadcrumbs'][] = ['label' => 'Actividad Desabolladuras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-desabolladura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
