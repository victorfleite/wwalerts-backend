<?php

namespace api\versions\v1\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use api\versions\v1\models\common\User;

/**
 * User Controller API
 *
 * @author Victor Leite
 */
class UserController extends \api\components\Controller {


    public function accessRules() {
        return [
            [
                'allow' => true,
                'actions' => ['get-user'],
                'roles' => ['@'],
            ]
        ];
    }

    public function actionGetUser() {

        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
	
	$user = ArrayHelper::toArray($user);
        unset($user["auth_key"]);
	unset($user["password_hash"]);
	unset($user["password_reset_token"]);	
    
        return array("user" => $user);
    }


}
