<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;




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
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            /*['label' => 'Sobre mí', 'url' => ['/site/about']],*/
            /*['label' => 'Contacto', 'url' => ['/site/contact']],*/
            ['label' => 'Administrar', 
                                'items' => [
                                                ['label' => 'Marcas', 'url' => ['/marca']],
                                                ['label' => 'Modelos', 'url' => ['/modelo']],
                                                ['label' => 'Clientes', 'url' => ['/cliente']],
                                                ['label' => 'Vehículos', 'url' => ['/vehiculo']],
                                                ['label' => 'Empleados', 'url' => ['/empleado']],
                                                ['label' => 'Presupuestos', 'url' => ['/ot']],
                                                ['label' => 'Usuarios', 'url' => ['/usuario']],
                                ],
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
    NavBar::end();
    ?>
    
    
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?php if (Yii::$app->session->hasFlash('danger')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('danger') ?>
            </div>
        <?php endif; ?>
    
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
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
