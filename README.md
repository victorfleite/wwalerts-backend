Template Yii2 with Api/Rest
===============================
This project is a template for development of web application and api/rest

DIRECTORY STRUCTURE
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
