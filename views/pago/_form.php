<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pagos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OS_ID')->textInput() ?>

    <?= $form->field($model, 'INS_ID')->textInput() ?>

    <?= $form->field($model, 'PAG_VALOR')->textInput() ?>

    <?= $form->field($model, 'PAG_FECHA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
