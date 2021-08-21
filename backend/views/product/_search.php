<?php

use backend\components\MenuWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!--    --><? //= $form->field($model, 'id') ?>

    <!--    --><? //= $form->field($model, 'category_id') ?>
    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Категория</label>
        <select id="category-parent_id" class="form-control" name="ProductSearch[category_id]" aria-invalid="false">
            <option value="">Все категории</option>
            <option value="0">Основная</option>
            <?= MenuWidget::widget(['template' => 'select-products-category', 'model' => $model]) ?>
        </select>

        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'price') ?>

    <!--    --><?php // echo $form->field($model, 'keywords') ?>

    <!--    --><?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?= $form->field($model, 'hit')->dropDownList([
        1 => 'Активный',
        0 => 'Не активный'
    ], ['prompt' => 'Выберите']) ?>

    <?= $form->field($model, 'new')->dropDownList([
        1 => 'Активный',
        0 => 'Не активный'
    ], ['prompt' => 'Выберите']) ?>

    <?= $form->field($model, 'sale')->dropDownList([
        1 => 'Активный',
        0 => 'Не активный'
    ], ['prompt' => 'Выберите']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
