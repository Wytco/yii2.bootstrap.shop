<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-12">
        <h1>Страница с моделями создание</h1>
        <!--        Сообщение об сохранении пример 2-->
        <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <h2>Сообщение сохранено</h2>
        <?php endif; ?>

        <?php $form = ActiveForm::begin([
            'id' => 'entry-form',
            //Включить выключить валидацию
//            'enableClientValidation' => true,
            'options' => [
                'class' => 'form-horizontal'
            ],
            //Для всей формы
            'fieldConfig' => [
                'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                'labelOptions' => ['class' => 'col-md-2 control-label']
            ]
        ]); ?>

        <?= $form->field($model, 'code', [
            'enableAjaxValidation' => true,
            'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
            'labelOptions' => ['class' => 'col-md-2 control-label']
        ])->textInput() ?>

        <?= $form->field($model, 'name', [
            'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
            'labelOptions' => ['class' => 'col-md-2 control-label']
        ])->textInput() ?>

        <?= $form->field($model, 'population', [
            'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
            'labelOptions' => ['class' => 'col-md-2 control-label']
        ])->textInput() ?>

        <?= $form->field($model, 'status')->checkbox([
            'template' => "{label} \n <div class='col-md-5'> {input} </div> \n <div class='col-md-5'> {hint} </div> \n <div class='col-md-5'> {error} </div>",
            'labelOptions' => ['class' => 'col-md-2 control-label'],
        ], false) ?>

        <div class="form-group">
            <div class='col-md-5 col-md-offset-2'>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-block', 'name' => 'entry-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
