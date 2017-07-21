<?php

namespace webapp\modules\local\controllers;

use Yii;
use webapp\modules\local\models\City;
use webapp\modules\local\models\CitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
	return [
	    'verbs' => [
		'class' => VerbFilter::className(),
		'actions' => [
		    'delete' => ['POST'],
		],
	    ],
	];
    }

    /**
     * Lists all City models.
     * @return mixed
     */
    public function actionIndex() {
	$searchModel = new CitySearch();
	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	return $this->render('index', [
		    'searchModel' => $searchModel,
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single City model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new City();

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->gid]);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
	$model = $this->findModel($id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->gid]);
	} else {
	    return $this->render('update', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Deletes an existing City model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$this->findModel($id)->delete();

	return $this->redirect(['index']);
    }

    /**
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = City::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

    /**
     * Search for City filtered by token
     * @param type $q
     * @param type $id
     * @return type
     */
    public function actionCityList($q = null, $id = null) {

	\Yii::$app->response->format = Response::FORMAT_JSON;
	$out = ['results' => ['id' => '', 'text' => '']];
	if (!is_null($q)) {
	    $query = new Query;
	    $query->select('gid as id, name AS text')
		    ->from('local.city')
		    ->where(['ilike', 'remove_accent(name)', \common\models\Util::removeAccent($q)])
		    ->limit(20);
	    $command = $query->createCommand();
	    $data = $command->queryAll();
	    $out['results'] = array_values($data);
	} elseif ($id > 0) {
	    $out['results'] = ['id' => $id, 'text' => City::find($id)->name];
	}
	return $out;
    }

}
