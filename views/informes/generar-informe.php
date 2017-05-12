<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
?>

<?php
    $this->title = 'Ingresar Mes y Año';
    $this->params['breadcrumbs'][] = 'Informe de Utilidad Mensual';
    $this->params['breadcrumbs'][] = 'Ingresar Mes y Año';
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
            'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
            'options' => ['class' => 'form-control', 'style' => 'width:25%',]
    ]) ?>

<div class="form-group">
    <?= Html::submitButton('Generar Informe', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>