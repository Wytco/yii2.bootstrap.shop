<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 15.03.2020
 * Time: 19:11
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */
$name = unserialize($tab . $category['name']);
$params = Yii::$app->params['languages'];
$firstKey = current($params);
?>
<option value="<?= $category['id'] ?>" <?= $category['id'] == $this->model->id ? 'disabled' : '' ?> <?= $category['id'] == $this->model->parent_id ? 'selected' : '' ?>><?= $name[$firstKey] ?></option>
<?php if (isset($category['childs'])): ?>
    <?= $this->getMenuHtml($category['childs'], $tab . ' - ') ?>
<?php endif; ?>

