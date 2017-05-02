<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PAG_ID') ?>

    <?= $form->field($model, 'OS_ID') ?>

    <?= $form->field($model, 'INS_ID') ?>

    <?= $form->field($model, 'PAG_FACTURA') ?>

    <?= $form->field($model, 'PAG_VALOR') ?>

    <?php // echo $form->field($model, 'PAG_FECHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
