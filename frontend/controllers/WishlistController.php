<?php
/**
 * name: Vladyslav Gladyr
 * email: wild.savedo@gmail.com
 * site: lockit.com
 * 13.07.2020
 */

namespace frontend\controllers;

use frontend\models\Wishlist;
use frontend\models\WishlistItems;
use Yii;
use frontend\controllers\AppController;
use frontend\models\Product;

class WishlistController extends AppController
{

    public function actionAdd($id)
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('login');
        }

        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }


        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }


        $user_id = Yii::$app->user->id;

        $wishlist = Wishlist::findOne(['user_id' => $user_id]);

        if (!isset($wishlist) && empty($wishlist)) {
            $wishlist = new Wishlist();
            $wishlist->user_id = $user_id;
            $wishlist->save();
        }

        $wishlist_item = WishlistItems::findOne(['wishlist_id' => $wishlist->id, 'product_id' => $product->id]);

        if (empty($wishlist_item)) {
            $wishlist_item = new WishlistItems();
            $wishlist_item->wishlist_id = $wishlist->id;
            $wishlist_item->product_id = $product->id;
            $wishlist_item->name = $product->name;
            $wishlist_item->price = $product->price;
            $wishlist_item->img = $product->img;
            $wishlist_item->slug = $product->slug;
            $wishlist_item->save();
        }

        $this->layout = false;

        return $this->render('wishlist-modal', compact('product'));
    }

    public function actionView()
    {
        $this->setMeta('Магазин | Список пожеланий');

        if (Yii::$app->user->isGuest) {
            return $this->redirect('login');
        }

        $user_id = Yii::$app->user->id;

        $wishlist = Wishlist::find()->with('wishlistItems')->where(['user_id' => $user_id])->one();

        return $this->render('view',compact('wishlist'));
    }

    public function actionDeleteItem($id)
    {

        $delete = WishlistItems::findOne($id);
        $delete->delete();

        $user_id = Yii::$app->user->id;

        $wishlist = Wishlist::find()->with('wishlistItems')->where(['user_id' => $user_id])->one();

        return $this->redirect('view');
    }
}