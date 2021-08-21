<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 22.03.2020
 * Time: 14:13
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace backend\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
/**
 * @property int $id
 * @property int $from
 * @property int $to
 * @property string $text
 */
class Message extends ActiveRecord
{
    public function rules()
    {
        return [
            [['from', 'to', 'text'], 'required'],
            [['from', 'to'], 'integer'],
            ['text', 'string']
        ];
    }

    /**
     * @param int $from
     * @param int $to
     * @return ActiveQuery
     */
    public static function findMessages($from, $to)
    {
        return self::find()
            ->where(['from' => $from])
            ->orWhere(['from' => $to, 'to' => $from]);
    }
}
https://www.pvsm.ru/ajax/191782
