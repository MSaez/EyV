<?php

use yii\helpers\Html;
use kartik\grid\GridView;

switch ($mes) {
    case "01":
        $mes = "enero";
        break;
    case "02":
        $mes = "febrero";
        break;
    case "03":
        $mes = "marzo";
        break;
    case "04":
        $mes = "abril";
        break;
    case "05":
        $mes = "mayo";
        break;
    case "06":
        $mes = "junio";
        break;
    case "07":
        $mes = "julio";
        break;
    case "08":
        $mes = "agosto";
        break;
    case "09":
        $mes = "septiembre";
        break;
    case "10":
        $mes = "octubre";
        break;
    case "11":
        $mes = "noviembre";
        break;
    case "12":
        $mes = "diciembre";
        break;
}


$this->title = 'Informe de Utilidad Mensual: '.$mes.' '.$anio.'.'; ?>

<div class="ot-view">
   
    <h1><?= Html::encode($this->title) ?></h1>
    <br>    
        <?= GridView::widget([
            'dataProvider' => $dataProviderUtilidad,
            //'filterModel' => null,
            
            'layout' => "{items}\n{pager}",
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'OT_ID',
                [
                'attribute' => 'CLI_ID', 
                'value' => 'cLI.nombreCompleto',               
                ],
                [
                'attribute' => 'VEH_ID', 
                'value' => 'vEH.VEH_PATENTE',                
                ],
                'OT_TDESABOLLADURA',
                'OT_TPINTURA',
                'OT_TINSUMO',
                'OT_TEXTERNO',
                'OT_TREUTILIZADO',
                'OT_SUBTOTAL',
                'OT_IVA',
                'OT_TOTAL',
                'OT_OBSERVACIONES',
                [
                    'attribute' => 'utilidad',
                    'value' => 'utilidad'
                ],
            ],
            
        ]); ?>
    <div class="page-break"></div>
    <table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
    <thead>
    <tr>
        <th>Total Mensual Desabolladura</th>
        <th>Total Mensual Pintura</th>
        <th>Total Mensual Insumos</th>
        <th>Total Mensual Servicios Externos</th>
        <th>Total Mensual Insumos Reutilizados</th>
        <th>Subtotal Mensual</th>
        <th>IVA Mensual</th>
        <th>Total Mensual</th>
        <th>Utilidad Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td><?= $desabolladura ?></td>
        <td><?= $pintura ?></td>
        <td><?= $insumos ?></td>
        <td><?= $externos ?></td>
        <td><?= $reutilizado ?></td>
        <td><?= $subtotal ?></td>
        <td><?= $iva ?></td>
        <td><?= $total ?></td>
        <td><?= $utilidad ?></td>
    </tr>    
  </tbody>
</table>

</div>