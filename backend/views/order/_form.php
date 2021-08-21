<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
        ''
//    '$("document").ready(function () {
//        $("#order").on("pjax:complete", function () {
//            $("#modal-form").click();
////           $.pjax.reload({container:"#notes"});  //Reload GridView
//        });
//    });'
);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="order">
    <?php Pjax::begin(['id' => 'order']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

    <?= $form->field($model, 'search')->textInput(['value' => isset($search) ? $search : '']) ?>
    <div class="form-group">
        <?= Html::submitButton('Поиск', ['name' => 'search-btn', 'value' => 'search-btn', 'class' => 'btn btn-success']) ?>
    </div>

    <input id="order-delete" value="" type="hidden" name="Order[delete]">

    <div id="my_modal" class="my_modal <?= isset($message) && !empty($message) ? 'active' : '' ?>">
        <div class="body">
            <div data-close="my_modal_message" class="close">x</div>
            <h3><?= $message; ?></h3>
        </div>
    </div>
    <div class="background <?= isset($message) && !empty($message) ? 'active' : '' ?>"></div>

    <table class="table table-hover table-striped">
        <caption><h3>Выбраные товары</h3></caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Количествко</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody id="selected">
        <?php if (isset($products) && !empty($products)) : ?>
            <?php foreach ($products as $product_items) : ?>
                <tr id="delete_<?= $product_items['product_id'] ?>">
                    <th>
                        <input value="<?= $product_items['product_id'] ?>" type="hidden"
                               name="Order[products][product_id][]">
                        <input value="<?= $product_items['name'] ?>" type="hidden" name="Order[products][name][]">
                        <input value="<?= $product_items['price'] ?>" type="hidden" name="Order[products][price][]">
                        <?= $product_items['product_id'] ?>
                    </th>
                    <th><?= $product_items['name'] ?></th>
                    <td><?= $product_items['price'] ?></td>
                    <td><input value="<?= $product_items['qty_item'] ?>" type="number"
                               name="Order[products][qty_item][]"></td>
                    <td onclick="deleteItem(<?= $product_items['product_id'] ?>)">
                        Удалить
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <?= $form->field($model, 'name')->textInput(['value' => isset($name) ? $name : '', 'maxlength' => true, 'placeholder' => 'Имя заказчика']) ?>

    <?= $form->field($model, 'email')->input('email', ['value' => isset($email) ? $email : '', 'maxlength' => true, 'placeholder' => 'Email']) ?>

<!--    --><?//= $form->field($model, 'phone')->textInput(['value' => isset($phone) ? $phone : '', 'maxlength' => true, 'placeholder' => 'Номер телефона']) ?>

        <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
            'mask' => '999-999-9999',
            'value' => isset($phone) ? str_replace('_','',str_replace('-','',$phone)) : ''
        ]) ?>

    <?= $form->field($model, 'address')->textInput(['value' => isset($address) ? $address : '', 'maxlength' => true, 'placeholder' => 'Адрес']) ?>

    <!--    --><? //= $form->field($model, 'qty')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'status')->checkbox(['checked ' => isset($status) ? true : false]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['name' => 'save-btn', 'id' => 'save-btn', 'value' => 'save-btn', 'class' => 'btn btn-success']) ?>
    </div>
    <div class="products-block">
        <?php if (isset($order_items) && !empty($order_items)): ?>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Выбрать</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($order_items as $item): ?>
                    <tr>
                        <th scope="row"><?= $item->id ?></th>
                        <td><?= $item->name ?></td>
                        <td><?= $item->price ?></td>
                        <td>
                            <input id="product_input_<?= $item->id ?>" type="input" name="product-input"
                                   placeholder="Количество" value="1">
                        </td>
                        <td>
                            <input id="product_checkbox_<?= $item->id ?>" data-name="<?= $item->name ?>"
                                   data-price="<?= $item->price ?>" type="checkbox"
                                   name="product-checkbox" value="<?= $item->id ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="pagination-list">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>
    <script>
        $("document").ready(function () {
            $('input[name="product-checkbox"]').on('click', function () {
                var id = this.value,
                    name = $(this).data('name'),
                    price = $(this).data('price'),
                    input_col = $('#product_input_' + id).val();
                if ($(this).is(":checked")) {
                    $('#selected').append('<tr id="delete_' + id + '"><th><input value="' + id + '" type="hidden" name="Order[products][product_id][]"><input value="' + name + '" type="hidden" name="Order[products][name][]"><input value="' + price + '" type="hidden" name="Order[products][price][]">' + id + '</th><th>' + name + '</th><td>' + price + '</td><td><input value="' + input_col + '" type="number" name="Order[products][qty_item][]"></td> <td onclick="$(delete_' + id + ').remove();$(product_checkbox_' + id + ').prop(\'checked\', false);">Удалить</td> </tr>');
                    // alert("Checkbox is checked.");
                } else if ($(this).is(":not(:checked)")) {
                    $('#delete_' + id).remove();
                    // alert("Checkbox is unchecked.");
                }
            });
            $('.close').on('click', function () {
                $('.my_modal').removeClass('active');
                $('.background').removeClass('active');
            });

            $('.background').on('click', function () {
                $('.my_modal').removeClass('active');
                $('.background').removeClass('active');
            })
        });

        function deleteItem(x) {
            $('#delete_' + x).remove();
            $('#product_checkbox_' + x).prop('checked', false);
            var value = $('#order-delete').val();
            $('#order-delete').val(x + ',' + value);
        }
    </script>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>




