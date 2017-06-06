<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Workgroup;
use backend\models\AssociateJurisdictionWorkgroupForm;
use backend\models\AssociateUserWorkgroupForm;
use backend\models\RlWorkgroupJurisdiction;
use backend\models\RlWorkgroupUser;

/**
 * WorkgroupController implements the CRUD actions for Workgroup model.
 */
class WorkgroupController extends Controller {

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
     * Lists all Workgroup models.
     * @return mixed
     */
    public function actionIndex() {
	$dataProvider = new ActiveDataProvider([
	    'query' => Workgroup::find(),
	]);

	return $this->render('index', [
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single Workgroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new Workgroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Workgroup();

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing Workgroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
	$model = $this->findModel($id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('update', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Deletes an existing Workgroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$this->findModel($id)->delete();

	return $this->redirect(['index']);
    }

    /**
     * Finds the Workgroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workgroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = Workgroup::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

    public function actionAssociateJurisdiction($id) {

	$model = new AssociateJurisdictionWorkgroupForm();
	$workgroup = $this->findModel($id);

	if ($model->load(Yii::$app->request->post())) {
	    $jurisdictions = $model->jurisdictions;
	    // Delete all jurisdictions found
	    RlWorkgroupJurisdiction::deleteAll('workgroup_id = :workgroup_id', [':workgroup_id' => $workgroup->id]);
	    // Create jurisdictions 
	    if (is_array($jurisdictions)) {
		foreach ($jurisdictions as $id) {
		    $rl = new RlWorkgroupJurisdiction();
		    $rl->jurisdiction_id = $id;
		    $rl->workgroup_id = $workgroup->id;
		    $rl->save();
		}
	    }
	    return $this->redirect(['view', 'id' => $workgroup->id]);
	}
	$model->jurisdictions = $workgroup->getAllJurisdictionsIds();
	return $this->render('associate-jurisdictions', [
		    'model' => $model,
		    'workgroup' => $workgroup,
	]);
    }

     public function actionAssociateUsers($id) {

	$model = new AssociateUserWorkgroupForm();
	$workgroup = $this->findModel($id);

	if ($model->load(Yii::$app->request->post())) {
	    $users = $model->users;
	    // Delete all jurisdictions found
	    RlWorkgroupUser::deleteAll('workgroup_id = :workgroup_id', [':workgroup_id' => $workgroup->id]);
	    // Create jurisdictions 
	    if (is_array($users)) {
		foreach ($users as $id) {
		    $rl = new RlWorkgroupUser();
		    $rl->user_id = $id;
		    $rl->workgroup_id = $workgroup->id;
		    $rl->save();
		}
	    }
	    return $this->redirect(['view', 'id' => $workgroup->id]);
	}
	$model->users = $workgroup->getAllUsersIds();
	return $this->render('associate-users', [
		    'model' => $model,
		    'workgroup' => $workgroup,
	]);
    }

}
