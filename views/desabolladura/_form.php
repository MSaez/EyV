<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadDesabolladura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-desabolladura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DES_ESTADO')->dropDownList(['Pendiente' => 'Pendiente',
                                                          'Ejecutando' => 'En ejecución',
                                                          'Terminado' => 'Terminado',
                                                          'Cancelado' => 'Cancelado'],
                                                         ['prompt'=>'Seleccione un estado']) ?> 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
