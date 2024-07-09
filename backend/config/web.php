<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$projectDir = dirname(__DIR__);

$config = [
    'id' => 'basic',
    'basePath' => $projectDir,
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'amnah\yii2\user\components\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => $_ENV['M_SCHEME'] ?? 'smtp',
                'host' => $_ENV['M_HOST'] ?? 'smtp.example.com',
                'username' => $_ENV['M_USER'] ?? 'Enter username',
                'password' => $_ENV['M_PASS'] ?? 'Enter password',
                'port' => $_ENV['M_PORT'] ?? 587,
            ],
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => [$_ENV['M_CONFIG_1'] ?? 'email@example.com' => $_ENV['M_CONFIG_2'] ?? 'project.name'],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'api/delivery',
                        'api/d-type',
                        'api/w-schedule',
                    ],
                    'pluralize' => false,
                ]
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
            // set custom module properties here ...
        ],
        'api' => [
            'class' => 'app\modules\api\ApiModule',
            // Additional configurations for 'api' module here, if needed
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // Configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // Uncomment the line below to add your IP if not connecting from localhost
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // Uncomment the line below to add your IP if not connecting from localhost
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
