<?php
/**
 * name: Vladyslav Gladyr
 * email: wild.savedo@gmail.com
 * site: lockit.com
 * 13.07.2020
 */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\components\MenuWidget;

$params = Yii::$app->params['languages'];
$language = Yii::$app->language;

?>

<section>
    <div class="container wishlist-container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <ul class="catalog">
                            <?= MenuWidget::widget(['template' => 'menu']) ?>
                        </ul>
                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                                <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                                <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                                <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                   data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br/>
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="/images/home/shipping.jpg" alt=""/>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <!--features_items-->
                <div class="features_items">
                    <h2 class="title text-center">Список пожеланий</h2>

                    <?php if (isset($wishlist) && !empty($wishlist)) : ?>
                        <?php if (isset($wishlist->wishlistItems) && !empty($wishlist->wishlistItems)) : ?>
                            <?php foreach ($wishlist->wishlistItems as $product): ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <?= Html::img( $product->img, ['alt' => $product->name]) ?>
                                                <h2>$<?= $product->price ?></h2>
                                                <p>
                                                    <?php
                                                    if (count($params) > 1) {
                                                        $code = unserialize($product->name);
                                                        $data = $code[$language];
                                                        $name = $data['name'];
                                                    } else {
                                                        $name = $product->name;
                                                    }
                                                    ?>
                                                    <a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>"><?= $name ?></a>
                                                </p>
                                                <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                   data-id="<?= $product->id ?>" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add
                                                    to cart</a>
                                            </div>
                                            <div class="product-overlay hidden">
                                                <div class="overlay-content">
                                                    <h2>$<?= $product->price ?></h2>
                                                    <p><?= $name ?></p>
                                                    <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                       data-id="<?= $product->id ?>" class="btn btn-default add-to-cart"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                <li>
                                                    <a class="del-item"  href="<?= Url::to(['wishlist/delete-item', 'id' => $product->id]) ?>"><i class="fa fa-plus-square"></i>Удалить</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h3>Список пожеланий пуст</h3>
                        <?php endif; ?>
                    <?php else : ?>
                        <h3>Список пожеланий пуст</h3>
                    <?php endif; ?>
                </div>
                <!--features_items-->
            </div>
        </div>
    </div>
</section>