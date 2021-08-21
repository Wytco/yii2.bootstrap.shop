<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 15.03.2020
 * Time: 19:11
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */
//$name = unserialize($tab . $category['name']);
//$params = Yii::$app->params['languages'];
//$firstKey = current($params);
//$name[$firstKey]
?>
<option value="<?= $category['id'] ?>" <?= $category['id'] == $this->model->id ? 'disabled' : '' ?> <?= $category['id'] == $this->model->category_id ? 'selected' : '' ?>><?= unserialize($category['name'])['ru'] ?></option>
<?php if (isset($category['childs'])): ?>
    <?= $this->getMenuHtml($category['childs'], $tab . ' - ') ?>
<?php endif; ?>

