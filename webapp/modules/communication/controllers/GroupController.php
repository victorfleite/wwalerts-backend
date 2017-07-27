<?php

namespace webapp\modules\communication\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use webapp\modules\communication\models\Group;
use webapp\modules\communication\models\RlGroupRecipient;
use \webapp\modules\communication\models\AssociateRecipientGroupForm;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller {

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
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex() {
	$dataProvider = new ActiveDataProvider([
	    'query' => Group::find(),
	]);

	return $this->render('index', [
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single Group model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Group();

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing Group model.
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
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$this->findModel($id)->delete();

	return $this->redirect(['index']);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = Group::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

    public function actionAssociateRecipient($id) {

	$model = new AssociateRecipientGroupForm();
	$group = $this->findModel($id);

	if ($model->load(Yii::$app->request->post())) {
	    $recipients = $model->recipients;
	    // Delete all recipients found
	    RlGroupRecipient::deleteAll('group_id = :group_id', [':group_id' => $group->id]);
	    // Create jurisdictions 
	    if (is_array($recipients)) {
		foreach ($recipients as $id) {
		    $rl = new RlGroupRecipient();
		    $rl->recipient_id = $id;
		    $rl->group_id = $group->id;
		    $rl->save();
		}
	    }
	    return $this->redirect(['view', 'id' => $group->id]);
	}
	$model->recipients = $group->getAllRecipientsIds();
	return $this->render('associate-recipient', [
		    'model' => $model,
		    'group' => $group,
	]);
    }

}
