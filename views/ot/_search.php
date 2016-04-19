<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OtSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'OT_ID') ?>

    <?= $form->field($model, 'OD_ID') ?>

    <?= $form->field($model, 'CBR_ID') ?>

    <?= $form->field($model, 'VEH_ID') ?>

    <?= $form->field($model, 'CLI_ID') ?>

    <?php // echo $form->field($model, 'OT_INICIO') ?>

    <?php // echo $form->field($model, 'OT_ENTREGA') ?>

    <?php // echo $form->field($model, 'OT_OBSERVACIONES') ?>

    <?php // echo $form->field($model, 'OT_SUBTOTAL') ?>

    <?php // echo $form->field($model, 'OT_IVA') ?>

    <?php // echo $form->field($model, 'OT_TOTAL') ?>

    <?php // echo $form->field($model, 'OT_TOTAL_HORAS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
