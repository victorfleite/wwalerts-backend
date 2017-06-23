<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = Yii::t('app', 'Alterar Variável', [
	    'modelClass' => 'Config',
	]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="config-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!empty($model->i18n)) { ?>
        <div class="alert alert-info">
	    <p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'config.documentation'); ?></strong></p> <p><?php echo \Yii::t('translation', $model->i18n); ?></p>
        </div>
    <?php } ?>
    <?=
    $this->render('_form', [
	'model' => $model,
    ])
    ?>

</div>
