# Template Yii2 with Api/Rest

This project is a template for development of web application and api/rest toguether

## INSTALLATION

Create a new repository

    1. $ git clone git@gitlab.inmet.gov.br:csc/template-yii-2.0.git
    2. $ mv template-yii-2.0 yourFolderName

Install Composer. For [more](https://getcomposer.org/doc/).

	3. $ curl -sS https://getcomposer.org/installer | php
	4. $ sudo mv composer.phar /usr/local/bin/composer
	5. $ sudo chown -fR yourUser:root /usr/local/bin/composer
	6. $ sudo composer global require "fxp/composer-asset-plugin:^1.3.1"
Update Composer

    7. $ cd yourFolderName
    8. $ composer update
    9. Create your local database
    
```php
10. Set the database configuration on common/config/main-local.php
<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=localhost;dbname=databasename',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
        ],
        ...
    ],
];
```

    11. $ php yii migrate
         * Type YES
    12. $ sudo chmod 777 /var/www/html/yourFolderName/backend/web/assets

## USAGE    

Access you application on `http://localhost/yourFolderName`

Insert the username: victor.leite

Insert the password: mypassword

Login into the system (You have the administrator role)    :-)


### EXEMPLE API CALLS
-------------------

```
1. Token access required
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/yourFolderName/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@gmail.com","password":"mypassword","client_id":"myclientId","client_secret":"mySecretPassword"}'

2. Token access required with scope
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/yourFolderName/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@gmail.com","password":"mypassword","client_id":"myclientId","client_secret":"mySecretPassword","scope":"custom"}'

3 - User data required
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/yourFolderName/service/api/www/index.php/v1/user/get-user?access_token={TOKEN_GERADO_NA_AUTENTICACAO}"
```
	
## CONTRIBUTION

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## HISTORY

I decided to create this project to help people to accelerate the proccess to create application and services/api rest in the same project.

## CREDITS

[mdmsoft/yii2-admin](https://github.com/mdmsoft/yii2-admin)

[filsh/yii2-oauth2-server](https://github.com/Filsh/yii2-oauth2-server)

[mootensai/yii2-enhanced-gii](https://github.com/mootensai/yii2-enhanced-gii)


## LICENCE

The MIT License

===============================

## DIRECTORY STRUCTURE
-------------------

```
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains widgets for the Web application
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
service    
    api/common/		 contains controllers or models commons for api application
    api/components/	 contains components that could be inherited by classes and controllers in each version (ex: versions/v1)
    api/config/		 contains shared configurations
    api/versions/	 versions of application
    api/www/		 initial folder for application
vendor/              contains dependent 3rd-party packages
```

===============================