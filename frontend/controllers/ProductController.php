<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 15.03.2020
 * Time: 20:32
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use frontend\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($slug)
    {
        $products = Product::findOne(['slug'=>$slug]);

        if (empty($products)) {
            throw new HttpException(404, 'Такой категории нет');
        }

        $this->setMeta('Магазин | ' . $products->name, $products->keywords, $products->description);

        return $this->render('view', compact('products' ));
    }
}
