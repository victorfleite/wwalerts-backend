<?php

namespace backend\controllers;

use Yii;
use backend\models\Region;
use backend\models\RegionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller {

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
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex() {
	$searchModel = new RegionSearch();
	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	return $this->render('index', [
		    'searchModel' => $searchModel,
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Region();

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->gid]);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing Region model.
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
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$this->findModel($id)->delete();

	return $this->redirect(['index']);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = Region::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

    /**
     * Search for Region filtered by token
     * @param type $q
     * @param type $id
     * @return type
     */
    public function actionRegionList($q = null, $id = null) {

	\Yii::$app->response->format = Response::FORMAT_JSON;
	$out = ['results' => ['id' => '', 'text' => '']];
	if (!is_null($q)) {
	    $query = new Query;
	    $query->select('gid as id, nm_meso AS text')
		    ->from('local.region')
		    ->where(['ilike', 'remove_accent(nm_meso)', \common\models\Util::removeAccent($q)])
		    ->limit(20);
	    $command = $query->createCommand();
	    $data = $command->queryAll();
	    $out['results'] = array_values($data);
	} elseif ($id > 0) {
	    $out['results'] = ['id' => $id, 'text' => Region::find($id)->name];
	}
	return $out;
    }

}
