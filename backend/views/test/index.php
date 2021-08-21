<?php
?>
<H1>test</H1>
<!--Рендер внутри вида-->
<?= $this->render('inc') ?>
    <!--Рендер внутри вида и передача данных-->
<?= $this->render('inc',[
    'foo' => 1,
    'bar' => 2,
]) ?>

<p><?= $this->context->my_var ?></p>
<p><?= $this->params['t1'] ?></p>

<?php $this->beginBlock('block1'); ?>

<p><?= $this->params['t2']  = 'T2 params'?></p>

<?php $this->endBlock(); ?>
