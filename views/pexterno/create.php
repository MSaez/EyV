<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagoExternos */

$this->title = 'Ingresar Factura Servicio Externo';
$this->params['breadcrumbs'][] = ['label' => 'Pago Externos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-externos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
