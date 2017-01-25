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
