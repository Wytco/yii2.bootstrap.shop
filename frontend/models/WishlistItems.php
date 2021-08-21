<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "wishlist_items".
 *
 * @property int $id
 * @property int $wishlist_id
 * @property int $product_id
 * @property string $name
 * @property string $img
 * @property string $slug
 * @property float $price
 */
class WishlistItems extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlist_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wishlist_id', 'product_id', 'name', 'price'], 'required'],
            [['wishlist_id', 'product_id'], 'integer'],
            [['price'], 'number'],
            [['name','img','slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wishlist_id' => 'Wishlist ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'price' => 'Price',
            'sum_item' => 'Sum Item',
        ];
    }

    public function getWishlist(){
        return $this->hasOne(Wishlist::className(),['id'=>'wishlist_id']);
    }

}
