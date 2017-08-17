<?php

namespace webapp\modules\risk\controllers;

use Yii;
use webapp\modules\risk\models\EventRiskInstructionItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \webapp\modules\risk\models\EventRiskInstruction;

/**
 * EventRiskInstructionItemController implements the CRUD actions for EventRiskInstructionItem model.
 */
class EventRiskInstructionItemController extends Controller {

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
     * Lists all EventRiskInstructionItem models.
     * @return mixed
     */
    public function actionIndex() {
	$dataProvider = new ActiveDataProvider([
	    'query' => EventRiskInstructionItem::find(),
	]);

	return $this->render('index', [
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single EventRiskInstructionItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new EventRiskInstructionItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($event_risk_instruction_id) {
	$model = new EventRiskInstructionItem();
	$model->event_risk_instruction_id = $event_risk_instruction_id;
	$eventRiskInstruction = EventRiskInstruction::findOne($event_risk_instruction_id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
			'eventRiskInstruction' => $eventRiskInstruction
	    ]);
	}
    }

    /**
     * Updates an existing EventRiskInstructionItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
	$model = $this->findModel($id);
	$eventRiskInstruction = EventRiskInstruction::findOne($model->event_risk_instruction_id);

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('update', [
			'model' => $model,
			'eventRiskInstruction' => $eventRiskInstruction
	    ]);
	}
    }

    /**
     * Deletes an existing EventRiskInstructionItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$obj = $this->findModel($id);
	$event_risk_instruction_id = $obj->event_risk_instruction_id;
	$obj->delete();

	return $this->redirect(['/risk/event-risk-instruction/view', 'id'=>$event_risk_instruction_id]);
    }

    /**
     * Finds the EventRiskInstructionItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventRiskInstructionItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = EventRiskInstructionItem::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

}
