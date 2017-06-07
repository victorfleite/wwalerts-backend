<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\models\Menu;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use kartik\nav\NavX;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
    </head>
    <body>
	<?php $this->beginBody() ?>

	<div class="wrap">
	    <?php
	    NavBar::begin([
		'brandLabel' => Yii::$app->id,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
		    'class' => 'navbar-inverse navbar-fixed-top',
		],
	    ]);
	    echo NavX::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => Menu::getMainManu(),
		'activateParents' => true,
		'encodeLabels' => false
	    ]);
	    NavBar::end();
	    ?>


	    <div class = "container">
		<?=
		Breadcrumbs::widget([
		    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		])
		?>
		<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
		    <?php
		    echo \kartik\widgets\Growl::widget([
			'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
			'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
			'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
			'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
			'showSeparator' => true,
			'delay' => 1, //This delay is how long before the message shows
			'pluginOptions' => [
			    'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
			/* 'placement' => [
			  'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
			  'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
			  ] */
			]
		    ]);
		    ?>
		<?php endforeach; ?>
		<?= $content ?>
	    </div>
	</div>

	<footer class="footer">
	    <div class="container">
		<p class="pull-left">&copy; <?php echo \Yii::$app->params['nameCompany']; ?> - <?php echo \Yii::$app->params['shortNameCompany']; ?> / <?= date('Y') ?></p>

	    </div>
	</footer>

	<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
