<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>
<h1>Trabajadores asignados a esta actividad:</h1>
<?php Pjax::begin(); ?>

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
                    'template' => '{asignarTrabajadorDes}',
                    'buttons' => [
                    'asignarTrabajadorDes' => function ($url, $model, $key) { // cambiar la funcion por la de desasignacion
                                                    $title = null;
                                                    $options = ['title' => 'Asignar Trabajador']; 
                                                    $icon = '<span class="glyphicon glyphicon-pencil"></span>';
                                                    $label = $icon . ' ' . $title;
                                                    $url = Url::toRoute(['desabolladura/asignartrabajador','id'=>$key]);
                                                    return Html::a($label, $url, $options);
                                      },
                   
                    ]
                ]

            ],
            

        ]);


        
?>

<?php Pjax::end(); ?>


