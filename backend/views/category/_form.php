<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\components\MenuWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--    --><? //= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Category::find()->all(),'id','name')) ; ?>

    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Категория</label>
        <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-invalid="false">
            <option value="0">Основная</option>
            <?= MenuWidget::widget(['template' => 'select', 'model' => $model]) ?>
        </select>

        <div class="help-block"></div>
    </div>

    <?php if (count($params) >= 1) : ?>
    <?php $firstKey = array_key_first($params); ?>
        <ul class="nav nav-tabs">
            <?php foreach ($params as $key => $value): ?>
                <li class="nav-item <?= $key === $firstKey ? 'active' : ''?>">
                    <a class="nav-link" data-toggle="tab" href="#description-<?= $value ?>"><?= $key ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($params as $key => $value): ?>
                <div class="tab-pane fade <?= $key === $firstKey ? 'active in' : ''?>" id="description-<?= $value ?>">
                    <?php if (isset($model->name) && !empty($model->name)) {
                        $data = unserialize($model->name);
                        $name = $data[$value];
                    }
                    if (isset($model->name) && !empty($model->name)) {
                        $data = unserialize($model->keywords);
                        $keywords = $data[$value];
                    }
                    if (isset($model->name) && !empty($model->name)) {
                        $data = unserialize($model->description);
                        $description = $data[$value];
                    }
                    ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'name' => 'Lang[name][' . $value . ']', 'value' => isset($name) && !empty($name) ? $name : '']) ?>

                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'name' => 'Lang[keywords][' . $value . ']', 'value' => isset($keywords) && !empty($keywords) ? $keywords : '']) ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'name' => 'Lang[description][' . $value . ']', 'value' => isset($description) && !empty($description) ? $description : '']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
