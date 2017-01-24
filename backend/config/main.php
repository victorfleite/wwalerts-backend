<?php

use \kartik\datecontrol\Module;
use kartik\mpdf\Pdf;

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'escola-web',
    'name' => 'Escola Educatux',
    'basePath' => dirname(__DIR__),
    'language' => 'pt-BR',
    'sourceLanguage' => 'en_US',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableConfirmation' => true,
            'mailer' => [
                'sender' => ['no-reply@myhost.com' => 'Educatux no-reply'],
                'welcomeSubject' => 'Olá. Seja Bem Vindo ao Educatux apps',
                'confirmationSubject' => 'Confirmação cadastral',
                'reconfirmationSubject' => 'Confirmação cadastral',
                'recoverySubject' => 'Recuperação de senha',
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
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd/MM/yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd/MM/yyyy hh:mm:ss a',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            // set your display timezone
            //'displayTimezone' => 'America/Sao_Paulo',
            // set your timezone for date saved to db
            //'saveTimezone' => 'UTC',
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],
            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class' => 'form-control'],
                    ]
                ]
            ]
        // other settings
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ]
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'config' =>[
            'class' => 'app\components\Config',
        ],
        'dumper' => [
            'class' => 'common\models\Dumper',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LcIaScTAAAAANQPfIylSOYOvLmerE8dvg_9sTL5',
            'secret' => '6LcIaScTAAAAABCg8fTfNiHHKDXSIWQnjmDVpNp_',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/index',
                '<action:\w+>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ]
            ],
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
        ],
        /* 'authClientCollection' => [
          'class' => yii\authclient\Collection::className(),
          'clients' => [
          'facebook' => [
          'class' => 'dektrium\user\clients\Facebook',
          'clientId' => '148621751945406',
          'clientSecret' => 'de5518e32407fbc0f931389e6d756069',
          ],
          'google' => [
          'class' => 'dektrium\user\clients\Google',
          'clientId' => '1013219143409-dju9ouio3p112ctdscbmf15n8jugg74s.apps.googleusercontent.com',
          'clientSecret' => 'kUsGaqwK2Z-STvgDXcB2Awcb',
          ],
          'twitter' => [
          'class' => 'dektrium\user\clients\Twitter',
          'consumerKey' => '6oIwa8qw6lVuMpW7GtslErvYT',
          'consumerSecret' => 'quIukbvCKoZeBDzvg9gkbUrMUYNcZm8OIQgCGOYifbqV6B4zwr',
          ],
          ]
          ], */
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green-light',
                ],
            ],
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
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
        // refer settings section for all configuration options
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'edu@educatux.com.br',
                'password' => 'qwe2143315',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '/site/*',
            //'admin/*',
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
