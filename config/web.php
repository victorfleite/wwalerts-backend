<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'alerts-tools',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
	'user' => [
	    'class' => 'dektrium\user\Module',
	    'enableConfirmation' => true,
	    'mailer' => [
		'sender' => ['no-reply@myhost.com' => 'Alerts no-reply'],
		'welcomeSubject' => 'Hi welcome to alerts-tools application',
		'confirmationSubject' => 'Confirm register',
		'reconfirmationSubject' => 'Re-confirm register',
		'recoverySubject' => 'Recovery Password',
	    ]
	],
	'admin' => [
	    'class' => 'mdm\admin\Module',
	    'layout' => 'left-menu',
	    'mainLayout' => '@app/views/layouts/main.php',
	    'controllerMap' => [
		'assignment' => [
		    'class' => 'mdm\admin\controllers\AssignmentController',
		    'userClassName' => '\dektrium\user\models\User',
		    'idField' => 'id',
		    'usernameField' => 'username',
		    'extraColumns' => [
			    [
			    'attribute' => 'email',
			    'label' => 'Email',
			    'value' => function($model, $key, $index, $column) {
				return $model->email;
			    },
			],
		    ],
		],
	    ],
	    'menus' => [
		'user' => null, // disable menu route 
	    ]
	],
    ],
    'components' => [
	'db' => require(__DIR__ . '/db.php'),
	'authManager' => [
	    'class' => 'yii\rbac\DbManager',
	],
	'request' => [
	    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
	    'cookieValidationKey' => 'uhoYwLun2Co2VfiLD9smsB4-fFyuGD9Z',
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
	'mailer' => [
	    'class' => 'yii\swiftmailer\Mailer',
	    'transport' => [
		'class' => 'Swift_SmtpTransport',
		'host' => 'aramis.inmet.gov.br',
		'username' => '',
		'password' => ''
	    ],
	],
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'as access' => [
	'class' => 'mdm\admin\components\AccessControl',
	'allowActions' => [
	    '/site/*',
	    'admin/*',
	    'user/registration/register',
	    'user/registration/connect',
	    'user/registration/confirm',
	    'user/registration/resend',
	    'user/registration/*',
	    'user/security/*', // login and logout
	    'user/recovery/*', // change password
	    'user/settings/*', // edit self infos
	    'user/profile/*', // user Profile
	    '/user/forgot',
	    'site/logout',
	    'site/index',
	    '/site/logout',
	    '/site/login',
	    '/site/error',
	// The actions listed here will be allowed to everyone including guests.
	// So, 'admin/*' should not appear here in the production, of course.
	// But in the earlier stages of your development, you may probably want to
	// add a lot of actions here until you finally completed setting up rbac,
	// otherwise you may not even take a first step.
	]
    ],
    'params' => $params,
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
