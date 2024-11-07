<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
//        'magbat' => [
//            'basePath' => '@api/modules/magbat',
//            'class' => 'api\modules\magbat\Module'
//        ],
//        'tchat' => [
//            'basePath' => '@api/modules/tchat',
//            'class' => 'api\modules\tchat\Module'
//        ]
        'magwelt' => [
            'basePath' => '@api/modules/magwelt',
            'class' => 'api\modules\magwelt\Module'
        ]
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
        'request' => [
            'baseUrl' => '/api',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '<module:[\w\-]+>/<controller:[\w\-]+>/' => '<module>/<controller>/index',
                '<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<module>/<controller>/<action>',
            ],
        ]
    ],
    'params' => $params,
];



