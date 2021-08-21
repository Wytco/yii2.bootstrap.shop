<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'name' => 'Моя Система',
    'language' => 'ru',
//    'layout' => 'admin',
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\Api',
        ],
    ],
    'components' => [
        //Форматируем дату по всему сайту
//        'formatter'=>[
//            'datetimeFormat' => 'php:d F H:i:s'
//        ],
        //Переподключение js не илспользуя его в AppAsset
//        'assetManager' => [
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,   // не опубликовывать комплект
//                    'js' => [
//                        'js/jquery-1.11.1.min.js',
//                    ]
//                ],
//            ],
//        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            //Если надо перенаправить на другую страницу авторизации
//            'loginUrl' => '/admin/auth/login',
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.ukr.net',
                'username' => 'yii2_loc@ukr.net',
                'password' => 'password',
                'port' => '2525', // 465
                'encryption' => 'ssl', // tls
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                '' => 'site/index',
                'login' => 'site/login',
                'calculatores' => 'site/calculator',
                'order/<id:\d+>' => 'order/view',

                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                'category/<id:\d+>' => 'category/view',
                'product/<id:\d+>' => 'product/view',
            ],
        ],
    ],
    'controllerMap' => [
        // объявляет "account" контроллер, используя название класса
//            'test' => 'app\controllers\SiteController',

        // объявляет "article" контроллер, используя массив конфигурации
//            'article' => [
//                'class' => 'app\controllers\PostController',
//                'enableCsrfValidation' => false,
//            ],
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>'/uploads',
                'basePath'=>'@frontend/web/uploads',
                'name' => 'Uploads'
            ]
//            'watermark' => [
//                'source'         => __DIR__.'/logo.png', // Path to Water mark image
//                'marginRight'    => 5,          // Margin right pixel
//                'marginBottom'   => 5,          // Margin bottom pixel
//                'quality'        => 95,         // JPEG image save quality
//                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//                'targetMinPixel' => 200         // Target image minimum pixel size
//            ]
        ]
    ],
    'params' => $params,
];
