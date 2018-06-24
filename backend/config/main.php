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
    'defaultRoute' => 'site/index',
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'csrfCookie' => [
                'httpOnly' => true,
                'path' => '/admin',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'idParam'=>'admin-id',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'cookieParams' => [
                'path' => '/admin',
            ],
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'rules' => [
                '' => 'site/index',


                '<action>'=>'site/<action>',
//                '<controller>/<scope:\w+>.<action:\w+>' => '<controller>/<action>',
//                '<controller>/<scope:\w+>.<action:\w+>-<suffix:\w+>' => '<controller>/<action>-<suffix>',
//                '<controller>/<action>' => '<controller>/<action>',
//                '<controller>' => '<controller>',
//
//                '<module>/<controller>/<scope:\w+>.<action:\w+>' => '<module>/<controller>/<action>',
//                '<module>/<controller>/<scope:\w+>.<action:\w+>-<suffix:\w+>' => '<module>/<controller>/<action>-<suffix>',
//                '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
//                '<module>/<controller>' => '<module>/<controller>',
            ]
        ],
    ],
    'params' => $params,
];
