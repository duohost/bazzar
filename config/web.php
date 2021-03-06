<?php

$config = [
    'id' => 'basic',
    // 'language' => 'en-US',
    // 'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'YWGc0iRNl-wkHwdeH0FXGdh9dkBe8GqM',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . DIRECTORY_SEPARATOR . YII_DEBUG ? 'db.local.php' : 'db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'post-ad' => 'listing/create',
                'v/<id:[\d]+>/<slug>' => 'listing/view',
                'ads/<tag:[\w-]+>' => 'listing/index',
                '<category:[\w-]+>/<id:[\d]+>' => 'listing/index',
                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/basic',
                'baseUrl' => '@web/themes/basic',
                'pathMap' => [
                    '@app/views' => '@app/themes/basic/views',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'modelMap' => ['User' => 'app\models\User'],
            'admins' => ['admin']
        ],
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
