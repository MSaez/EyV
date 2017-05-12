<?php

use yii\helpers\Html;

?>
<div class="container-fluid">
    <br>
    <h2 class="text-center"><strong>Servicio Automotriz Estrada y Veloso Ltda</strong></h2>
    <h2 class="text-center"><strong>Recibo de Conformidad</strong></h2>
    <br>
    <h3><strong>Certifico recibir conforme mi vehículo:</strong></h3>
    <br>
    <h3><strong>Marca:</strong> <?= Html::encode($vehiculo->mAR->MAR_NOMBRE); ?></h3>
    <br>
    <h3><strong>Modelo:</strong> <?= Html::encode($vehiculo->mOD->MOD_NOMBRE); ?></h3>
    <br>
    <h3><strong>Año:</strong> <?= Html::encode($vehiculo->VEH_ANIO); ?></h3>
    <br>
    <h3><strong>Patente:</strong> <?= Html::encode($vehiculo->VEH_PATENTE); ?></h3>
    <br>
    <h3><strong>Observaciones:</strong> <?= Html::encode($model->OD_OBSERVACINES);?> </h3>
    <br>
    <br>
    <br>
    <center><h3 class="text-center"><strong>Firma: ____________________</strong></h3></center>
</div>
