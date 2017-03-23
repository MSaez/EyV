<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>
<h1>Trabajadores asignados a esta actividad:</h1>
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


