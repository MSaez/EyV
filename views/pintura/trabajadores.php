<?php
    use yii\helpers\Html;
    use kartik\grid\GridView;
    use yii\widgets\Pjax;
    use yii\helpers\Url;
?>

<?php
    $this->title = 'Ver Trabajadores Asignados';
    $this->params['breadcrumbs'][] = ['label' => 'Ordenes de Trabajo', 'url' => ['/ot/index']];
    $this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajo Folio: '.$actPintura->OT_ID, 'url' => ['ot/view', 'id' => $actPintura->OT_ID]];
    $this->params['breadcrumbs'][] = 'Ver Trabajadores';
?>
<h1>Trabajadores asignados a la actividad: <?= $actPintura->PIN_DESCRIPCION ?></h1>
<br>
<?php Pjax::begin();?>

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
                    'template' => '{eliminarTrabajadorPin}',
                    'buttons' => [
                    'eliminarTrabajadorPin' => function ($url, $model, $key) { // cambiar la funcion por la de desasignacion
                                                    $title = null;
                                                    $options = ['title' => 'Asignar Trabajador']; 
                                                    $icon = '<span class="glyphicon glyphicon-trash"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $session = Yii::$app->session;
                                                    $url = Url::to(['pintura/eliminar', 'idPintura' => $session['pinturaId'], 'empRut'=>$key]);
                                                    return Html::a($label, $url, $options);
                                      },
                   
                    ]
                ]

            ],
            

        ]);


        
?>

<?php Pjax::end(); ?>


