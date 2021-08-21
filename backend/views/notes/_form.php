<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\notes\models\Notes */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_note").on("pjax:end", function() {
            $.pjax.reload({container:"#notes"});  //Reload GridView
        });
    });'
);
?>

<div class="notes-form">
    <?php Pjax::begin(['id' => 'new_note']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <?= $message  ?>
    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]),

    ]); ?>

<!--    --><?//= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
//        'language' => 'ru',
//        'dateFormat' => 'dd-MM-yyyy',
//    ]) ?>

    <?php
    echo '<label>Дата окончания</label>';
    echo DatePicker::widget([
        'name' => 'Notes[date]',
        'value' => date('d-m-Y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите время','style'=>'z-index: 1;'],
        'language' => 'ru',
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
