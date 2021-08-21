<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 23.03.2020
 * Time: 20:52
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<a href="/admin/cupboard/create">Создать</a>
<div class="clearfix" style="padding-bottom: 35px"></div>
<?php
foreach ($model as $item) {
    echo '<div class="cupboard">';
    $cupboard_code = unserialize($item['code']);
    for ($x = 1; $x <= count($cupboard_code); $x++) {
        $col_width = $cupboard_code[$x]['row_width'];
        $col_height = $cupboard_code[$x]['height'];
        $col = $cupboard_code[$x]['col'];
//Количество столбцов в ряду в створке 1 ряд
        $row_col_height_col = $cupboard_code[$x]['row-col-height-col'];
        echo '<div style="float:left;width:' . ($col_width / 10) . 'px;">';
        for ($z = 1; $z <= count($cupboard_code[$x]['row-col-height']); $z++) {
            echo '<div style="border:1px solid black;height:' . ($cupboard_code[$x]['row-col-height'][$z] / 10) . 'px;">';
            for ($j = 1; $j <= count($row_col_height_col[$z]['col-width']); $j++) {
                echo '<div style="float:left;border:1px solid black;width: ' . (($row_col_height_col[$z]['col-width'][$j] / 10) - 1) . 'px;height:' . ($cupboard_code[$x]['row-col-height'][$z] / 10) . 'px;">';
                for ($y = 1; $y <= count($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']); $y++) {
                    echo '<div style="border-bottom:1px solid black;height: ' . (($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'][$y] / 10)) . 'px;">';
//            echo  $row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'][$y];
                    echo '</div>';
                }
                echo '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
    }
    echo '</div>';
    echo '<div style="text-align: center;float: left;margin-left: 150px;">';
    echo '<a href="' . Url::to(['view', 'id' => $item->id]) . '">Просмотреть</a>';
    echo '<h3>Технические характеристики (Габариты) : </h3>';
    echo '<table class="table">';
    echo '<thead><tr><th style="text-align: center;">id</th><th style="text-align: center;">Глубина</th><th style="text-align: center;">Ширина</th><th style="text-align: center;">Высота</th></tr></thead>';
    for ($x = 1; $x <= count($cupboard_code); $x++) {
        $col_width = $cupboard_code[$x]['row_width'];
        $col_height = $cupboard_code[$x]['height'];
        $col_length = $cupboard_code[$x]['length'];
        $col = $cupboard_code[$x]['col'];
//Количество столбцов в ряду в створке 1 ряд
        $row_col_height_col = $cupboard_code[$x]['row-col-height-col'];

        for ($z = 1; $z <= count($cupboard_code[$x]['row-col-height']); $z++) {
            if (!isset($row_col_height_col[$z]['col-width']) && empty($row_col_height_col[$z]['col-width'])) {
                echo '<tr><td>' . $x . '-' . $z . '</td><td>' . $col_length . 'мм</td><td>' . $col_width . 'мм</td><td>' . $cupboard_code[$x]['row-col-height'][$z] . 'мм</td></tr>';
            }
            for ($j = 1; $j <= count($row_col_height_col[$z]['col-width']); $j++) {

                if (!isset($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']) && empty($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'])) {
                    echo '<tr><td>' . $x . '-' . $z . '-' . $j . '</td><td>' . $col_length . 'мм</td><td>' . $row_col_height_col[$z]['col-width'][$j] . 'мм</td><td>' . $cupboard_code[$x]['row-col-height'][$z] . 'мм</td></tr>';
                }
                for ($y = 1; $y <= count($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']); $y++) {
                    echo '<tr><td>' . $x . '-' . $z . '-' . $j . '-' . $y . '</td><td>' . $col_length . 'мм</td><td>' . $row_col_height_col[$z]['col-width'][$j] . 'мм</td><td>' . $row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'][$y] . 'мм</td></tr>';
                }

            }
        }

    }
    echo '</table>';
    echo '</div>';
    echo '<div class="clearfix" style="padding-bottom: 35px"></div>';
}
?>
<div class="pagination-list">
    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>
