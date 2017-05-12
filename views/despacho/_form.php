<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Despacho */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despacho-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'OD_OBSERVACINES')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
