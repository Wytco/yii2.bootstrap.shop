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

use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * @property int $id
 * @property string $imageFile
 */

class Csv extends ActiveRecord
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true],
        ];
    }
    public function attributeLabels()
    {
        return [
            'imageFile' => 'Файл',
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
