<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

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

	    $languageMenu = ['label' => Yii::t('translation', 'menu.language'), 'items' => [
			['label' => 'English', 'url' => ['site/set-language', 'language' => 'en']],
			['label' => 'Portuguese', 'url' => ['site/set-language', 'language' => 'pt-BR']],
	    ]];
	    if (Yii::$app->user->isGuest) {
		$menuItems[] = $languageMenu;
		$menuItems[] = ['label' => Yii::t('translation', 'menu.login'), 'url' => ['/site/login']];
	    } else {
		$menuItems[] = ['label' => Yii::t('translation', 'menu.home'), 'url' => ['/site/index']];
		$menuItems[] = $languageMenu;
		if (Yii::$app->user->can('/site/signup')) {
		    
		    $userRegister = ['label' => Yii::t('translation', 'menu.register'), 'url' => ['/site/signup']];
		    $userAdministration = ['label' => Yii::t('translation', 'menu.register'), 'url' => ['/admin']];
		    
		    $menuItems[] = ['label' => Yii::t('translation', 'menu.administration'), 'items' => [
			    $userRegister,
			    $userAdministration],
		    ];
		}
		$menuItems[] = '<li>'
			. Html::beginForm(['/site/logout'], 'post')
			. Html::submitButton(
				Yii::t('translation', 'menu.logout') . ' (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
			)
			. Html::endForm()
			. '</li>';
	    }
	    echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => $menuItems,
	    ]);
	    NavBar::end();
	    ?>

	    <div class="container">
		<?=
		Breadcrumbs::widget([
		    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		])
		?>
		<?= Alert::widget() ?>
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
