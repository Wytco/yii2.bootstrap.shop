<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 16.03.2020
 * Time: 12:15
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderItems;

class CartController extends AppController
{
    public function actionAdd($id, $qty)
    {
//        $qty = (int)Yii::$app->request->get('qty');

        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();

        $qty = !(int)$qty ? 1 : $qty;

        $cart->AddToCart($product, $qty);

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $this->setMeta('Магазин | Корзина');
        $session = Yii::$app->session;
        $session->open();

        $order = new Order();

        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят');
                Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom(['wild.savedo@gmail.com'=>'name'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
//    ->setTextBody('Текст сообщения')
//    ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка офромления заказа');
            }
        }
        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_item = new OrderItems();
            $order_item->order_id = $order_id;
            $order_item->product_id = $id;
            $order_item->name = $item['name'];
            $order_item->price = $item['price'];
            $order_item->qty_item = $item['qty'];
            $order_item->sum_item = $item['qty'] * $item['price'];
            $order_item->save();
        }
    }
}
