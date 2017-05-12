<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h1>Bienvenido a la Plataforma de apoyo a la gestión de Reparaciones y Contabilidad, para servicio automotriz Estrada y Veloso ltda. </h1>
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
            <div class="col-sm-3"><?= 'Trabajos atrasados a la fecha:'?></div>
            <div class="col-sm-3"><?= '<span class="label label-danger">'.$atrasados."</span>" ?></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><?= 'Trabajos realizandose a la fecha:'?></div>
            <div class="col-sm-3"><?= '<span class="label label-success">'.$activos."</span>" ?></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><?= 'Presupuestos emitidos: '?></div>
            <div class="col-sm-3"><?= '<span class="label label-info">'.$presupuestos."</span>" ?></div>
        </div>
    </div>
</div>
