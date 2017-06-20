<?php

namespace webapp\modules\local\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

class GeometryController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
	return [
	    'verbs' => [
		'class' => VerbFilter::className(),
		'actions' => [
		    'merge-locations' => ['POST'],
		],
	    ],
	];
    }

    /**
     * Merge Locations
     * @return mixed
     */
    public function actionMergeLocations() {
	\Yii::$app->response->format = Response::FORMAT_JSON;
	$post = Yii::$app->request->post();


	return ['wkt'=>'bla bla bla'];
    }

}
