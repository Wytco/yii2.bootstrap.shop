<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property string|null $keywords
 * @property string|null $description
 */
class Category extends \yii\db\ActiveRecord
{
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
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
//            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Категория',
            'name' => 'Имя',
            'keywords' => 'Ключивые слова',
            'description' => 'Ключивое описание',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::className(),['id'=>'parent_id']);
    }
}
