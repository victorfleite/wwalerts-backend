<?php

namespace webapp\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use common\models\LoginForm;
use common\models\User;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
	return [
	    'verbs' => [
		'class' => VerbFilter::className(),
		'actions' => [
		    'logout' => ['post'],
		],
	    ],
	];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
	return [
	    'error' => [
		'class' => 'yii\web\ErrorAction',
	    ],
	    'captcha' => [
		'class' => 'yii\captcha\CaptchaAction',
		'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
	    ],
	];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
	return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
	if (!Yii::$app->user->isGuest) {
	    return $this->goHome();
	}

	$model = new LoginForm();
	if ($model->load(Yii::$app->request->post()) && $model->login()) {
	    return $this->goBack();
	} else {
	    return $this->render('login', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
	Yii::$app->user->logout();

	return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
	$model = new PasswordResetRequestForm();

	//User Logged
	if (!Yii::$app->user->isGuest) {
	    $user = User::findOne(Yii::$app->user->id);
	    $model->email = $user->email;
	}


	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
	    if ($model->sendEmail()) {
		\Yii::$app->getSession()->setFlash('success', [
		    'type' => 'success',
		    'duration' => 12000,
		    'icon' => 'glyphicon glyphicon-ok-sign',
		    'title' => \Yii::t('translation', 'Info'),
		    'message' => \Yii::t('translation', 'site.login.form_reset_password.check_message_further'),
		    'positonY' => 'top',
		    'positonX' => 'left'
		]);

		return $this->goHome();
	    } else {

		\Yii::$app->getSession()->setFlash('danger', [
		    'type' => 'danger',
		    'duration' => 12000,
		    'icon' => 'glyphicon glyphicon-exclamation-sign',
		    'title' => \Yii::t('translation', 'Notice'),
		    'message' => \Yii::t('translation', 'site.login.form_reset_password.error_email_message_fail'),
		    'positonY' => 'top',
		    'positonX' => 'left'
		]);
	    }
	}

	return $this->render('requestPasswordResetToken', [
		    'model' => $model,
	]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
	try {
	    $model = new ResetPasswordForm($token);
	} catch (InvalidParamException $e) {
	    throw new BadRequestHttpException($e->getMessage());
	}

	if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {

	    \Yii::$app->getSession()->setFlash('success', [
		'type' => 'success',
		'duration' => 12000,
		'icon' => 'glyphicon glyphicon-ok-sign',
		'title' => \Yii::t('translation', 'Notice'),
		'message' => \Yii::t('translation', 'site.login.form_reset_password.new_password_saved'),
		'positonY' => 'top',
		'positonX' => 'left'
	    ]);

	    return $this->goHome();
	}

	return $this->render('resetPassword', [
		    'model' => $model,
	]);
    }

    public function actionSetLanguage() {

	$language = Yii::$app->request->get('language');
	Yii::$app->language = $language;

	$languageCookie = new Cookie([
	    'name' => 'language',
	    'value' => $language,
	    'expire' => time() + 60 * 60 * 24 * 30, // 30 days
	]);
	Yii::$app->response->cookies->add($languageCookie);


	Yii::$app->getSession()->setFlash('success', [
	    'type' => 'success',
	    'duration' => 12000,
	    'icon' => 'glyphicon glyphicon-ok-sign',
	    'title' => Yii::t('translation', 'site.set_language.message_language_selected_title'),
	    'message' => Yii::t('translation', 'site.set_language.message_language_selected', ['language' => $language]),
	    'positonY' => 'top',
	    'positonX' => 'left'
	]);

	return $this->render('setLanguage');
    }

    /*
      public function actionMigrationInserts() {

      $tablesSchemas = \Yii::$app->db->schema->getTableSchemas();
      echo "<pre>";
      foreach ($tablesSchemas as $tableSchema) {


      $values = \Yii::$app->db->createCommand('SELECT * FROM ' . $tableSchema->name)->queryAll();
      foreach ($values as $value) {
      echo "$" . "this->insert('" . $tableSchema->name . "', [\n";
      foreach ($tableSchema->columns as $columnSchema) {
      $columnName = $columnSchema->name;
      if (isset($value[$columnName]) && !empty($value[$columnName])) {
      echo "\t'" . $columnName . "' => ".self::verifyTypeAndPutComma($columnSchema, $value[$columnName]).",\n";
      }
      }
      echo "]);\n\n";
      }
      }
      echo "</pre>";
      }
      static function verifyTypeAndPutComma($columnSchema, $value){
      //echo $columnSchema->dbType;
      if($columnSchema->dbType == "varchar"){
      return "'".$value."'";
      }
      if($columnSchema->dbType == "timestamp"){
      return "'".$value."'";
      }

      return $value;
      } */
}
