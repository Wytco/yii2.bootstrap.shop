<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="site-error">
    <div class="container text-center">
        <div class="logo-404">
            <a href="/"><img src="/images/home/logo.png" alt="" /></a>
        </div>
        <div class="content-404">
            <img src="/images/404/404.png" class="img-responsive" alt="" />
            <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
            <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
            <h3><?= Html::encode($this->title) ?></h3>
            <h3> <?= nl2br(Html::encode($message)) ?></h3>
            <h2><a href="/">Bring me back Home</a></h2>
        </div>
    </div>
</div>
