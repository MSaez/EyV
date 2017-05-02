<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CobrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cobros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CBR_ID') ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'CBR_VALOR') ?>

    <?= $form->field($model, 'CBR_FECHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
