<?php

    use yii\helpers\Html;
    use kartik\grid\GridView;
    use yii\helpers\Url;
    
    $hoy = date("d/m/Y");
    
    $this->title = 'Trabajos atrasados a fecha: '.$hoy;
    $this->params['breadcrumbs'][] = 'Informe de Trabajos atrasados a fecha: '.$hoy;
    $this->params['breadcrumbs'][] = 'Ver Informe de Trabajos atrasados a fecha: '.$hoy;
?>

<div class="container-fluid">
    <div class="row">   
        <div class="col-xs-12 col-md-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-xs-10 col-md-2">
            <h2>
            <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir', ['imprimir-atrasos'], ['class' => 'btn btn-primary']) ?>
            </h2> 
        </div>
    </div>
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
                'OT_TOTAL',
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'template' => '{verOt} ',
                    'buttons' => [
                    'verOt' => function ($url, $model) {
                                                    $title = null;
                                                    $options = ['title' => 'Ver Orden de Trabajo',]; 
                                                    $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['ot/view','id'=>$model->OT_ID]);
                                                    return Html::a($label, $url, $options);
                                      },                    
                    ]
                ]
                
            ],
            
        ]); ?>

</div>


