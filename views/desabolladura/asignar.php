<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Empleado;
use kartik\select2\Select2;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EMP_RUT')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Empleado::find()->all(),'EMP_RUT','nombreCompleto'),
        'options' => ['placeholder' => 'Seleccione un Trabajador ...',],
        'pluginOptions' => ['allowClear' => true],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

