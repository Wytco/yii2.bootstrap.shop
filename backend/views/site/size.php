<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 30.03.2020
 * Time: 10:22
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<table border="0" width="100%">
    <tbody>
    <tr>
        <td valign="top">
            <?= Html::img('/admin/img/14300.jpg', []) ?>
        </td>
        <td valign="top" style="padding-left: 50px;">
            <p><strong>A Обхват груди.</strong> Оберните сантиметр вокруг самой объемной и выступающей части груди,
                наполовину вдохните и зафиксируйте объем.</p>
            <p><strong>B Обхват талии.</strong> Оберните сантиметр вокруг самой тонкой части талии, измеряйте на
                полувдохе. Не втягивайте и не надувайте живот во время измерения.</p>
            <p><strong>C Обхват бедер.</strong> Измеряется по самой объемной части ягодиц, примерно на уровне
                тазобедренных суставов.</p>
            <p><strong>D Ширина плеча.</strong> Держа сантиметр перед собой, зафиксируйте расстояние от края одного
                плеча до края другого. Не нужно оборачивать плечи по кругу, для этой мерки нужен «полуобхват».</p>
            <p><strong>E Длина рукава.</strong> Вытянув руку наполовину, или держа прямо, но ни в коем случае, не
                сгибая, измерьте расстояние от плеча до запястья.</p>
            <p><strong>G Обхват шеи.</strong> Измеряется основания шеи непосредственно над ключицей.</p>
            <p><strong>F Длина ноги.</strong> Стоя прямо, измерьте расстояние от паха до косточки на лодыжке.</p>
        </td>
    </tr>
    </tbody>
</table>
<?php Pjax::begin(['id' => 'cupboard']) ?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
<div class="col-md-3">
    <label for="man-a">Обхват груди</label>
    <input id="man-a" type="text" name="Man[A]" placeholder="Обхват груди" <?= $A ? 'value="'.$A.'"' : '' ?>>
</div>
<div class="col-md-3">
    <label for="man-b">Обхват талии</label>
    <input id="man-b" type="text" name="Man[B]" placeholder="Обхват талии" <?= $B ? 'value="'.$B.'"' : '' ?>>
</div>
<div class="col-md-3">
    <label for="man-c">Обхват бедер</label>
    <input id="man-c" type="text" name="Man[C]" placeholder="Обхват бедер" <?= $C ? 'value="'.$C.'"' : '' ?>>
</div>
<div class="col-md-3">
    <label for="man-d">Ширина плеча</label>
    <input id="man-d" type="text" name="Man[D]" placeholder="Ширина плеча" <?= $D ? 'value="'.$D.'"' : '' ?>>
</div>
<div class="col-md-3">
    <label for="man-e">Длина рукава</label>
    <input id="man-e" type="text" name="Man[E]" placeholder="Длина рукава" <?= $E ? 'value="'.$E.'"' : '' ?>>
</div>
<div class="col-md-3">
    <label for="man-g">Обхват шеи</label>
    <input id="man-g" type="text" name="Man[G]" placeholder="Обхват шеи" <?= $G ? 'value="'.$G.'"' : '' ?>>
</div>
<div class="col-md-3">
    <label for="man-f">Длина ноги</label>
    <input id="man-f" type="text" name="Man[F]" placeholder="Длина ноги" <?= $F ? 'value="'.$F.'"' : '' ?>>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['name' => 'Man[send-btn]', 'id' => 'send-btn', 'value' => 'send-btn', 'class' => 'btn btn-success']) ?>
    </div>
</div>
<div class="col-md-12">
    <h4>Все измерения указаны в сантиметрах</h4>
    <table width="100%" cellspacing="0" cellpadding="0" class="size_chart">
        <tbody>
        <tr>
            <td colspan="8" class="header-main">Мужская одежда</td>
        </tr>
        <tr class="header-line">
            <td class="header-side">Международный размер</td>
            <?php foreach ($man_params['ALL'] as $item): ?>
                <td><?= $item ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="header-side">Европейский размер</td>
            <?php foreach ($man_params['EUR'] as $item): ?>
                <td><?= $item ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="header-side">Украинский размер</td>
            <?php foreach ($man_params['UA'] as $item): ?>
                <td><?= $item ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td colspan="8" class="header-main">Определение размеров рубашек</td>
        </tr>
        <tr>
            <td class="header-side">Обхват шеи</td>
            <?php foreach ($man_params['G'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="header-side">Длина рукава</td>
            <?php foreach ($man_params['E'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="header-side">Ширина плеча</td>
            <?php foreach ($man_params['D'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td colspan="8" class="header-main">Определение обьема груди, талии</td>
        </tr>
        <tr>
            <td class="header-side">Обхват груди</td>
            <?php foreach ($man_params['A'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="header-side">Обхват талии</td>
            <?php foreach ($man_params['B'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td colspan="8" class="header-main">Джинсы, брюки, шорты, штаны</td>
        </tr>
        <tr>
            <td class="header-side">Размер</td>
            <td>28</td>
            <td>29-30</td>
            <td>31-32</td>
            <td>33-34</td>
            <td>36</td>
            <td>40</td>
            <td>42</td>
        </tr>
        <tr>
            <td class="header-side">Международный размер</td>
            <td>XS</td>
            <td>S</td>
            <td>M</td>
            <td>L</td>
            <td>XL</td>
            <td>XXL</td>
            <td>3XL</td>
        </tr>
        <tr>
            <td class="header-side">Украинский размер</td>
            <td>42</td>
            <td>42-44</td>
            <td>44-46</td>
            <td>48-50</td>
            <td>50-52</td>
            <td>54-56</td>
            <td>58</td>
        </tr>
        <tr>
            <td colspan="8" class="header-main">Определение ширины пояса, бедер</td>
        </tr>
        <tr>
            <td class="header-side">Обхват талии</td>
            <?php foreach ($man_params['B'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td class="header-side">Обхват бедер</td>
            <?php foreach ($man_params['C'] as $item): ?>
                <td class="<?= $item['active'] ? $item['active'] : '' ?>"><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td colspan="8" class="header-main">Определение длины джинс, брюк, штанов</td>
        </tr>
        <?php $x = 0; ?>
        <?php foreach ($man_params['F'] as $item): ?>
            <tr class="<?= $item['active'] ? $item['active'] : '' ?>">
                <td class="header-side">Рост L3<?= $x ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
                <td><?= $item['start'] ?><?= $item['end'] ? '-'.$item['end'] : '' ?></td>
            </tr>
            <?php $x + 2; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>

