<?php

use backend\components\MenuWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'parent_id') ?>
    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Категория</label>
        <select id="category-parent_id" class="form-control" name="CategorySearch[parent_id]" aria-invalid="false">
            <option value="">Все категории</option>
            <option value="0">Основная</option>
            <?= MenuWidget::widget(['template' => 'select','model'=>$model]) ?>
        </select>

        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'keywords') ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
