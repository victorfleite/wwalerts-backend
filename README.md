# Template Yii2 with Api/Rest

This project is a template for development of web application and api/rest toguether

## INSTALLATION

    Create a new repository

	1. git clone git@gitlab.inmet.gov.br:csc/template-yii-2.0.git
	2. mv template-yii-2.0 yourFolderName

	3. Install Composer. For [more](https://getcomposer.org/doc/ "Composer install") 
```
	    curl -sS https://getcomposer.org/installer | php
	    mv composer.phar /usr/local/bin/composer
	    composer global require "fxp/composer-asset-plugin:^1.3.1"
```
	4. cd yourFolderName
	5. composer update
	
## USAGE

	TODO: Write usage instructions


## CONTRIBUTION

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## HISTORY

    

## CREDITS

    [mdmsoft/yii2-admin](https://github.com/mdmsoft/yii2-admin "mdmsoft/yii2-admin")
    [filsh/yii2-oauth2-server](https://github.com/Filsh/yii2-oauth2-server "filsh/yii2-oauth2-server")


## LICENCE
MIT


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
vendor/                  contains dependent 3rd-party packages
```

===============================

## API EXEMPLE CALLS
-------------------

```
1. Token access required
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@inmet.gov.br","password":"minhasenha","client_id":"meucliente","client_secret":"minhasenha"}'

2. Token access required with scope
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@inmet.gov.br","password":"minhasenha","client_id":"meucliente","client_secret":"minhasenha","scope":"custom"}'

3 - User data required
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/v1/user/get-user?access_token={TOKEN_GERADO_NA_AUTENTICACAO}"
```