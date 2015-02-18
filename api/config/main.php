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
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',

        ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/news',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/categories',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ]
            ],
        ]
    ],
    'aliases' => [

        '@siteFaCategoryPatch' => 'http://yaldayekavir.com/index.php/fa/shopping',
        '@siteEnCategoryPatch' => 'http://yaldayekavir.com/index.php/en/shopping-2',
        '@siteFaPatch' => 'http://yaldayekavir.com/index.php/fa',
        '@siteEnPatch' => 'http://yaldayekavir.com/index.php/en',
        '@baseCategoryImagePath' => 'http://yaldayekavir.com/components/com_jshopping/files/img_categories',
        '@baseProductImagePath' => 'http://yaldayekavir.com/components/com_jshopping/files/img_products',
        '@baseLabelImagePath' => 'http://yaldayekavir.com/components/com_jshopping/files/img_labels',
    ],
    'params' => $params,
];



