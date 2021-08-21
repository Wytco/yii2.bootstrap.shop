<?php


namespace app\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    public static function tableName()
    {
        return 'country';
    }

    public function rules()
    {
        //https://www.yiiframework.com/doc/guide/2.0/ru/tutorial-core-validators
        return [
            [['code', 'name', 'population', 'status'], 'required'],
            ['code', 'unique'],
            ['population', 'integer'],
            ['status', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'Код страны',
            'name' => 'Страна',
            'population' => 'Население',
            'status' => 'Статус',
        ];
    }
}