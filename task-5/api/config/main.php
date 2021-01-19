<?php

use api\modules\v1\Module;
use backend\repositories\ServiceRepository;
use backend\repositories\ServiceRepositoryInterface;
use backend\services\ServiceService;
use backend\services\ServiceServiceInterface;
use yii\di\Container;
use yii\web\UrlManager;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
	'defaultRoute' => 'site/index',
    'bootstrap' => ['log'],
	'aliases' => [
		'@api' => realpath(__DIR__.'/../../api'),
	],
    'modules' => [
		'v1' => [
			'basePath' => '@api/modules/v1',
			'class' => Module::class,
		],
	],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
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
			'class' => UrlManager::class,
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'' => 'site/index',
				'auth' => 'site/login',
				'GET service' => 'service/index',
			],
		],
		'request' => [
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			],
			'csrfParam' => '_csrf-api',
		],
    ],
    'params' => $params,
	'container' => [
		'definitions' => [
			ServiceRepositoryInterface::class => ServiceRepository::class,
			ServiceServiceInterface::class => function (Container $container) {
				return new ServiceService($container->get(ServiceRepositoryInterface::class));
			},
		],
	],
];
