<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    $name = unserialize($data->category->name);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey] ? $name[$firstKey] : 'Основная';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    $name = unserialize($data->name);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey] ? $name[$firstKey] : 'Основная';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'keywords',
                'value' => function ($data) {
                    $name = unserialize($data->keywords);
                    $params = Yii::$app->params['languages'];
                    $firstKey = current($params);
                    return $name[$firstKey] ? $name[$firstKey] : 'Основная';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'description',
                'value' => function ($data) {
                    $name = unserialize($data->description);
                    return $name['ru'] ? $name['ru'] : 'Основная';
                },
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
