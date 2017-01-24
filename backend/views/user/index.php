<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'username',
            [
                'attribute' => 'status',
                'value' => function ($model) {                      
                        return $model->getStatusLabel();
                },
                    'filter' => Html::activeDropDownList($searchModel, 'status', array(User::STATUS_ACTIVE =>User::STATUS_ACTIVE_LABEL, User::STATUS_DELETED=>User::STATUS_DELETED_LABEL),['class'=>'form-control','prompt' => '']),
            ],
            'email',
            [
                'attribute' => 'created_at',
                'format'=> ['date', 'php:d/m/Y H:s'],
                'headerOptions' => ['width' => '150'],
                'filter'=>'',                
            ],
                 
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //
            // 'status',
            // 
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Ação', 
                'headerOptions' => ['width' => '80'],
                'template' => '{senha} {update} {delete}',
                'buttons'=>[
                              'senha' => function ($url, $model) { 
                    
                                $auth = Yii::$app->authManager;
                                if($auth->getAssignment('administrador', $model->id)) return '';
                                
                                return Html::a('<span class="glyphicon glyphicon-refresh"></span>', $url, [
                                        'title' => \yii\helpers\Url::to(['user/senha', 'id'=>$model->id]),
                                ]);                                
            
                              },
                              'update' => function ($url, $model) { 
                                
                                $auth = Yii::$app->authManager;
                                if($auth->getAssignment('administrador', $model->id)) return '';
                                
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => \yii\helpers\Url::to(['user/update', 'id'=>$model->id]),
                                ]);                                
            
                              },
                              'delete' => function ($url, $model) {
                                  
                                $auth = Yii::$app->authManager;
                                if($auth->getAssignment('administrador', $model->id)) return '';
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => \yii\helpers\Url::to(['user/delete', 'id'=>$model->id]),
                                ]);                                
            
                              }
                ] 
            ],
        ],
    ]); ?>

</div>
