<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventarioSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'INV_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'INS_ID') ?>

    <?= $form->field($model, 'INV_NOMBRE') ?>

    <?= $form->field($model, 'INV_CANTIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
