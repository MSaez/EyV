<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Orden de Compra'; ?>

<div class="ot-view">
        
    <h1><?= Html::encode($this->title) ?></h1>
        
    <?= DetailView::widget([
        'model' => $ot,
        'attributes' => [
            'OT_ID',
            [                      
                'label' => 'Vehículo', 
                'value' => $ot->vEH->VEH_PATENTE,
            ],
            [                      
                'label' => 'Cliente', 
                'value' => $ot->cLI->CLI_NOMBRES.' '.$ot->cLI->CLI_PATERNO.' '.$ot->cLI->CLI_MATERNO,
            ],
            'OT_INICIO',
            'OT_ENTREGA',
            'OT_OBSERVACIONES:ntext',
            'OT_SUBTOTAL',
            'OT_IVA',
            'OT_TOTAL',
            'OT_TOTAL_HORAS',
        ],
    ]) ?>

    <h1>Insumos</h1>


        <?= GridView::widget([
            'dataProvider' => $dataProviderInsumo,
            //'filterModel' => null,
            
            'layout' => "{items}\n{pager}",
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'INS_NOMBRE',
                'INS_CANTIDAD',
                ],
        ]); ?>

</div>
