<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 16.03.2020
 * Time: 12:18
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function AddToCart($product, $qty = 1)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'img' => $product->img,
                'slug' => $product->slug,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
    }

    public function recalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;
        $gtyMinus = $_SESSION['cart'][$id]['qty'];
        $_SESSION['cart.qty'] -= $gtyMinus;
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }

}
