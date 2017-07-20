<?php

namespace webapp\controllers;

use Yii;
use webapp\models\Language;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \webapp\models\SourceMessage;
use \webapp\models\Message;

/**
 * LanguageController implements the CRUD actions for Language model.
 */
class LanguageController extends Controller {

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
     * Lists all Language models.
     * @return mixed
     */
    public function actionIndex() {
	$dataProvider = new ActiveDataProvider([
	    'query' => Language::find(),
	    'sort' => ['defaultOrder' => ['code' => SORT_ASC]]
	]);

	return $this->render('index', [
		    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Creates a new Language model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Language();

	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    return $this->redirect(['index']);
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
	if (($model = Language::findOne($id)) !== null) {
	    return $model;
	} else {
	    throw new NotFoundHttpException('The requested page does not exist.');
	}
    }

    /**
     * Toggle status an existing language model.
     * @param integer $id
     * @return mixed
     */
    public function actionToggleStatus($id) {
	$model = $this->findModel($id);
	if ($model->status == Language::STATUS_ACTIVE) {
	    $model->status = Language::STATUS_INACTIVE;
	} else {
	    $model->status = Language::STATUS_ACTIVE;
	}
	$model->save();

	return $this->redirect(['index']);
    }

    /**
     * Edit messages of a specific language
     * @param type $code
     * @return type
     */
    public function actionEditMessages($code) {

	$language = Language::findOne(['code' => $code]);
	$language->loadProprieties();

	if (\Yii::$app->request->isPost) {
	    $language->translations = \Yii::$app->request->getBodyParam("Language")["translations"];
	    foreach ($language->translations as $key => $el) {
		$message = Message::findOne(['id' => $key, 'language' => $language->code]);
		if (!isset($message))
		    $message = new Message();
		$message->id = $key;
		$message->language = $language->code;
		$message->translation = $el;
		$message->save();
	    }
	}

	return $this->render('edit-messages', [
		    'language' => $language,
	]);
    }

    /**
     * Deletes an existing SourceMessage model and Message.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteSourceMessage($id) {

	$code = \Yii::$app->request->getBodyParam("Language")["code"];

	$key = SourceMessage::findOne(['id' => $id, 'category' => SourceMessage::CATEGORY])->message;

	Message::deleteAll(['id' => $id]);
	SourceMessage::deleteAll(['id' => $id, 'category' => SourceMessage::CATEGORY]);

	\Yii::$app->getSession()->setFlash('danger', [
	    'type' => 'success',
	    'duration' => 12000,
	    'icon' => 'glyphicon glyphicon-ok-sign',
	    'title' => \Yii::t('translation', 'Info'),
	    'message' => \Yii::t('translation', 'language.source_message_deleted', ['key' => $key]),
	    'positonY' => 'top',
	    'positonX' => 'left'
	]);



	return $this->redirect(['edit-messages', 'code' => $code]);
    }

    /**
     * Save a Source Message 
     * @return type
     */
    public function actionSaveSourceMessage() {
	$code = \Yii::$app->request->post('code'); // Language code
	$model = new SourceMessage();
	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    \Yii::$app->getSession()->setFlash('danger', [
		'type' => 'success',
		'duration' => 12000,
		'icon' => 'glyphicon glyphicon-ok-sign',
		'title' => \Yii::t('translation', 'Info'),
		'message' => \Yii::t('translation', 'language.source_message_saved', ['key' => $model->message]),
		'positonY' => 'top',
		'positonX' => 'left'
	    ]);
	    return $this->redirect(['edit-messages', 'code' => $code]);
	} else {
	    if ($model->hasErrors('message')) {
		\Yii::$app->getSession()->setFlash('danger', [
		    'type' => 'danger',
		    'duration' => 12000,
		    'icon' => 'glyphicon glyphicon-exclamation-sign',
		    'title' => \Yii::t('translation', 'Notice'),
		    'message' => $model->getFirstError('message'),
		    'positonY' => 'top',
		    'positonX' => 'left'
		]);
	    }
	    return $this->redirect(['edit-messages', 'code' => $code]);
	}
    }

    /**
     * Update the translations of a specific sourceMessage
     * @return type
     */
    public function actionKeyTranslationViewAndUpdate() {

	$message = Yii::$app->request->get('message');
	$fieldType = Yii::$app->request->get('fieldType');
	$rows = Yii::$app->request->get('rows');
	$sourceMessage = SourceMessage::find()->where(['message' => $message, 'category' => SourceMessage::CATEGORY])->one();

	if (!\Yii::$app->request->isPost) {
	    // first time here	    
	    // Create key if not exists
	    if (empty($sourceMessage)) {
		$sourceMessage = new SourceMessage();
		$sourceMessage->category = SourceMessage::CATEGORY;
		$sourceMessage->message = trim($message);
		$sourceMessage->save();
	    }

	    $languages = Language::find()->where([])->orderBy('code')->all();
	    $inputs = [];
	    if (is_array($languages)) {
		foreach ($languages as $language) {
		    $messageObj = Message::find()->where(['id' => $sourceMessage->id, 'language' => $language->code])->one();
		    $inputs[$language->code] = (!empty($messageObj) ? $messageObj->translation : '');
		}
	    }

	    return $this->renderAjax('key-translation-update-form', [
			'sourceMessage' => $sourceMessage,
			'inputs' => $inputs,
			'fieldType' => ((!empty($fieldType)) ? $fieldType : 'text'),
			'options' => [
			    'rows' => $rows
			]
	    ]);
	} else {
	    
	    
	    // is Post Back
	    $translation = \Yii::$app->request->getBodyParam("translation"); //Array of languages and translations
	    
	    if (is_array($translation)) {
		$providerData = [];
		foreach ($translation as $languageCode => $value) {
		    $messageObj = Message::findOne(['id' => $sourceMessage->id, 'language' => $languageCode]);
		    if (!isset($messageObj))
			$messageObj = new Message();
		    $messageObj->id = $sourceMessage->id;
		    $messageObj->language = $languageCode;
		    $messageObj->translation = $value;
		    $messageObj->save();

		    $providerData[] = ['language' => \Yii::t('translation', 'language.' . $languageCode), 'value' => $value];
		}

		$languageProvider = new ArrayDataProvider([
		    'allModels' => $providerData,
		    'sort' => [
			'attributes' => ['label', 'value'],
		    ],
		]);

		return $this->renderAjax('key-translation-view', [
			    "sourceMessage" => $sourceMessage,
			    "fieldType" => $fieldType,
			    "rows" => $rows,
			    "languageProvider" => $languageProvider
		]);
	    }
	}
    }

}
