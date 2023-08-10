<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Membership $model */

$this->title = 'Create Membership';
$this->params['breadcrumbs'][] = ['label' => 'Memberships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
