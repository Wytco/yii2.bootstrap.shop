<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>
<?= common\modules\languages\widgets\ListWidget::widget() ?>
<?=  Yii::$app->language.'<br>'; ?>
<?=  Yii::t('app', 'Блог'); ?>

<?= $this->render('header', []); ?>
<div class="content">
    <div class="container">
        <?= Alert::widget() ?>
    </div>
    <?= $content ?>
</div>
<?= $this->render('footer', []); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
