<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
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
//            'id',
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    $name = unserialize($model->category->name);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey] ? $name[$firstKey] : 'Основная';
                } ,
                'format' => 'html'
            ],
            'name',
            'content:html',
            'price',
            'keywords',
            'description',
            [
                'attribute' => 'img',
                'value' => '<img src="' . $model->img . '" width="100">',
                'format' => 'html'
            ],
            [
                'attribute' => 'gallery',
                'value' => function ($model) {
                    $img = '';
                    if (isset($model->gallery) && !empty($model->gallery)) {
                        foreach (unserialize($model->gallery) as $item) {
                            $img .= '<img src="' . $item . '" width="100">';
                        }
                    }
                    return $img;
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'hit',
                'value' => $model->hit == 1 ? '<span class="text-success">Активно</span>' : '<span class="text-danger">Не активно</span>',
                'format' => 'html'
            ],
            [
                'attribute' => 'new',
                'value' => $model->new == 1 ? '<span class="text-success">Активно</span>' : '<span class="text-danger">Не активно</span>',
                'format' => 'html'
            ],
            [
                'attribute' => 'sale',
                'value' => $model->sale == 1 ? '<span class="text-success">Активно</span>' : '<span class="text-danger">Не активно</span>',
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
