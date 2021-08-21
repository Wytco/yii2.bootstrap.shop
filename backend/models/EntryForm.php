<?php


namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{

    public $name;
    public $email;
    public $text;
    public $topic;

    //Валидация данных

    //Очень полезная статья по созданию своих валидаторов
    //https://www.yiiframework.com/doc/guide/2.0/ru/input-validation

    //https://www.yiiframework.com/doc/guide/2.0/ru/tutorial-core-validators
    //https://www.yiiframework.com/doc/api/2.0/yii-validators-validator
    public function rules()
    {
        return [
            //ОБезательные
            [['name', 'email', 'text'], 'required'],
            //Убираем пробелы сначала и в конце
            [['name', 'email', 'text', 'topic'], 'trim'],
            //Укажим свое имя ошибки
            ['email', 'email', 'message' => 'Не правильная форма e-mail'],
            //если без разницы что в поле ставим safe
//            ['topic','safe'],
            //Диапозон
//            ['topic', 'string', 'min' => 3, 'tooShort' => 'Слишком которкое. Миниму 3'],
//            ['topic', 'string', 'max' => 5, 'tooLong' => 'Слишком большое. Максимум 5'],
//            ['topic', 'string', 'length' => [3,5]]

            //Своя валидация (обезательно skipOnEmpty and skipOnError)
            ['topic','validateTopic', 'skipOnEmpty' => false, 'skipOnError' => false]
        ];
    }

    public function validateTopic($attribute, $params)
    {
        if (!in_array($this->$attribute, ['USA', 'Indonesia'])) {
            $this->addError($attribute, 'Страна должна быть либо "USA" или "Indonesia".');
        }
    }

    //Labels
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'topic' => 'Тема',
            'text' => 'Текст',
        ];
    }

}