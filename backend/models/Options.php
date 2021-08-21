<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $languages
 */
class Options extends \yii\db\ActiveRecord
{
    public $multilanguages;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['languages'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'languages' => 'Мультиязычность (Да/Нет)',
        ];
    }
}
