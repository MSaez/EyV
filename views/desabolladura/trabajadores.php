<?php
    use yii\helpers\Html;
    use kartik\grid\GridView;
    use yii\widgets\Pjax;
    use yii\helpers\Url;
?>
<h1>Trabajadores asignados a la actividad: <?= $actDesabolladura->DES_DESCRIPCION ?></h1>
<br>
<?php Pjax::begin();?>


<?php
    $this->title = 'Ver Trabajadores Asignados';
    $this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['/ot/index']];
    $this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajo Folio: '.$actDesabolladura->OT_ID, 'url' => ['ot/view', 'id' => $actDesabolladura->OT_ID]];
    $this->params['breadcrumbs'][] = 'Ver Trabajadores';
?>
<?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [

                 //['class' => 'yii\grid\SerialColumn'],
                'EMP_RUT:rut:Rut',
                'EMP_NOMBRES:text:Nombres',
                'EMP_PATERNO:text:Apellido Paterno',
                'EMP_MATERNO:text:Apellido Materno',
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'template' => '{eliminarTrabajadorDes}',
                    'buttons' => [
                    'eliminarTrabajadorDes' => function ($url, $model, $key) { // cambiar la funcion por la de desasignacion
                                                    $title = null;
                                                    $options = ['title' => 'Asignar Trabajador']; 
                                                    $icon = '<span class="glyphicon glyphicon-trash"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $session = Yii::$app->session;
                                                    $url = Url::to(['desabolladura/eliminar', 'idDesabolladura' => $session['desabolladuraId'], 'empRut'=>$key]);
                                                    return Html::a($label, $url, $options);
                                      },
                   
                    ]
                ]

            ],
            

        ]);


        
?>

<?php Pjax::end(); ?>


