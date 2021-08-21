<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

//https://www.yiiframework.com/doc/api/2.0/yii-widgets-activeform

?>

    <div class="row">
        <div class="col-md-12">
            <h1>Страница с формой</h1>

            <!--        Сообщение об сохранении пример 2-->
            <?php if (Yii::$app->session->hasFlash('success')) : ?>
                <h2>Сообщение сохранено</h2>
            <?php endif; ?>

            <?php Pjax::begin([
                // Опции Pjax
            ]); ?>

            <?php $form = ActiveForm::begin([
                'id' => 'entry-form',
                //Включить выключить валидацию
                'enableClientValidation' => true,
                'options' => [
                    //Включить Pjax
                    'data' => ['pjax' => true],
                    'class' => 'form-horizontal'
                ],
                //Для всей формы
                'fieldConfig' => [
                    'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                    'labelOptions' => ['class' => 'col-md-2 control-label']
                ]
            ]); ?>

            <?= $form->field($model, 'name', [
                //Для определенного поля
                'enableAjaxValidation' => true,
                'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                'labelOptions' => ['class' => 'col-md-2 control-label']
            ])->hint('Заполните поле имя')->textInput(['autofocus' => true, 'placeholder' => 'Ваше имя']) ?>


            <?= $form->field($model, 'email', [
                    'enableAjaxValidation' => true,
                'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                'labelOptions' => ['class' => 'col-md-2 control-label']
            ])->textInput() ?>

            <?= $form->field($model, 'topic', [
                    'enableAjaxValidation' => true,
                'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                'labelOptions' => ['class' => 'col-md-2 control-label']
            ])->textInput() ?>

            <?= $form->field($model, 'text', [
                   'enableAjaxValidation' => true,
                'template' => "{label} \n <div class='col-md-5'>{input}</div> \n <div class='col-md-5'>{hint}</div> \n <div class='col-md-5'>{error}</div>",
                'labelOptions' => ['class' => 'col-md-2 control-label']
            ])->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <div class='col-md-5 col-md-offset-2'>
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-block', 'name' => 'entry-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>

        </div>
    </div>

<?php
// кусок js кода для Ajax
//https://www.yiiframework.com/doc/guide/2.0/ru/input-form-javascript
//ОБратить внимания на поля где включается валидация

$js = <<<JS
var form = $('#entry-form');
form.on('beforeSubmit',function() {
  var data = form.serialize();
  $.ajax({
    url : form.attr('action'),
    type : 'POST',
    data : data,
    success : function(res) {
        console.log(res);
        form[0].reset();
    },
     error : function() {
        alert('Error');
     }
  });
  return false;
})
JS;

$this->registerJs($js);
?>