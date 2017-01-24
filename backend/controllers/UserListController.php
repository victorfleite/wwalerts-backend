<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use common\models\User;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserListController extends Controller
{
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
  public function actionUserList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'username' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, username AS text')
                    ->from('user')
                    ->where(['like', 'username', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $user = User::find($id);
            $out['results'] = ['id' => $id, 'text' => $user->username.'('.$user->email.')'];
        }
        return $out;
    }
   
}
