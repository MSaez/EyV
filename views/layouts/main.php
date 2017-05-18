<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\alert\Alert;



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Estrada y Veloso',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    try{
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            /*['label' => 'Sobre mí', 'url' => ['/site/about']],*/
            /*['label' => 'Contacto', 'url' => ['/site/contact']],*/
            ['label' => 'Administrar',
                                'items' => [
                                    ['label' => 'Marcas', 
                                                    'items' => [
                                                            ['label' => 'Nueva Marca', 'url' => ['/marca/create']],
                                                            ['label' => 'Listar Marcas', 'url' => ['/marca/']],
                                                    ],
                                    ],
                                    '<li class="divider"></li>',
                                    ['label' => 'Modelos', 
                                                    'items' => [
                                                            ['label' => 'Nuevo Modelo', 'url' => ['/modelo/create']],
                                                            ['label' => 'Listar Modelos', 'url' => ['/modelo/']],
                                                    ],
                                    ],
                                    '<li class="divider"></li>',
                                    ['label' => 'Usuarios',  
                                                    'items' => [
                                                            ['label' => 'Nuevo Usuario', 'url' => ['/usuario/create']],
                                                            ['label' => 'Listar Usuarios', 'url' => ['/usuario/']],
                                                    ],
                                    ],
                                    '<li class="divider"></li>',
                                    ['label' => 'Empleados', 
                                                    'items' => [
                                                            ['label' => 'Nuevo Empleado', 'url' => ['/empleado/create']],
                                                            ['label' => 'Listar Empleados', 'url' => ['/empleado/']],
                                                    ],
                                    ],
                                ],
                                'visible' => app\models\Usuario::isUserAdmin(Yii::$app->user->identity->id),
                            ],
            
            ['label' => 'Clientes', 'items' => [
                                                ['label' => 'Nuevo Cliente', 'url' => ['/cliente/create']],
                                                ['label' => 'Listar Clientes', 'url' => ['/cliente/']],
                                ],
                            ],
            ['label' => 'Vehículos', 'items' => [
                                                ['label' => 'Nuevo Vehículo', 'url' => ['/vehiculo/create']],
                                                ['label' => 'Listar Vehículos', 'url' => ['/vehiculo/']],
                                ],
                            ],
            ['label' => 'Presupuestos', 'items' => [
                                                ['label' => 'Nuevo Presupuesto', 'url' => ['/presupuesto/create']],
                                                ['label' => 'Listar Presupuestos', 'url' => ['/presupuesto/']],
                                ],
                            ],
            ['label' => 'Ordenes de Trabajo', 'items' => [
                                                ['label' => 'Listar Ordenes de Trabajo',
                                                 'url' => ['/ot/'],
                                                ],
                                                ['label' => 'Listar Pagos de Insumos',
                                                 'url' => ['/pinsumo/'],
                                                 'visible' => app\models\Usuario::isUserAdmin(Yii::$app->user->identity->id),
                                                ],
                                                ['label' => 'Listar Pagos de Servicios Externos',
                                                 'url' => ['/pexterno/'],
                                                 'visible' => app\models\Usuario::isUserAdmin(Yii::$app->user->identity->id),
                                                ],
                                                ['label' => 'Listar Despachos',
                                                 'url' => ['/despacho/'],
                                                 'visible' => app\models\Usuario::isUserAdmin(Yii::$app->user->identity->id),
                                                ],
                                                ['label' => 'Listar Cobros de Trabajos',
                                                 'url' => ['/cobro/'],
                                                 'visible' => app\models\Usuario::isUserAdmin(Yii::$app->user->identity->id),
                                                ],
                                ],
                            ],
            ['label' => 'Informes', 
                                'items' => [
                                                ['label' => 'Trabajos Atrasados', 'url' => ['/informes/generar-informe-atrasados']],
                                                ['label' => 'Utilidad Mensual', 'url' => ['/informes/generar-informe-utilidad']],
                                ],
                                'visible' => app\models\Usuario::isUserAdmin(Yii::$app->user->identity->id),
                            ],
            
            Yii::$app->user->isGuest ? (
                ['label' => 'Iniciar sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->US_USERNAME . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    
    }catch(yii\base\ErrorException $e){
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Iniciar sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->US_USERNAME . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    }
    
    
    NavBar::end();
    
    ?>
    
    
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?php if (Yii::$app->session->hasFlash('danger')): 
                    echo Alert::widget([
                        'type' => Alert::TYPE_DANGER,
                        'title' => '¡Oh no!',
                        'icon' => 'glyphicon glyphicon-remove-sign',
                        'body' => Yii::$app->session->getFlash('danger'),
                        'showSeparator' => true,
                        'delay' => 8000
                    ]); ?>
        <?php endif; ?>
    
        <?php if (Yii::$app->session->hasFlash('success')): 
                    echo Alert::widget([
                        'type' => Alert::TYPE_SUCCESS,
                        'title' => '¡Estupendo!',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'body' => Yii::$app->session->getFlash('success'),
                        'showSeparator' => true,
                        'delay' => 2000
                    ]); ?>
        <?php endif; ?>
        
        
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Estrada y Veloso ltda. <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered().' '.Yii::getVersion() ?> </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
