<?php
use yii\helpers\html;
?>

<h2><?= Html::a(Html::encode($model->name), ['club/related', 'p1' => $model->idSport]) ?></h2>
