<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

?>
<h1>Trabajadores asignados a esta actividad:</h1>
<?php Pjax::begin(); ?>

<?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [

                 //['class' => 'yii\grid\SerialColumn'],
                'EMP_RUT',
                'EMP_NOMBRES',
                'EMP_PATERNO',
                'EMP_MATERNO',
                

            ],
            

        ]); ?>

<?php Pjax::end(); ?>


