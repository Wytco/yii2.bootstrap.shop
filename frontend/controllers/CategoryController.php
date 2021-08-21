<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 15.03.2020
 * Time: 19:08
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace frontend\controllers;


use Yii;
use frontend\models\Category;
use frontend\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{


    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();

        $this->setMeta('Магазин');

        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        $category = Category::findOne($id);

        if (empty($category)) {
            throw new HttpException(404, 'Такой категории нет');
        }

        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->setMeta('Магазин | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'category', 'pages'));
    }

    public function actionSearch($search)
    {
        if (!$search) {
            return $this->render('search', compact('products', 'pages','search'));
        }

        $query = Product::find()->where(['like','name',$search]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->setMeta('Магазин | Поиск : '.$search);

        return $this->render('search', compact('products', 'pages','search'));
    }
}
