<?php

namespace webapp\modules\local\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use \webapp\modules\local\models\Geometry;

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
	
	$geometry = new Geometry();
	$geometry->setLocalsArray(Geometry::LOCAL_COUNTRY, $post[Geometry::LOCAL_COUNTRY]);
	$geometry->setLocalsArray(Geometry::LOCAL_STATE, $post[Geometry::LOCAL_STATE]);
	$geometry->setLocalsArray(Geometry::LOCAL_REGION, $post[Geometry::LOCAL_REGION]);
	$geometry->setLocalsArray(Geometry::LOCAL_CITY, $post[Geometry::LOCAL_REGION]);

	return ['wkt'=>$geometry->getGeometryFromLocals()];
    }

}
