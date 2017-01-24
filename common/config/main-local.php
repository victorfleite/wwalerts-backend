<?php
return [
    'language'=>'pt-BR',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            /*
             // LOCALHOST
            'dsn' => 'pgsql:host=localhost;dbname=educatuxweb',
            'username' => 'dialogo',
            'password' => 'psw2143315',
            'charset' => 'utf8',
            */            
            
            // DESENV REMOTO
            'dsn' => 'mysql:host=sia.educatux.com.br;dbname=escola',
            'username' => 'victor',
            'password' => 'qwe2143315',
            'charset' => 'utf8', 
       
        ],
        'urlManager'=>['enablePrettyUrl'=>true],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',//'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        ],
    ],
];
