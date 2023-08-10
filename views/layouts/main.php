<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],

            ['label' => 'Sports', 'url' => ['/sport/all']],
            ['label' => 'My Clubs', 'url' => ['/club/my'],'visible'=> (Yii::$app->user->can('admin') or Yii::$app->user->can('memer'))],
            ['label' => 'Private events', 'url' => ['/event/private'], 'visible'=> (Yii::$app->user->can('admin') or Yii::$app->user->can('memer') or !(Yii::$app->user->isGuest))],
            ['label' => 'Public events', 'url' => ['/event/public']],
            ['label' => 'Admin', 'url' => ['/site/admin'],'visible'=> (Yii::$app->user->can('admin'))],
            ['label' => 'Edit profile', 'url' => ['/person/request'],'visible'=> (Yii::$app->user->can('admin') or Yii::$app->user->can('memer') or !(Yii::$app->user->isGuest))],

            ##['label' => 'About', 'url' => ['/site/about']],
            ##['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
        ['label' => 'Login', 'url' => ['/user/login']] : // or ['/user/login-email']
        ['label' => 'Logout (' . Yii::$app->user->displayName . ')',
            'url' => ['/user/logout'],
            'linkOptions' => ['data-method' => 'post']],
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <!-- <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div> -->

    <div class="row myRowFooter">
            <div class="col-2 mt-2">
                <div class="btn-group-vertical">
                    <a href="#top" class="btn btn-primary" role="button" aria-pressed="true">Go up!</a>
                    <a href="index" class="btn btn-primary mt-2" role="button" aria-pressed="true">Go back!</a>
                </div>
            </div>
            <div class="col-2 mt-2 kolaps">
                <a href="index.html" class="btn btn-primary rounded-circle tlac" role="button" aria-pressed="true">Facebook</a>
                <a href="index.html" class="btn btn-primary rounded-circle tlac mt-2" role="button" aria-pressed="true">Instagram</a>
            </div>
            <div class="col-2 mt-2 kolaps">
                <a href="index.html" class="btn btn-primary rounded-circle tlac" role="button" aria-pressed="true">Youtube</a>
                <a href="index.html" class="btn btn-primary rounded-circle tlac mt-2" role="button" aria-pressed="true">&nbsp&nbspTwitter&nbsp&nbsp</a>
            </div>
            <div class="col-4 mt-2 unkolaps">
                <a href="index.html" class="btn btn-primary rounded-circle tlac" role="button" aria-pressed="true">Facebook</a>
                <a href="index.html" class="btn btn-primary rounded-circle tlac mt-2" role="button" aria-pressed="true">Instagram</a>
                <a href="index.html" class="btn btn-primary rounded-circle tlac mt-2" role="button" aria-pressed="true">Youtube</a>
                <a href="index.html" class="btn btn-primary rounded-circle tlac mt-2" role="button" aria-pressed="true">&nbsp&nbspTwitter&nbsp&nbsp</a>
            </div>
            <div class="col-6 mt-2">
                <div class="container contactBox">
                    <b>Contact</b>
                    <ul>
                        <li>Tel.n.:</li>
                        <p>+351 123456789</p>
                        <li>Email:</li>
                        <p>brgcasport@asoc.com </p>
                        <li>Adress:</li> 
                        <p>Escola Superior de Tecnologia e Gestão,5300-252 Bragança</p>
                    </ul>
                </div>
            </div>
        </div>


</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
