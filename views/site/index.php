<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <h1>Bienvenido a la Plataforma de gestión de Reparaciones de Vehículos y apoyo al proceso de Contabilidad</h1>
    <h4>Con esta plataforma usted podrá gestionar los procesos de reparación de vehiculos de forma más eficiente y apoyar el proceso de contabilidad de su taller.</h4>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="body-content">
        <h3>Estadística de trabajos.</h3>
        <div class="row">
            <div class="col-sm-3"><?= Html::a('Trabajos atrasados a la fecha:', ['/informes/generar-informe-atrasados'])?></div>
            <div class="col-sm-3"><?= '<span class="label label-danger">'.$atrasados."</span>" ?></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><?= Html::a('Trabajos realizandose a la fecha:', ['/ot']);?></div>
            <div class="col-sm-3"><?= '<span class="label label-success">'.$activos."</span>" ?></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><?= Html::a('Presupuestos emitidos: ', ['/presupuesto']);?></div>
            <div class="col-sm-3"><?= '<span class="label label-info">'.$presupuestos."</span>" ?></div>
        </div>
    </div>
</div>
