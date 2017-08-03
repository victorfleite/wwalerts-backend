<?php

namespace webapp\modules\communication\controllers;

use Yii;
use webapp\modules\communication\models\Trigger;
use webapp\modules\communication\models\AssociateTriggerGroupForm;
use \webapp\modules\communication\models\RlTriggerGroup;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TriggerController implements the CRUD actions for Trigger model.
 */
class TriggerController extends Controller {

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
     * Lists all Trigger models.
     * @return mixed
     */
    public function actionIndex() {
	$dataProvider = new ActiveDataProvider([
	    'query' => Trigger::find(),
	]);

	return $this->render('index', [
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single Trigger model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new Trigger model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Trigger();

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing Trigger model.
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
     * Deletes an existing Trigger model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$this->findModel($id)->delete();

	return $this->redirect(['index']);
    }

    /**
     * Associate Group of Recipients
     * @param type $id
     * @return type
     */
    public function actionAssociateGroup($id) {

	$model = new AssociateTriggerGroupForm();
	$trigger = $this->findModel($id);

	if ($model->load(Yii::$app->request->post())) {	    
	    $groups = $model->groups;	    
	    // Delete all jurisdictions found
	    RlTriggerGroup::deleteAll('trigger_id = :trigger_id', [':trigger_id' => $trigger->id]);
	    // Create jurisdictions 
	    if (is_array($groups)) {
		foreach ($groups as $id) {
		    $rl = new RlTriggerGroup();
		    $rl->group_id = $id;
		    $rl->trigger_id = $trigger->id;
		    $rl->save();
		}
	    }
	    return $this->redirect(['view', 'id' => $trigger->id]);
	}
	$model->groups = $trigger->getAllGroupsIds();
		    
	return $this->render('associate-group', [
		    'model' => $model,
		    'trigger' => $trigger,
	]);
    }

    /**
     * Finds the Trigger model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trigger the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = Trigger::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

}
