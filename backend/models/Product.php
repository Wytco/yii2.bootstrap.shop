<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $content
 * @property string $gallery
 * @property float $price
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $imageFiles;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
//            [
//                'class' => SluggableBehavior::className(),
//                'attribute' => null,
//                'slugAttribute' => 'slug',
//                'value' => function ($event){
//                    $slugParts = str_replace(' ','-',$this->owner->name);
//                    $slug = Inflector::slug($slugParts,'-');
//                    return $slug;
//                }
//            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale','gallery','lang'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'img'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 4],
            [['created_at', 'updated_at','slug'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'name' => 'Имя',
            'content' => 'Описание',
            'price' => 'Цена',
            'keywords' => 'Ключивые слова',
            'description' => 'Ключевое описание',
            'img' => 'Рисунок',
            'gallery' => 'Галерея',
            'hit' => 'Хиты',
            'new' => 'Новинки',
            'sale' => 'Распродажа',
            'slug' => 'Url',
            'imageFile' => 'Основной рисунок',
            'imageFiles' => 'Галерея',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            //Проверка существует папка или нет
            $dir_name = '../../frontend/web/uploads/';
            if (!file_exists($dir_name)) {
                mkdir($dir_name, 0777, true);
            }
            $save = $this->imageFile->saveAs('@frontend/web/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $path = '/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            return $path;
        } else {
            return false;
        }
    }

    public function uploads()
    {
        if ($this->validate()) {
            $path = [];
            //Проверка существует папка или нет
            $dir_name = '../../frontend/web/uploads/';
            if (!file_exists($dir_name)) {
                mkdir($dir_name, 0777, true);
            }
            foreach ($this->imageFiles as $file) {
                $file->saveAs('@frontend/web/uploads/' . $file->baseName . '.' . $file->extension);
                $path[] = '/uploads/' . $file->baseName . '.' . $file->extension;
            }
            return $path;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'imageFile')){
            $dir = '../../frontend/web/uploads/products/' . date("Y_m_d") . '/';
            if(!is_dir($dir)){
                mkdir($dir, 0777, true);
            }
            $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;
            $path = '/uploads/products/' . date("Y_m_d") . '/';
            $this->img = $path . $file_name;
            $file->saveAs($dir . $file_name);

        }
        if($files = UploadedFile::getInstances($this, 'imageFiles')){
            $dir = '../../frontend/web/uploads/products/' . date("Y_m_d") . '/';
            if(!is_dir($dir)){
                mkdir($dir, 0777, true);
            }
            $path = '/uploads/products/' . date("Y_m_d") . '/';
            foreach ($files as $file) {
                $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;
                $this->img = $path . $file_name;
                $file->saveAs($dir . $file_name);
                $new_path[] = $this->img;
            }
            $this->gallery = serialize($new_path);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
