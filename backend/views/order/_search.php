<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'created_at') ?>

<!--    --><?//= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'sum') ?>

    <?php  echo $form->field($model, 'status') ?>

    <?php  echo $form->field($model, 'name') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php  echo $form->field($model, 'phone') ?>

    <?php  echo $form->field($model, 'address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
