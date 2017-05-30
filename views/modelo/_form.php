<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Marca;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modelo-form">

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MAR_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Marca::find()->all(),'MAR_ID','MAR_NOMBRE'),
        'options' => ['placeholder' => 'Seleccione una Marca ...',],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'MOD_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOD_VARIANTE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
