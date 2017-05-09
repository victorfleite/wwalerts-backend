<?php

namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use common\models\LoginForm;
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
	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
	    if ($model->sendEmail()) {
		Yii::$app->session->setFlash('success', Yii::t('translation', 'site.login.form_reset_password.check_message_further'));

		return $this->goHome();
	    } else {
		Yii::$app->session->setFlash('error', Yii::t('translation', 'site.login.form_reset_password.error_email_message_fail'));
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
	    Yii::$app->session->setFlash('success', 'New password saved.');

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

	Yii::$app->session->setFlash('success', Yii::t('translation', 'site.set_language.message_language_selected', ['language' => $language]));

	return $this->render('setLanguage');
    }

}
