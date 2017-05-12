<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Orden de Trabajo'; ?>

<div class="ot-view">
        
    <h1><?= Html::encode($this->title) ?></h1>
        
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'OT_ID',
            [                      
                'label' => 'Vehículo', 
                'value' => $model->vEH->VEH_PATENTE,
            ],
            [                      
                'label' => 'Cliente', 
                'value' => $model->cLI->CLI_NOMBRES.' '.$model->cLI->CLI_PATERNO.' '.$model->cLI->CLI_MATERNO,
            ],
            'OT_INICIO',
            'OT_ENTREGA',
            'OT_OBSERVACIONES:ntext',
        ],
    ]) ?>
    
    <h1>Actividades de desabolladura</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProviderDesabolladura,
            //'filterModel' => $searchModel,
            'columns' => [

                 //['class' => 'yii\grid\SerialColumn'],
                'DES_DESCRIPCION',
                'DES_HORAS',
            ],
        ]); ?>
   <?php Pjax::end(); ?>
    
    <h1>Actividades de pintura</h1>
    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProviderPintura,
            //'filterModel' => $searchModel,
            'columns' => [

                // ['class' => 'yii\grid\SerialColumn'],
                'PIN_DESCRIPCION',
                'PIN_HORAS',                
            ],
        ]); ?>
   <?php Pjax::end(); ?>
    
  </div>

