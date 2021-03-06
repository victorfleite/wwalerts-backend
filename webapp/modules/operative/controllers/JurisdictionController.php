<?php

namespace webapp\modules\operative\controllers;

use Yii;
use \webapp\modules\operative\models\Jurisdiction;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JurisdictionController implements the CRUD actions for Jurisdiction model.
 */
class JurisdictionController extends Controller {

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
     * Lists all Jurisdiction models.
     * @return mixed
     */
    public function actionIndex() {
	$dataProvider = new ActiveDataProvider([
	    'query' => Jurisdiction::find(),
	]);

	return $this->render('index', [
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single Jurisdiction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
	return $this->render('view', [
		    'model' => $this->findModel($id),
	]);
    }

    /**
     * Creates a new Jurisdiction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Jurisdiction();

	// Preview Wkt on MAP
	if (isset(Yii::$app->request->post()['btn-preview'])) {
	    $model->load(Yii::$app->request->post());
	    $model->validate();
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing Jurisdiction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
	$model = $this->findModel($id);

	// Preview Wkt on MAP
	if (isset(Yii::$app->request->post()['btn-preview'])) {
	    $model->load(Yii::$app->request->post());
	    $model->validate();
	    return $this->render('update', [
			'model' => $model,
	    ]);
	}

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['view', 'id' => $model->id]);
	} else {
	    return $this->render('update', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Deletes an existing Jurisdiction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
	$this->findModel($id)->delete();

	return $this->redirect(['index']);
    }

    /**
     * Finds the Jurisdiction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jurisdiction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = Jurisdiction::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

}
