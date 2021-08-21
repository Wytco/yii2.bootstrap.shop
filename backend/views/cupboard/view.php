<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 23.03.2020
 * Time: 18:57
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

$cupboard_code = unserialize($model->code);
//dd($cupboard_code[1]);
?>

<?php
echo '<div style="text-align: center;">';


for ($x = 1; $x <= count($cupboard_code); $x++) {
    $col_width = $cupboard_code[$x]['row_width'];
    $col_height = $cupboard_code[$x]['height'];
    $col = $cupboard_code[$x]['col'];
//Количество столбцов в ряду в створке 1 ряд
    $row_col_height_col = $cupboard_code[$x]['row-col-height-col'];
    echo '<div style="float:left;width:' . (($col_width / 10)*2) . 'px;">';
    for ($z = 1; $z <= count($cupboard_code[$x]['row-col-height']); $z++) {
        echo '<div style="border:1px solid black;height:' . (($cupboard_code[$x]['row-col-height'][$z] / 10)*1.5) . 'px;">';
        if(!isset($row_col_height_col[$z]['col-width']) && empty($row_col_height_col[$z]['col-width'])){
            echo $x.'-'.$z;
        }
        for ($j = 1; $j <= count($row_col_height_col[$z]['col-width']); $j++) {
            echo '<div style="float:left;border:1px solid black;width: ' . ((($row_col_height_col[$z]['col-width'][$j] / 10)*2) - 1) . 'px;height:100%;">';
            if(!isset($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']) && empty($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'])){
                echo $x.'-'.$z.'-'.$j;
            }
            for ($y = 1; $y <= count($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']); $y++) {
                echo '<div style="border-bottom:1px solid black;height: ' . ((($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'][$y] / 10)*1.5) - 1) . 'px;">';
                echo $x.'-'.$z.'-'.$j.'-'.$y;
                echo '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
    }
    echo '</div>';
}

echo '<div class="clearfix"></div>';
echo '<div style="text-align: center;">';
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
        if(!isset($row_col_height_col[$z]['col-width']) && empty($row_col_height_col[$z]['col-width'])){
            echo '<tr><td>'.$x.'-'.$z.'</td><td>'.$col_length.'мм</td><td>'.$col_width.'мм</td><td>'.$cupboard_code[$x]['row-col-height'][$z].'мм</td></tr>';
        }
        for ($j = 1; $j <= count($row_col_height_col[$z]['col-width']); $j++) {

            if(!isset($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']) && empty($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'])){
                echo '<tr><td>'.$x.'-'.$z.'-'.$j.'</td><td>'.$col_length.'мм</td><td>'.$row_col_height_col[$z]['col-width'][$j].'мм</td><td>'.$cupboard_code[$x]['row-col-height'][$z].'мм</td></tr>';
            }
            for ($y = 1; $y <= count($row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height']); $y++) {
                echo '<tr><td>'.$x.'-'.$z.'-'.$j.'-'.$y.'</td><td>'.$col_length.'мм</td><td>'.$row_col_height_col[$z]['col-width'][$j].'мм</td><td>'.$row_col_height_col[$z]['col-width-row'][$j]['col-width-row-height'][$y].'мм</td></tr>';
            }

        }
    }

}
echo '</table>';
echo '</div>';
echo '</div>';
?>

<!---->
<!--<div class="hidden">-->
<!--    <p>Количествое - створок -> --><?//= $count ?><!--</p>-->
<?php
//$col_width = $cupboard_code[1]['row_width'];
//$col_height = $cupboard_code[1]['height'];
//echo '<p>Ширина створки 1 ->  ' . $col_height . '</p>';
//
//$col = $cupboard_code[1]['col'];
//echo '<p>Количествое - рядов в створке 1 -> ' . $col . '</p>';
////Количество столбцов в ряду в створке 1 ряд
//$row_col_height_col = $cupboard_code[1]['row-col-height-col'];
//
//for ($z = 1; $z <= count($cupboard_code[1]['row-col-height']); $z++) {
//    echo '<p>Высота - ряда в створке 1 ряд ' . $z . ' -> ' . $cupboard_code[1]['row-col-height'][$z] . '</p>';
//}
//
//for ($i = 1; $i <= count($row_col_height_col); $i++) {
//    echo '<p>Количество столбцов - ряда в створке 1 ряд ' . $i . ' -> ' . $row_col_height_col[$i]['new_col'] . '</p>';
//    for ($j = 1; $j <= count($row_col_height_col[$i]['col-width']); $j++) {
//        echo '<p>Ширина столбца ' . $j . ' - ряда в створке 1 ряд ' . $i . ' -> ' . $row_col_height_col[$i]['col-width'][$j] . '</p>';
//    }
//    for ($x = 1; $x <= count($row_col_height_col[$i]['col-width-row']); $x++) {
//        echo '<p>Количество рядов в стоблце ' . $x . ' - ряда в створке 1 ряд ' . $i . ' -> ' . $row_col_height_col[$i]['col-width-row'][$x]['new_col_row'] . '</p>';
//        for ($y = 1; $y <= count($row_col_height_col[$i]['col-width-row'][$x]['col-width-row-height']); $y++) {
//            echo '<p>Высота ' . $y . ' столбцов рядов в стоблце ' . $x . ' - ряда в створке 1 ряд ' . $i . ' -> ' . $row_col_height_col[$i]['col-width-row'][$x]['col-width-row-height'][$y] . '</p>';
//        }
//    }
//}
//?>
<!--</div>-->
