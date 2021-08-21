<?php

use kartik\date\DatePicker;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\notes\models\NotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-index">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php Pjax::begin(['id' => 'notes']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

    <div id="my_modal_message" class="my_modal <?= isset($message) && !empty($message) ? 'active' : '' ?>">
        <div class="body">
            <div data-close="my_modal_message" class="close">x</div>
            <?= $message  ?>
        </div>
    </div>
    <div class="background <?= isset($message) && !empty($message) ? 'active' : '' ?>"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'text',
                'value' => function ($data) {
                    return '<div id="my_modal_' . $data->id . '" class="my_modal"><div class="body"><div data-close="my_modal_' . $data->id . '" class="close">x</div><h3>Редактировать</h3>' . CKEditor::widget([
                            'options' => ['id' => 'notes-text-' . $data->id, 'name' => 'Notes[' . $data->id . '][text]'],
                            'attribute' => 'text',
                            'model' => $data,
                            'editorOptions' => [
                                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false, //по умолчанию false
                            ]
                        ]) . '</div></div><input type="hidden" name="Notes[' . $data->id . '][changes]" value=""><input type="hidden" name="Notes[' . $data->id . '][id]" value="' . $data->id . '"><p>' . $data->text . '</p> <div data-pjax="0" onclick="updateInput(' . $data->id . ')">Редактировать</div>';
//                    return '<input type="hidden" name="Notes['.$data->id.'][changes]" value=""><input type="hidden" name="Notes['.$data->id.'][id]" value="'.$data->id.'"><input onchange="updateInput('.$data->id.')" id="input_'.$data->id.'" style="width:100%" type="text" name="Notes['.$data->id.'][text]" value="'.$data->text.'">';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'date',
                'value' => function ($data) {
                    return '<div id="my_modal_date_' . $data->id . '" class="my_modal"><div class="body"><div data-close="my_modal_date_' . $data->id . '" class="close">x</div><h3>Редактировать</h3>' . DatePicker::widget([
                            'name' => 'Notes[' . $data->id . '][date]',
                            'value' => date('d-m-Y', $data->date),
                            'options' => ['placeholder' => 'Выберите время','style'=>'z-index: 1;width: 50%;'],
                            'language' => 'ru',
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'todayHighlight' => true
                            ]
                        ]) . '</div></div><input type="hidden" name="Notes[' . $data->id . '][changes]" value=""><input type="hidden" name="Notes[' . $data->id . '][id]" value="' . $data->id . '"><p>' . date('d-m-Y', $data->date) . '</p> <div data-pjax="0" onclick="updateDate(' . $data->id . ')">Редактировать</div>';
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    echo Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'save', 'value' => 'save'])
    ?>

    <script>
        function updateInput(x) {
            $('input[name="Notes[' + x + '][changes]"').val(x);
            $('#my_modal_' + x).addClass('active');
            $('.background').addClass('active');
        };
        function updateDate(x) {
            $('input[name="Notes[' + x + '][changes]"').val(x);
            $('#my_modal_date_' + x).addClass('active');
            $('.background').addClass('active');
        };
        $("document").ready(function () {
            $('.close').on('click', function () {
                var close = $(this).data('close');
                $('#' + close).removeClass('active');
                $('.background').removeClass('active');
            });

            $('.background').on('click', function () {
                $('.my_modal').removeClass('active');
                $('.background').removeClass('active');
            })
        });
    </script>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

</div>
