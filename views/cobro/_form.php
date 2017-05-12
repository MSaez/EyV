<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cobros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cobros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CBR_VALOR')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
