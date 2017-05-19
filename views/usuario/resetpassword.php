<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Reestablecer Contraseña';
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="usuario-resetpassword">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>Por favor, ingrese su correo electronico con el que está registrado para reestablecer la contraseña :</p>
    <br>
    <?php $form = ActiveForm::begin([
        'id'=>'resetpassword-form',
        'options'=>['class'=>'form-horizontal'],
        'fieldConfig'=>[
            'template'=>"{label}\n<div class=\"col-lg-3\">
                        {input}</div>\n<div class=\"col-lg-5\">
                        {error}</div>",
            'labelOptions'=>['class'=>'col-lg-2 control-label'],
        ],
    ]); ?>
    
    <?= $form->field($model,'email')->textInput() ?>
    <br>
    <div class="form-group">
            <div class="col-lg-offset-2 col-lg-11">
                <?= Html::submitButton('Reestablecer contraseña',[
                    'class'=>'btn btn-primary'
                ]) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
