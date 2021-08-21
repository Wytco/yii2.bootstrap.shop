<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $active
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'active'], 'required'],
            [['active'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'active' => 'Active',
        ];
    }
}
