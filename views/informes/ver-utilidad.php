<?php
    use yii\helpers\Html;
    use kartik\grid\GridView;
    use yii\helpers\Url;

    $this->title = 'Informe de Utilidad Mensual'; 
    $this->params['breadcrumbs'][] = 'Informe de Utilidad Mensual';
    $this->params['breadcrumbs'][] = 'Ver Informe de Utilidad Mensual';
?>



<div>
    <div class="row">   
        <div class="col-xs-12 col-md-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-xs-10 col-md-2">
            <h2>
            <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir', ['imprimir-utilidad','inicio' => $inicio, 'fin' => $fin], ['class' => 'btn btn-primary']) ?>
            </h2> 
        </div>
    </div>
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
    
    <br>
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


 


