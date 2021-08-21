<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 25.03.2020
 * Time: 16:58
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php Pjax::begin(['id' => 'products-search-session']); ?>
<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'products-search',
        'data-pjax' => true,
    ],
]);
?>
<?= Html::submitButton('Искать', ['class' => 'btn btn-primary search-btn', 'id' => 'search', 'name' => 'search', 'value' => 'search', 'data-pjax' => 1]) ?>
<?= Html::submitButton('Обнулить', ['class' => 'btn btn-primary reset-btn', 'id' => 'reset', 'name' => 'reset', 'value' => 'reset', 'data-pjax' => 1]) ?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <label for="name">Имя товара</label>
            <input type="text" name="name" id="name" value="<?= $name ?>">
        </div>
        <div class="col-md-4">
            <label for="price">Цена</label>
            <input type="text" name="price" id="price" value="<?= $price ?>">
        </div>
        <div class="col-md-4"></div>
        <div class='clearfix'></div>
        <?php if (isset($dataProvider)) : ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'layout' => "{items}<div class='clearfix'></div>\n{pager}\n{summary}",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_list_item', ['model' => $model]);
                },
                'viewParams' => ['comment' => '213'],
                'itemOptions' => [
                    'tag' => false,
                ],
                'pager' => [
                    'firstPageLabel' => '<<',
                    'lastPageLabel' => '>>',
                    'nextPageLabel' => 'next',
                    'prevPageLabel' => 'previous',
                    'maxButtonCount' => 6
                ],
            ]); ?>
        <?php endif; ?>
    </div>
</div>
<script>
    $("document").ready(function () {
        $('#reset').on('click', function () {
            $('input').val('');
        })
    });
</script>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
