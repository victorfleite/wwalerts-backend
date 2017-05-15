<?php

/**
 */

namespace api\versions\v1\controllers;


class CheckServiceController extends \api\components\Controller {

    public function accessRules() {

        return [
            [
                'allow' => true,
                'actions' => ['status'],
                'verbs' => ['POST', 'GET'],
                'roles' => ['?'],
            ],
        ];
    }
    
    public function behaviors() {
	
        return [
	    /* CORS FILTER
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', 'GET'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],
	     
	    ]
	    */
	];
    }

    /**
     * Service to check if the server are anable.
     * @return type
     */
    public function actionStatus() {
        return ['success' => 'ok', 'message' => 'api funcionando'];
    }

}
