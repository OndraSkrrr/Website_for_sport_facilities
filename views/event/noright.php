<?php
use yii\helpers\html;
?>

<div>You arenot allowed to take this action. </div>

<?= Html::a(Html::encode("Go back!"), ['site/index',]) ?>