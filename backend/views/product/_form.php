<?php

use backend\components\MenuWidget;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="product-form">

    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!--    --><? //= $form->field($model, 'category_id')->textInput() ?>

    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Категория</label>
        <select id="category-parent_id" class="form-control" name="Product[category_id]" aria-invalid="false">
            <?= MenuWidget::widget(['template' => 'select-products-category', 'model' => $model]) ?>
        </select>

        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'price')->textInput() ?>

    <?php if (count($params) >= 1) : ?>
        <ul class="nav nav-tabs">
            <?php   foreach ($params as $key => $value): ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#description-<?= $value ?>"><?= $key ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="description">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'content')->widget(CKEDITOR::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                        'editorOptions' => [
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                        ],
                    ]),

                ]); ?>

<!--                --><?//=  $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <?php foreach ($params as $key => $value): ?>
                <div class="tab-pane fade" id="description-<?= $value ?>">
                    <?php
                    if (isset($model->lang) && !empty($model->lang)) {
                        $data = unserialize($model->lang);
                        $result = $data[$value];
                        $name = $result['name'];
                        $content = $result['content'];
//                        $slug = $result['slug'];
                        $keywords = $result['keywords'];
                        $description = $result['description'];
                    }
                    ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'name' => 'Lang[' . $value . '][name]', 'value' => isset($name) && !empty($name) ? $name : '']) ?>
                    <?= CKEditor::widget([
                        'name' => 'Lang[' . $value . '][content]',
                         'value' => isset($content) && !empty($content) ? $content : '',
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                            'editorOptions' => [
                                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false, //по умолчанию false
                            ],
                        ]),
                    ]); ?>

<!--                    --><?//=  $form->field($model, 'slug')->textInput(['maxlength' => true, 'name' => 'Lang[' . $value . '][slug]', 'value' => isset($slug) && !empty($slug) ? $slug : '']) ?>

                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'name' => 'Lang[' . $value . '][keywords]', 'value' => isset($keywords) && !empty($keywords) ? $keywords : '']) ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'name' => 'Lang[' . $value . '][description]', 'value' => isset($description) && !empty($description) ? $description : '']) ?>

                </div>
            <?php endforeach; ?>

        </div>
    <?php else : ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(CKEDITOR::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]),

        ]); ?>

<!--        --><?//=  $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'imageFile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCaption' => false,
            'showUpload' => false,
        ],
    ]); ?>
    <?php if (isset($model->img) && !empty($model->img)) : ?>
        <?= Html::img($model->img, ['alt' => $model->name, 'width' => '50']) ?>
    <?php endif; ?>

<!--    --><?//= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'imageFiles[]')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*','multiple' => true],
        'pluginOptions' => [
            'showCaption' => false,
            'showUpload' => false,
        ],
    ]); ?>

    <?php if (isset($model->gallery) && !empty($model->gallery)) : ?>

        <?php foreach (unserialize($model->gallery) as $item) : ?>
            <?= Html::img($item, ['alt' => $model->name, 'width' => '50']) ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?= $form->field($model, 'hit')->checkbox() ?>

    <?= $form->field($model, 'new')->checkbox() ?>

    <?= $form->field($model, 'sale')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
