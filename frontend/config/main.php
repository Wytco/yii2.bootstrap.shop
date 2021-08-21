<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'languages',
    ],
    'controllerNamespace' => 'frontend\controllers',
//    'language' => 'ru-Ru',
    'sourceLanguage' => 'ru',
    'defaultRoute' => 'category/index',
    'modules' => [
        'languages' => [
            'class' => 'common\modules\languages\Module',
            //Языки используемые в приложении
            'languages' => $params['languages'],
            'default_language' => 'ru', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'forceTranslation' => true,
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'class' => 'common\components\Request'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'linkAssets' => false,//???
            'forceCopy' => true
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //Включить что бы правильно работали урлы мультиязычности (Но после этого debug панель не работает)
//            'class' => 'common\components\UrlManager',
            'rules' => [
                'languages' => 'languages/default/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                //Убираею гет параметр пагинации (Должен быть выше основного)
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                'category/<id:\d+>' => 'category/view',
                'search' => 'category/search',
                'product/<slug>' => 'product/view',
            ],
        ],
    ],
    'params' => $params,
];
