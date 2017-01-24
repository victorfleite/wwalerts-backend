<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\button_check_service_widget\ButtonCheckServiceWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Configurações Gerais');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'varname',
            'value',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]);
    ?>
    <?php $configs = \Yii::$app->config->getVars(); ?>
    <?=
    ButtonCheckServiceWidget::widget([
        'title' => 'Testar tunnel com a Central',
        'method' => 'post',
        'url' => $configs["API_CENTRAL_URL_ADDRESS"] . "/v2/check-service/check-communication-between-escola-and-central",
        'params' => array("serverid" => $configs["SERVERID"], "masterkey" => $configs["MASTERKEY"]),
        'msg_page_not_founded' => 'Pagina nao encontrada',
        'autoClick' => true
    ])
    ?>
    
</div>
