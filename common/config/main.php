<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    ],
    'components' => [
	'db' => [
	    'class' => 'yii\db\Connection',
	    'dsn' => 'pgsql:host=localhost;dbname=al',
	    'username' => 'postgres',
	    'password' => 'postgres',
	    'charset' => 'utf8',
	],
	'mailer' => [
	    'class' => 'yii\swiftmailer\Mailer',
	    'viewPath' => '@common/mail',
	    'transport' => [
		'class' => 'Swift_SmtpTransport',
		'host' => 'aramis.inmet.gov.br',
		'username' => '',
		'password' => ''
	    ],
	],
	'cache' => [
	    'class' => 'yii\caching\FileCache',
	],
    ],
];
