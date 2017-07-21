<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'Alerts',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'webapp\controllers',
    'bootstrap' => [
	'log',
	    [
	    'class' => 'common\components\LanguageSelector',
	],
    ],
    'language' => 'pt-BR',
    'sourceLanguage' => 'en-US',
    'modules' => [
	'modules' => [
	    'i18n' => Zelenin\yii\modules\I18n\Module::className()
	],
	'admin' => [
	    'class' => 'mdm\admin\Module',
	    'layout' => 'left-menu',
	    'menus' => [
		'menu' => null, // disable menu
		'user' => null, // disable menu
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
	'risk' => [
	    'class' => 'webapp\modules\risk\Module',
	],
	'local' => [
	    'class' => 'webapp\modules\local\Module',
	],
	'operative' => [
	    'class' => 'webapp\modules\operative\Module',
	],
	'communication' => [
	    'class' => 'webapp\modules\communication\Module',
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
	'dumper' => [
	    'class' => 'common\models\Dumper',
	],
	'config' => [
	    'class' => 'common\components\Config',
	],
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
	    'class' => Zelenin\yii\modules\I18n\components\I18N::className(),
	    'translations' => [
		'translation' => [
		    'class' => yii\i18n\DbMessageSource::className(),
		    'forceTranslation' => true,
		]
	    ]
	],
    ],
    'as access' => [
	'class' => 'mdm\admin\components\AccessControl',
	'allowActions' => [
	    'site/set-language',
	    'site/logout',
	    'site/login',
	    'site/error',
	    'site/request-password-reset',
	    'site/reset-password',
	    'site/teste',
	//'admin/*'
	// The actions listed here will be allowed to everyone including guests.
	// So, 'admin/*' should not appear here in the production, of course.
	// But in the earlier stages of your development, you may probably want to
	// add a lot of actions here until you finally completed setting up rbac,
	// otherwise you may not even take a first step.
	]
    ],
    'aliases' => [
	'@web' => '@app/web',
    ],
    'params' => $params,
];
