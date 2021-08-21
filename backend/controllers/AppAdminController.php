<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 19.03.2020
 * Time: 11:07
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AppAdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function getParamsLanguages()
    {
        $params = Yii::$app->params['languages'];
        $language = Yii::$app->language;

        return ['params'=>$params,'language'=>$language];
    }
}
