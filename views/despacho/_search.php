<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DespachoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despacho-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'OD_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'OD_FECHA') ?>

    <?= $form->field($model, 'OD_OBSERVACINES') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
