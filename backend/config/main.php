<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'Alertas',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
	'log',
	    [
	    'class' => 'common\components\LanguageSelector',
	    'supportedLanguages' => ['en', 'pt-BR'],
	],
    ],
    'language' => 'pt-BR',
    'sourceLanguage' => 'en',
    'modules' => [
	'admin' => [
	    'class' => 'mdm\admin\Module',
	    'layout' => 'left-menu',
	    'menus' => [
		'route' => null, // disable menu
	    ],
	    'mainLayout' => '@app/views/layouts/main.php',
	    'controllerMap' => [
		'assignment' => [
		    'class' => 'mdm\admin\controllers\AssignmentController',
		    'idField' => 'id',
		    'usernameField' => 'username',
		    'extraColumns' => [
			    [
			    'attribute' => 'name',
			    'label' => 'Name',
			    'value' => function($model, $key, $index, $column) {
				return $model->name;
			    },
			],
			    [
			    'attribute' => 'email',
			    'label' => 'Email',
			    'value' => function($model, $key, $index, $column) {
				return $model->email;
			    },
			],
		    ],
		    'searchClass' => 'common\models\UserSearch'
		],
	    ],
	],
	'gridview' => [
	    'class' => '\kartik\grid\Module',
	// see settings on http://demos.krajee.com/grid#module
	],
	'datecontrol' => [
	    'class' => '\kartik\datecontrol\Module',
	// see settings on http://demos.krajee.com/datecontrol#module
	],
	// If you use tree table
	'treemanager' => [
	    'class' => '\kartik\tree\Module',
	// see settings on http://demos.krajee.com/tree-manager#module
	]
    ],
    'components' => [
	'authManager' => [
	    'class' => 'yii\rbac\DbManager',
	],
	'request' => [
	    'csrfParam' => '_csrf-backend',
	],
	'user' => [
	    'identityClass' => 'common\models\User',
	    'enableAutoLogin' => true,
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
	'i18n' => [
	    'translations' => [
		'translation*' => [
		    'class' => 'yii\i18n\PhpMessageSource',
		    'basePath' => '@common/messages',
		],
	    ],
	],
    ],
    'as access' => [
	'class' => 'mdm\admin\components\AccessControl',
	'allowActions' => [
	    'site/set-language',
	    'site/logout',
	    'site/login',
	    'site/error',
	// The actions listed here will be allowed to everyone including guests.
	// So, 'admin/*' should not appear here in the production, of course.
	// But in the earlier stages of your development, you may probably want to
	// add a lot of actions here until you finally completed setting up rbac,
	// otherwise you may not even take a first step.
	]
    ],
    'params' => $params,
];
