<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Empleado;
use kartik\select2\Select2;
?>

<?php 
    $this->title = 'Asignar Trabajador';
    $this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['/ot/index']];
    $this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajo Folio: '.$actDesabolladura->OT_ID, 'url' => ['ot/view', 'id' => $actDesabolladura->OT_ID]];
    $this->params['breadcrumbs'][] = 'Asignar Trabajador';
?>
    <h1>Asignar Trabajador a la actividad: <?= $actDesabolladura->DES_DESCRIPCION ?></h1>
<?php
    $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'EMP_RUT')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Empleado::find()->all(),'EMP_RUT','nombreCompleto'),
        'options' => ['placeholder' => 'Seleccione un Trabajador ...',],
        'pluginOptions' => ['allowClear' => true],
    ]);
?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

