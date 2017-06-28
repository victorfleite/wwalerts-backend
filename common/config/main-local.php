<?php

return [
    'components' => [
	'i18n' => [
	    'class' => Zelenin\yii\modules\I18n\components\I18N::className(),
	    'languages' => ['pt-BR'],
	    'translations' => [
		'translation' => [
		    'class' => yii\i18n\DbMessageSource::className()
		]
	    ]
	],
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
