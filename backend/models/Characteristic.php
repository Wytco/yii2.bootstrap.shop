<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "characteristic".
 *
 * @property int $id
 * @property string $characteristic
 * @property int $сategory_id
 */
class Characteristic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['characteristic', 'сategory_id'], 'required'],
            [['characteristic'], 'string'],
            [['сategory_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'characteristic' => 'Characteristic',
            'сategory_id' => 'Сategory ID',
        ];
    }
}
