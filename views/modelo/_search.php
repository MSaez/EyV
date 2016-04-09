<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModeloSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modelo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MOD_ID') ?>

    <?= $form->field($model, 'MAR_ID') ?>

    <?= $form->field($model, 'MOD_NOMBRE') ?>

    <?= $form->field($model, 'MOD_VARIANTE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
