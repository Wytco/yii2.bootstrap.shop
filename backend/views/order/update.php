<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = 'Обновить заказ № : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="order-update">

    <h1><?= 'Номер заказа № ' . $model->id ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'order_items' => $order_items,
        'pages' => $pages,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'status' => $status,
        'search' => $search,
        'message' => $message,
        'products' => $products,
    ]) ?>

</div>
