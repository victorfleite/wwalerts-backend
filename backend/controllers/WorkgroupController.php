<?php

namespace backend\controllers;

use Yii;
use app\models\Workgroup;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AssociateJurisdictionWorkgroupForm;
use app\models\AssociateUserWorkgroupForm;
use app\models\RlWorkgroupJurisdiction;

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
	$model->jurisdictions = Json::encode($workgroup->getJurisdictionsAsArray());


	if ($model->load(Yii::$app->request->post())) {
	    $jurisdictions = Json::decode($model->jurisdictions);
	    // Delete all jurisdictions found
	    RlWorkgroupJurisdiction::deleteAll('workdgroup_id = :workgroup_id', [':workgroup_id' => $workgroup->id]);
	    // Create jurisdictions 
	    foreach ($jurisdictions as $id) {
		$rl = new RlWorkgroupJurisdiction();
		$rl->jurisdiction = $id;
		$rl->workgroup_id = $workgroup->id;
		$rl->save();
	    }
	}

	return $this->render('associate-jurisdictions', [
		    'model' => $model,
		    'grupo' => $workgroup,
	]);
    }

    public function actionAssociarUsuarios($id) {

	$model = new AssociarUsuarioGrupoForm();
	$grupo = $this->findModel($id);
	$model->usuarios = Json::encode($grupo->getIdsUsuariosAssociadosArray());


	if ($model->load(Yii::$app->request->post())) {
	    $usuarios = Json::decode($model->usuarios);
	    // Deleta todos as jurisdicoes encontradas do grupo
	    RlGrupoUsuario::deleteAll('grupo_id = :grupo_id', [':grupo_id' => $grupo->id]);
	    // Cria as jurisdicoes
	    foreach ($usuarios as $idUsuario) {
		$rl = new RlGrupoUsuario();
		$rl->usuario_id = $idUsuario;
		$rl->grupo_id = $grupo->id;
		$rl->save();
	    }
	}

	return $this->render('associar-usuarios', [
		    'model' => $model,
		    'grupo' => $grupo,
	]);
    }

}
