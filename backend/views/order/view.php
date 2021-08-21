<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

//dd($model->orderItems);
?>
<div class="order-view">

    <h1><?= 'Номер заказа № ' . $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'status',
                'value' =>  !$model->status ? '<span class="text-danger">Активен</span>' : '<span class="text-success">Завершен</span>',
                'format' => 'html'
            ],
            'name',
            'email:email',
            'phone',
            'address',
            'qty',
            'sum',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">Наименование</th>
                <th scope="col">Кол-во</th>
                <th scope="col">Цена</th>
                <th scope="col">Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->orderItems as $id => $item): ?>
                <tr>
                    <td><a href="<?= Url::to(['/product/view', 'id' => $item->product_id]) ?>"><?= $item['name'] ?></a>
                    </td>
                    <td><?= $item['qty_item'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['sum_item'] ?></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
