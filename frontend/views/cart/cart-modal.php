<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 16.03.2020
 * Time: 15:49
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */
use frontend\models\Product;
use yii\helpers\Url;


$params = Yii::$app->params['languages'];
$language = Yii::$app->language;
?>

<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">Фото</th>
                <th scope="col">Наименование</th>
                <th scope="col">Кол-во</th>
                <th scope="col">Цена</th>
                <th scope="col">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <th scope="row">
                        <img width="100px" src="/images/products/<?= $item['img'] ?>" alt="<?= $item['name'] ?>">
                    </th>
                    <td>
                        <?php
                        if (count($params) > 1) {
                            $product = Product::findOne($id);
                            $code = unserialize($product->lang);
                            $data = $code[$language];
                            $slug = $data['slug'];
                            $name = $data['name'];
                            $url = '/' . $language . '/product/view';
                        } else {
                            $slug = $item['slug'];
                            $name = $item['name'];
                            $url = '/product/view';
                        }
                        ?>
                        <a href="<?= Url::to([$url, 'slug' => $slug]) ?>"><?= $name ?></a>
                    </td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price']  ?></td>
                    <td data-id="<?= $id ?>" class="text-danger del-item">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Итого : </td>
                <td><?= $session['cart.qty'] ?></td>
            </tr>
            <tr>
                <td colspan="4">На сумму : </td>
                <td><?= $session['cart.sum'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h1>Корзина пуста</h1>
<?php endif; ?>
