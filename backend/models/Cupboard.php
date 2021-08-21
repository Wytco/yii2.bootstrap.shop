<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 21.03.2020
 * Time: 17:02
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * @property int $id
 * @property string $imageFile
 * @property string $width
 * @property string $height
 * @property string $length
 * @property string $col
 * @property string $code
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Cupboard extends ActiveRecord
{
    public $imageFile;
    public $width;
    public $height;
    public $length;
    public $col;

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

    public static function tableName()
    {
        return 'cupboard';
    }

    public function rules()
    {
        return [
            [['width', 'height', 'length', 'col','code'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Файл',
            'width' => 'Ширина шкафа',
            'height' => 'Высота шкафа',
            'length' => 'Глубина шкафа',
            'col' => 'Столбцов шкафа',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('@backend/web/akb.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
