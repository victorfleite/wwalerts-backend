<?php

namespace webapp\modules\communication\controllers;

use Yii;
use webapp\modules\communication\models\TriggerGroupFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \webapp\modules\communication\models\Group;

/**
 * TriggerGroupFilterController implements the CRUD actions for TriggerGroupFilter model.
 */
class TriggerGroupFilterController extends Controller {

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
     * Displays a single TriggerGroupFilter model.
     * @param integer $trigger_id
     * @param integer $group_id
     * @return mixed
     */
    public function actionView($trigger_id, $group_id) {
	return $this->render('view', [
		    'model' => $this->findModel($trigger_id, $group_id),
		    'group' => Group::findOne($group_id),
	]);
    }

    /**
     * Creates a new TriggerGroupFilter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($group_id) {
	$model = new TriggerGroupFilter();
	$model->group_id = $group_id;
	$group = Group::findOne($group_id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'trigger_id' => $model->trigger_id, 'group_id' => $model->group_id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
			'group' => $group
	    ]);
	}
    }

    /**
     * Updates an existing TriggerGroupFilter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $trigger_id
     * @param integer $group_id
     * @return mixed
     */
    public function actionUpdate($trigger_id, $group_id) {
	$model = $this->findModel($trigger_id, $group_id);
	$group = Group::findOne($group_id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'trigger_id' => $model->trigger_id, 'group_id' => $model->group_id]);
	} else {
	    return $this->render('update', [
			'model' => $model,
			'group' => $group
	    ]);
	}
    }

    /**
     * Deletes an existing TriggerGroupFilter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $trigger_id
     * @param integer $group_id
     * @return mixed
     */
    public function actionDelete($trigger_id, $group_id) {
	$this->findModel($trigger_id, $group_id)->delete();

	return $this->redirect(['/communication/group/view', 'trigger_id' => $trigger_id, 'group_id' => $group_id]);
    }

    /**
     * Finds the TriggerGroupFilter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $trigger_id
     * @param integer $group_id
     * @return TriggerGroupFilter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($trigger_id, $group_id) {
	if (($model = TriggerGroupFilter::findOne(['trigger_id' => $trigger_id, 'group_id' => $group_id])) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

}
