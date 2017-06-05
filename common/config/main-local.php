<?php

return [
    'components' => [
	'db' => [
	    'class' => 'yii\db\Connection',
	    'dsn' => 'pgsql:host=localhost;dbname=alerts',
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
    ],
];
