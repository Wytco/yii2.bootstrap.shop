<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 16.03.2020
 * Time: 11:50
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 15.03.2020
 * Time: 19:44
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use frontend\components\MenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$params = Yii::$app->params['languages'];
$language = Yii::$app->language;


?>
<section id="advertisement">
    <div class="container">
        <img src="/images/shop/advertisement.jpg" alt=""/>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <ul class="catalog">
                            <?= MenuWidget::widget(['template' => 'menu']) ?>
                        </ul>
                    </div><!--/category-productsr-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
                                <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                                <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                                <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                   data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br/>
                            <b>$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="/images/home/shipping.jpg" alt=""/>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Вы искали : <?= Html::encode($search) ?></h2>
                    <?php if (isset($products) && !empty($products)): ?>
                        <?php $x = 0; ?>
                        <?php foreach ($products as $product) : ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img( $product->img, ['alt' => $product->name]) ?>
                                            <h2>$<?= $product->price ?></h2>
                                            <p>
                                                <?php
                                                if (count($params) > 1) {
                                                    $code = unserialize($product->lang);
                                                    $data = $code[$language];
                                                    $name = $data['name'];
                                                } else {
                                                    $name = $product->name;
                                                }
                                                ?>
                                                <a href="<?=Url::to(['product/view','slug'=>$product->slug]) ?>"><?= $name ?></a>
                                            </p>
                                            <a href="<?=Url::to(['cart/add','id'=>$product->id]) ?>" data-id="<?= $product->id ?>" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add
                                                to cart</a>
                                        </div>
                                        <div class="product-overlay hidden">
                                            <div class="overlay-content">
                                                <h2>$<?= $product->price ?></h2>
                                                <p><?= $name ?></p>
                                                <a href="#" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                        <?php if ($product->new): ?>
                                            <?= Html::img('@web/images/home/new.png', ['alt' => 'Новинка', 'class' => 'new']) ?>
                                        <?php elseif ($product->sale): ?>
                                            <?= Html::img('@web/images/home/sale.png', ['alt' => 'Новинка', 'class' => 'new']) ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li>
                                                <a class="add-to-wishlist" data-id="<?= $product->id ?>" href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php $x++; ?>
                            <?php if ($x % 3 == 0): ?>
                                <idv class="clearfix"></idv>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <idv class="clearfix"></idv>
                        <?= LinkPager::widget([
                            'pagination' => $pages,
                            'class' => 'pagination'
                        ]); ?>
                    <?php else: ?>
                        <h1>Ничего не найдено...</h1>
                    <?php endif; ?>


                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
