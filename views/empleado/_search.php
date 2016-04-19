<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpleadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EMP_RUT') ?>

    <?= $form->field($model, 'EMP_NOMBRES') ?>

    <?= $form->field($model, 'EMP_PATERNO') ?>

    <?= $form->field($model, 'EMP_MATERNO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
