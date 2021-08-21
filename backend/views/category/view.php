<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
$name = unserialize($model->name);
$firstKey = current($params);
$this->title = $name[$firstKey];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'parent_id',
                'value' =>  $model->category->name ? $model->category->name : 'Основная',
                'format' => 'html'
            ],
            [
                'attribute' => 'name',
                'value' =>  function($model){
                    $name = unserialize($model->name);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey];
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'keywords',
                'value' =>  function($model){
                    $name = unserialize($model->keywords);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey];
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'description',
                'value' =>  function($model){
                    $name = unserialize($model->description);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey];
                },
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
