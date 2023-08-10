<?php
use yii\helpers\html;
?>

<div>You left the club. To return to previous page click link below. </div>

<?= Html::a(Html::encode("Go back!"), ['club/my',]) ?>