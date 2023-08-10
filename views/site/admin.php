<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Hello admin!</h1>

        <p class="lead">This is the page where you can add, edit, delete and check all the records in that page gather.</p>
        <p class="lead">Below are links for each table.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col">
                <h2><?= Html::a(Html::encode("Sports"), ['sport/index']); ?></h2>
                <h2><?= Html::a(Html::encode("Clubs"), ['club/index']); ?></h2>
                <h2><?= Html::a(Html::encode("Evenets"), ['event/index']); ?></h2>
                <h2><?= Html::a(Html::encode("People"), ['person/index']); ?></h2>
                <h2><?= Html::a(Html::encode("Memberships"), ['membership/index']); ?></h2>
                <h2><?= Html::a(Html::encode("Participations"), ['participation/index']); ?></h2>
                <h2><?= Html::a(Html::encode("USERS"), ['user/admin']); ?></h2>         
                
            </div>
        </div>

    </div>
</div>
