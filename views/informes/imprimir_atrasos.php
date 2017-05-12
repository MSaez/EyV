<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$hoy = date("d/m/Y");
$this->title = 'Trabajos atrasados a fecha: '.$hoy; ?>

<div class="ot-view">
        
    <h1><?= Html::encode($this->title) ?></h1>
    <br>    
        <?= GridView::widget([
            'dataProvider' => $dataProviderAtrasos,
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
                [
                'attribute' => 'OT_ENTREGA',
                'value' => 'OT_ENTREGA',
                'format' => ['date', 'php:d/m/Y'],                
                ],
                'OT_TOTAL'
            ],
            
        ]); ?>

</div>
