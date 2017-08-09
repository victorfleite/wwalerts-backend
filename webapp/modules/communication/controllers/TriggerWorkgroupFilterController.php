<?php

namespace webapp\modules\communication\controllers;

use Yii;
use webapp\modules\communication\models\TriggerWorkgroupFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use webapp\modules\operative\models\Workgroup;

/**
 * TriggerWorkgroupFilterController implements the CRUD actions for TriggerWorkgroupFilter model.
 */
class TriggerWorkgroupFilterController extends Controller {

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
     * Displays a single TriggerWorkgroupFilter model.
     * @param integer $trigger_id
     * @param integer $workgroup_id
     * @return mixed
     */
    public function actionView($trigger_id, $workgroup_id) {
	return $this->render('view', [
		    'model' => $this->findModel($trigger_id, $workgroup_id),
		    'workgroup' => Workgroup::findOne($workgroup_id),
	]);
    }

    /**
     * Creates a new TriggerWorkgroupFilter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($workgroup_id) {
	$model = new TriggerWorkgroupFilter();
	$model->workgroup_id = $workgroup_id;
	$workgroup = Workgroup::findOne($workgroup_id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'trigger_id' => $model->trigger_id, 'workgroup_id' => $model->workgroup_id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
			'workgroup' => $workgroup
	    ]);
	}
    }

    /**
     * Updates an existing TriggerWorkgroupFilter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $trigger_id
     * @param integer $workgroup_id
     * @return mixed
     */
    public function actionUpdate($trigger_id, $workgroup_id) {
	$model = $this->findModel($trigger_id, $workgroup_id);
	$workgroup = Workgroup::findOne($workgroup_id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'trigger_id' => $model->trigger_id, 'workgroup_id' => $model->workgroup_id]);
	} else {
	    return $this->render('update', [
			'model' => $model,
			'workgroup' => $workgroup
	    ]);
	}
    }

    /**
     * Deletes an existing TriggerWorkgroupFilter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $trigger_id
     * @param integer $workgroup_id
     * @return mixed
     */
    public function actionDelete($trigger_id, $workgroup_id) {
	$this->findModel($trigger_id, $workgroup_id)->delete();

	return $this->redirect(['/communication/workgroup/view', 'trigger_id' => $trigger_id, 'workgroup_id' => $workgroup_id]);
    }

    /**
     * Finds the TriggerWorkgroupFilter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $trigger_id
     * @param integer $workgroup_id
     * @return TriggerWorkgroupFilter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($trigger_id, $workgroup_id) {
	if (($model = TriggerWorkgroupFilter::findOne(['trigger_id' => $trigger_id, 'workgroup_id' => $workgroup_id])) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

}
