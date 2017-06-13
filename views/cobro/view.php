<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cobros */

$this->title = $model->CBR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Cobros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cobros-view">

    <!--<h1><?php //echo Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Corregir Cobro de Trabajo', ['update', 'id' => $model->CBR_ID], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CBR_ID',
            'OT_ID',
            'CBR_VALOR',            
            [
                'label' => 'Fecha Cobro',
                'value' => $model->CBR_FECHA,
                'format' => ['date', 'php:d/m/Y'],
            ],
        ],
    ]) ?>

</div>
