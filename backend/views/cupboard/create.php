<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 22.03.2020
 * Time: 15:58
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>

<div class="cupboard">
    <h3>Шкаф</h3>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <?php Pjax::begin(['id' => 'cupboard']) ?>
            <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

            <div class="col-md-3">
                <?= $form->field($model, 'width')->textInput(['value' => isset($width) ? $width : '', 'maxlength' => 255, 'placeholder' => 'Ширина шкафа']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'height')->textInput(['value' => isset($height) ? $height : '', 'maxlength' => 255, 'placeholder' => 'Высота шкафа']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'length')->textInput(['value' => isset($length) ? $length : '', 'maxlength' => 255, 'placeholder' => 'Глубина шкафа']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'col')->textInput(['value' => isset($col) ? $col : '', 'maxlength' => 255, 'placeholder' => 'Столбцов шкафа']) ?>
            </div>
            <div class="clearfix"></div>

            <div id="rows" class="rows">
                <?php if (isset($col) && !empty($col)) : ?>
                    <?php for ($i = 1; $i <= $col; $i++) : ?>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label class="control-label" for="cupboard-row-label-<?= $i ?>">Количество рядов в
                                    Столбце <?= $i ?></label>
                                <input oninput="FunctionRowCol(<?= $i ?>);" class="form-control"
                                       value="<?= isset($row) && !empty($row) ? $row[$i] : '' ?>"
                                       id="cupboard-row-label-<?= $i ?>" type="text" name="Cupboard[row][<?= $i ?>]">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="cupboard-row-width-label-<?= $i ?>">Ширниа рядов в
                                    Столбце <?= $i ?></label>
                                <input class="form-control"
                                       value="<?= isset($row_width) && !empty($row_width) ? $row_width[$i] : '' ?>"
                                       id="cupboard-row-width-label-<?= $i ?>" type="text"
                                       name="Cupboard[row-width][<?= $i ?>]">
                            </div>
                            <div id="cupboard-col-<?= $i ?>"></div>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <div class="image">
                <div class="left col-md-6">
                    <div id="messages"></div>
                    <div id="table">
                        <?php if (isset($col) && !empty($col)) : ?>
                            <?php for ($i = 1; $i <= $col; $i++) : ?>
                                <div class="table-row" id="table-row-<?= $i ?>"
                                     style="<?= isset($row_width) && !empty($row_width) ? 'width:' . ($row_width[$i] / 10) . 'px;' : '' ?>">
                                    <?php if (isset($row) && !empty($row)) : ?>
                                        <?php for ($j = 1; $j <= $row[$i]; $j++) : ?>
                                            <div class="table-col" id="table-col-<?= $j ?>">321</div>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="right col-md-6">

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['name' => 'Cupboard[send-btn]', 'id' => 'send-btn', 'value' => 'send-btn', 'class' => 'btn btn-success']) ?>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    // $("#cupboard-col").change(function () {
                    //     console.log($(this).val());
                    // });

                    $('#cupboard-col').on('input', function () {
                        var colichestvo = $(this).val(),
                            width = $('#cupboard-width').val(),
                            height = $('#cupboard-height').val(),
                            item = '',
                            table_item = '';
                        $('#rows').html('');
                        $('#table tr').html('');
                        let i = 1;
                        while (i <= colichestvo) {
                            item += '<div class="col-md-6"><div class="col-md-6"><label class="control-label" for="cupboard-row-label-' + i + '">Количество рядов в Столбце ' + i + '</label><input oninput="FunctionRowCol(' + i + ');" class="form-control" id="cupboard-row-label-' + i + '" type="text" name="Cupboard[row][' + i + ']" ></div>' +
                                '<div class="col-md-6"><label class="control-label" for="cupboard-row-width-label-' + i + '">Ширина рядов в Столбце ' + i + '</label><input oninput="FunctionRowColWidth(' + i + ');" class="form-control" id="cupboard-row-width-label-' + i + '" type="text" name="Cupboard[row-width][' + i + ']" ></div><div id="cupboard-row-' + i + '"></div></div>';
                            table_item += '<div class="table-row" id="table-row-' + i + '">' + i + '</div>';
                            i++;
                        }
                        $('#rows').html(item + '<div class="clearfix"></div>');
                        $('#table').html(table_item);
                        $('#table .table-row').css({'width': (width / 10)*2 + 'px', 'height': (height / 10)*2 + 'px'});

                    });
                });

                function FunctionRowCol(x) {
                    var val = $('#cupboard-row-label-' + x).val(),
                        item_col = '',
                        table_item_col = '';
                    let j = 1;
                    while (j <= val) {
                        table_item_col += '<div class="table-col" id="table-col-' + x + '-' + j + '">' + x + '-' + j + '</div>';
                        item_col += '<div class="col-md-6"><label class="control-label" for="cupboard-row-col-height-label-' + x + '-' + j + '">Высота ряда ' + j + '</label><input oninput="FunctionRowColHeight(' + x + ',' + j + ');" class="form-control" id="cupboard-row-col-height-label-' + x + '-' + j + '" type="text" name="Cupboard[row-col-height][' + x + '][' + j + ']" > <select name="select" id="row-col-height-select-' + x + '-' + j + '" onchange="FunctionRowColSelect(' + x + ',' + j + ')"><option value="0">No</option><option value="1">Yes</option></select> <div id="cupboard-row-col-height-' + x + '-' + j + '"></div></div>';
                        j++;
                    }
                    $('#table-row-' + x).html(table_item_col);
                    $('#cupboard-row-' + x).html(item_col);

                }

                function arraySum(array) {
                    var sum = 0;
                    for (var i = 0; i < array.length; i++) {
                        sum += array[i];
                    }
                    return sum;
                }

                function FunctionRowColWidth(x) {
                    var input = $('#cupboard-row-width-label-' + x).val(),
                        container = $('#table-row-' + x),
                        col_cols = $('#cupboard-col').val(),
                        input_width = [],
                        cupboard_width = $('#cupboard-width').val();
                    container.css({'width': (input / 10)*2 + 'px'});

                    let i = 1;
                    while (i <= col_cols) { // выводит 0, затем 1, затем 2
                        input_width.push(Number($('#cupboard-row-width-label-' + i).val()));
                        i++;
                    }

                    var result = arraySum(input_width);
                    if (cupboard_width > result || cupboard_width < result) {
                        $('#messages').html('<span class="text-danger">Ширина колонок меньше или больше ширины шкафа!</span>');
                    } else {
                        $('#messages').html('');

                    }
                }

                function FunctionRowColHeight(x, y) {
                    var height = $('#cupboard-row-col-height-label-' + x + '-' + y).val(),
                        col_cols = $('#cupboard-col').val(),
                        input_height = [],
                        cupboard_height = $('#cupboard-height').val();
                    $('#table-col-' + x + '-' + y).css({'height': (height / 10)*2 + 'px'});
                    // $('#table-col-' + x + '-' + y).html('<div class="transform">' + height + 'mm</div>');

                    let i = 1;
                    while (i <= col_cols) { // выводит 0, затем 1, затем 2
                        input_height.push(Number($('#cupboard-row-col-height-label-' + x + '-' + i).val()));
                        i++;
                    }

                    var result = arraySum(input_height);
                    if (cupboard_height > result || cupboard_height < result) {
                        $('#messages').html('<span class="text-danger">Высота створки меньше или больше высоты шкафа!</span>');
                    } else {
                        $('#messages').html('');
                    }
                }

                function FunctionRowColSelect(x, y) {
                    var select = $('#row-col-height-select-' + x + '-' + y).val(),
                        container = $('#cupboard-row-col-height-' + x + '-' + y);
                    if (select == 1) {
                        container.html('<div class="col-md-12"><label class="control-label" for="cupboard-row-col-height-col-label-' + x + '-' + y + '">Кол столбцов</label><input oninput="FunctionRowColHeightCol(' + x + ',' + y + ');" class="form-control" id="cupboard-row-col-height-col-label-' + x + '-' + y + '" type="text" name="Cupboard[row-col-height-col][' + x + '][' + y + ']" ><div id="cupboard-row-col-height-col-' + x + '-' + y + '"></div></div>');
                    } else {
                        container.html('');
                        $('#table-col-' + x + '-' + y).html('');
                    }
                }

                function FunctionRowColHeightCol(x, y) {
                    var val = $('#cupboard-row-col-height-col-label-' + x + '-' + y).val(),
                        table_item_col = '',
                        table_item_col_with = '',
                        container = $('#cupboard-row-col-height-col-' + x + '-' + y),
                        width = '';
                    let j = 1;
                    while (j <= val) {
                        table_item_col += '<div class="table-col-col" id="table-col-col-' + x + '-' + j + '">' + x + '-' + y + '-' + j + '</div>';
                        j++;
                    }
                    $('#table-col-' + x + '-' + y).html(table_item_col + '<div class="clearfix"></div>');
                    let i = 1;
                    if (val > 1) {
                        while (i <= val) {
                            table_item_col_with += '<div class="col-md-6"><label class="control-label" for="cupboard-row-col-height-col-width-label-' + x + '-' + y + '-' + i + '">Ширина столбца</label><input oninput="FunctionRowColHeightColWidth(' + x + ',' + y + ',' + i + ');" class="form-control" id="cupboard-row-col-height-col-width-label-' + x + '-' + y + '-' + i + '" type="text" name="Cupboard[row-col-height-col-width][' + x + '][' + y + '][' + i + ']" ><div id="cupboard-row-col-height-col-width-' + x + '-' + y + '-' + i + '"></div></div>'
                            $('#table-col-' + x + '-' + y + ' #table-col-col-' + x + '-' + i).css({
                                'width': (100 / val)*2 + '%',
                                'float': 'left',
                                'height': '100%',
                                'border-right': '1px solid black'
                            });
                            i++;
                        }
                    } else {
                        $('#table-col-' + x + '-' + y + ' #table-col-col-' + x + '-' + y).css({
                            'width': (100 / val)*2 + '%',
                            'float': 'left',
                            'height': '100%',
                            'border-right': '1px solid black'
                        });
                    }

                    container.html(table_item_col_with + '<div id="cupboard-row-col-height-col-width-' + x + '-' + y + '"></div>');
                }

                function FunctionRowColHeightColWidth(x, y, z) {
                    var width = $('#cupboard-row-col-height-col-width-label-' + x + '-' + y + '-' + z).val(),
                        container = $('#cupboard-row-col-height-col-width-' + x + '-' + y + '-' + z);
                    $('#table-col-' + x + '-' + y + ' #table-col-col-' + x + '-' + z).css({
                        'width': ((width / 10)*2) - 1 + 'px',
                        'float': 'left',
                        'height': '100%',
                        'border-right': '1px solid black'
                    });
                    container.html('<select name="select" id="row-col-height-select-row-' + x + '-' + y + '-' + z + '" onchange="FunctionRowColSelectRow(' + x + ',' + y + ',' + z + ')"><option value="0">No</option><option value="1">Yes</option></select>' + '<div id="cupboard-row-col-height-col-width-row-' + x + '-' + y + '-' + z + '"></div>');


                    var col_cols = $('#cupboard-row-col-height-col-label-' + x + '-' + y).val(),
                        input_width = [],
                        cupboard_width = $('#cupboard-row-width-label-' + x).val();
                    let i = 1;
                    while (i <= col_cols) { // выводит 0, затем 1, затем 2
                        input_width.push(Number($('#cupboard-row-col-height-col-width-label-' + x + '-' + y + '-' + i).val()));
                        i++;
                    }

                    var result = arraySum(input_width);
                    // console.log(x + '-' + y + '-' + z);
                    // console.log(cupboard_width);
                    if (cupboard_width > result || cupboard_width < result) {
                        $('#messages').html('<span class="text-danger">Ширина створки ' + x + ' меньше или больше ширины заданой створки шкафа!</span>');
                    } else {
                        $('#messages').html('');
                    }
                }

                function FunctionRowColSelectRow(x, y, z) {
                    var container = $('#cupboard-row-col-height-col-width-row-' + x + '-' + y + '-' + z),
                        select = $('#row-col-height-select-row-' + x + '-' + y + '-' + z).val();

                    if (select == 1) {
                        container.html('<label class="control-label" for="cupboard-row-col-height-col-width-row-label-' + x + '-' + y + '-' + z + '">Кол полок</label><input oninput="FunctionRowColHeightColWidthCol(' + x + ',' + y + ',' + z + ');" class="form-control" id="cupboard-row-col-height-col-width-row-label-' + x + '-' + y + '-' + z + '" type="text" name="Cupboard[row-col-height-col-width-row][' + x + '][' + y + '][' + z + ']" ><div id="cupboard-row-col-height-col-width-row-label-height-' + x + '-' + y + '-' + z + '"></div>');
                    } else {
                        container.html('');
                        $('#table-col-col-' + x + '-' + z).html( x + '-' + y + '-' + z);
                    }
                    console.log(x + '-' + y + '-' + z);
                }

                function FunctionRowColHeightColWidthCol(x, y, z) {
                    var container = $('#table-col-' + x + '-' + y + ' #table-col-col-' + x + '-' + z),
                        input = $('#cupboard-row-col-height-col-width-row-label-' + x + '-' + y + '-' + z).val(),
                        table_item_col_row = '',
                        table_item_col_row_height = '';
                    let j = 1;
                    while (j <= input) {
                        table_item_col_row += '<div class="table-col-col-row" id="table-col-col-row-' + x + '-' + j + '">' + x + '-' + y + '-' + z + '-' + j + '</div>';
                        j++;
                    }
                    container.html(table_item_col_row);

                    let i = 1;
                    while (i <= input) {
                        $('#table-col-' + x + '-' + y + ' #table-col-col-' + x + '-' + z + ' #table-col-col-row-' + x + '-' + i).css({
                            'border-bottom': '1px solid black'
                        });
                        i++;
                    }
                    let a = 1;
                    while (a <= input) {
                        table_item_col_row_height += '<label class="control-label" for="cupboard-row-col-height-col-width-row-height-label-' + x + '-' + y + '-' + z + '-' + a + '">Высота полоки</label><input oninput="FunctionRowColHeightColWidthColHegiht(' + x + ',' + y + ',' + z + ',' + a + ');" class="form-control" id="cupboard-row-col-height-col-width-row-height-label-' + x + '-' + y + '-' + z + '-' + a + '" type="text" name="Cupboard[row-col-height-col-width-row-height][' + x + '][' + y + '][' + z + '][' + a + ']" >';
                        a++;
                    }
                    $('#cupboard-row-col-height-col-width-row-label-height-' + x + '-' + y + '-' + z).html(table_item_col_row_height);

                }

                function FunctionRowColHeightColWidthColHegiht(x, y, z, a) {
                    var input = $('#cupboard-row-col-height-col-width-row-height-label-' + x + '-' + y + '-' + z + '-' + a).val();
                    $('#table-col-' + x + '-' + y + ' #table-col-col-' + x + '-' + z + ' #table-col-col-row-' + x + '-' + a).css({
                        'height': (input / 10)*2 + 'px'
                    });
                    console.log(x + ' - ' + y + ' - ' + z + ' - ' + a);
                    var col_cols = $('#cupboard-row-col-height-col-width-row-label-' + x + '-' + y +'-'+z).val(),
                        input_height = [],
                        cupboard_height = $('#cupboard-row-col-height-label-' + x + '-' + y).val();
                    let i = 1;
                    while (i <= col_cols) { // выводит 0, затем 1, затем 2
                        input_height.push(Number($('#cupboard-row-col-height-col-width-row-height-label-' + x + '-' + y + '-' + z + '-' + i).val()));
                        i++;
                    }

                    var result = arraySum(input_height);

                    console.log(col_cols);
                    console.log(input_height);
                    console.log(result);
                    console.log(cupboard_height);
                    if (cupboard_height > result || cupboard_height < result) {
                        $('#messages').html('<span class="text-danger">Ширина створки ' + x + ' меньше или больше ширины заданой створки шкафа!</span>');
                    } else {
                        $('#messages').html('');
                    }
                }
            </script>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end() ?>

            <?php
            $this->registerJs(
                '
//    $("document").ready(function () {
//        $("#chat").on("pjax:complete", function () {
//           $.pjax.reload({container:"#chat-list"});  //Reload GridView
//        });
//         $("#chat-list").on("pjax:complete", function () {
////          $(".list").animate({scrollTop: $("#scroll").offset().top}, 2000);
//          $(".list").animate({scrollTop: $("#scroll").offset().top}, 100);
//        });
//        setInterval(function(){ $("#refresh-btn").click(); }, 7000);
//    });
    '
            );
            ?>
        </div>
    </div>
</div>
