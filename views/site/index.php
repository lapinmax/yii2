<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
          <?= Html::a('Go to page', ['/site/get_page'], ['class' => 'btn btn-lg btn-success']) ?>
    </div>

</div>
