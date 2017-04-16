<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron" bgcolor="red">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        
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
