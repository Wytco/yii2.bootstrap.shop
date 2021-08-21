<?php

use backend\components\MenuWidget;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'product']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'save', 'value' => 'save']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'category_id',
                'value' => function ($data) {
                    $name = unserialize($data->category->name);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value="">
        <select class="hidden" name="Product[' . $data->id . '][category_id]">
            '.MenuWidget::widget(['template' => 'select-products-category', 'model' => $data]) .'
        </select>
<div class="hide_div_category_' . $data->id . '" onclick="openSelectCategory(' . $data->id . ')">' . $name[$firstKey] . '</div>';
//                    return $data->category->name;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value=""><input class="hidden" id="open_input_name_' . $data->id . '" type="text" name="Product[' . $data->id . '][name]" value="' . $data->name . '"><div class="hide_div_name_' . $data->id . '" onclick="openInputName(' . $data->id . ')">' . $data->name . '</div>';
                },
                'format' => 'raw',
            ],
//            'content:ntext',
            [
                'attribute' => 'price',
                'value' => function ($data) {
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value=""><input class="hidden" id="open_input_price_' . $data->id . '" type="text" name="Product[' . $data->id . '][price]" value="' . $data->price . '"><div class="hide_div_price_' . $data->id . '" onclick="openInputPrice(' . $data->id . ')">' . $data->price . '</div>';
                },
                'format' => 'raw',
            ],
            //'keywords',
            //'description',

            [
                'attribute' => 'img',
                'value' => function ($data) {
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value=""><img width="100px" src="'.$data->img.'">';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'hit',
                'filter' => ["0" => "Активно", "1" => "Не активно"],
                'value' => function ($data) {
                    if ($data->hit == 1) {
                        $action = "<span class=\"text-success\">Активно</span>";
                        $active_1 = 'selected';
                    } else {
                        $action = "<span class=\"text-danger\">Не активно</span>";
                        $active_0 = 'selected';
                    }
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value=""><select class="hidden" name="Product[' . $data->id . '][hit]" id=""><option ' . $active_1 . ' value="1">Активно</option><option ' . $active_0 . ' value="0">Не активно</option></select><div class="hide_div_hit_' . $data->id . '" onclick="openSelectHit(' . $data->id . ')">' . $action . '</div>';
//                    return $data->hit == 1 ? '<span class="text-success">Активно</span>' : '<span class="text-danger">Не активно</span>';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'new',
                'value' => function ($data) {
                    if ($data->new == 1) {
                        $action = "<span class=\"text-success\">Активно</span>";
                        $active_1 = 'selected';
                    } else {
                        $action = "<span class=\"text-danger\">Не активно</span>";
                        $active_0 = 'selected';
                    }
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value=""><select class="hidden" name="Product[' . $data->id . '][new]" id=""><option ' . $active_1 . ' value="1">Активно</option><option ' . $active_0 . ' value="0">Не активно</option></select><div class="hide_div_new_' . $data->id . '" onclick="openSelectNew(' . $data->id . ')">' . $action . '</div>';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'sale',
                'value' => function ($data) {
                    if ($data->sale == 1) {
                        $action = "<span class=\"text-success\">Активно</span>";
                        $active_1 = 'selected';
                    } else {
                        $action = "<span class=\"text-danger\">Не активно</span>";
                        $active_0 = 'selected';
                    }
                    return '<input type="hidden" name="Product[' . $data->id . '][change]" value=""><select class="hidden" name="Product[' . $data->id . '][sale]" id=""><option ' . $active_1 . ' value="1">Активно</option><option ' . $active_0 . ' value="0">Не активно</option></select><div class="hide_div_sale_' . $data->id . '" onclick="openSelectSale(' . $data->id . ')">' . $action . '</div>';
                },
                'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <script>
        function openInputName(x) {
            $('input[name="Product[' + x + '][change]"').val(x);
            $('input[name="Product[' + x + '][name]"').removeClass('hidden');
            $('.hide_div_name_' + x).addClass('hidden');
        };

        function openInputPrice(x) {
            $('input[name="Product[' + x + '][change]"').val(x);
            $('input[name="Product[' + x + '][price]"').removeClass('hidden');
            $('.hide_div_price_' + x).addClass('hidden');
        };

        function openSelectHit(x) {
            $('input[name="Product[' + x + '][change]"').val(x);
            $('select[name="Product[' + x + '][hit]"').removeClass('hidden');
            $('.hide_div_hit_' + x).addClass('hidden');
        };

        function openSelectNew(x) {
            $('input[name="Product[' + x + '][change]"').val(x);
            $('select[name="Product[' + x + '][new]"').removeClass('hidden');
            $('.hide_div_new_' + x).addClass('hidden');
        };

        function openSelectSale(x) {
            $('input[name="Product[' + x + '][change]"').val(x);
            $('select[name="Product[' + x + '][sale]"').removeClass('hidden');
            $('.hide_div_sale_' + x).addClass('hidden');
        };
        function openSelectCategory(x) {
            $('input[name="Product[' + x + '][change]"').val(x);
            $('select[name="Product[' + x + '][category_id]"').removeClass('hidden');
            $('.hide_div_category_' + x).addClass('hidden');
        };
        $("document").ready(function () {
            // $('.close').on('click', function () {
            //     var close = $(this).data('close');
            //     $('#' + close).removeClass('active');
            // })
        });
    </script>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
</div>


