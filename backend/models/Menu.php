<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use yii\helpers\Html;

/**
 * Description of Menu
 *
 * @author victor.leite
 */
class Menu {

    public static function getMainManu() {


	$languageMenu = ['label' => Yii::t('translation', 'menu.language'), 'items' => [
		    ['label' => Yii::t('translation', 'menu.language.english'), 'url' => ['site/set-language', 'language' => 'en']],
		    ['label' => Yii::t('translation', 'menu.language.portuguese'), 'url' => ['site/set-language', 'language' => 'pt-BR']],
	]];
	if (Yii::$app->user->isGuest) {
	    $menuItems[] = $languageMenu;
	    $menuItems[] = ['label' => Yii::t('translation', 'menu.login'), 'url' => ['/site/login']];
	} else {
	    $menuItems[] = ['label' => Yii::t('translation', 'menu.home'), 'url' => ['/site/index']];
	    $menuItems[] = $languageMenu;
	    if (Yii::$app->user->can('/admin/*')) {

		$registerItem = ['label' => Yii::t('translation', 'menu.user_register'), 'url' => ['/user/index']];
		$accessControlItem = ['label' => Yii::t('translation', 'menu.access_control'), 'url' => ['/admin']];
		$line = '<li role="separator" class="divider"></li>';
		// Operative
		$institutionItem = ['label' => Yii::t('translation', 'menu.institution'), 'url' => ['/institution/index']];
		$jurisdictionItem = ['label' => Yii::t('translation', 'menu.jurisdiction'), 'url' => ['/jurisdiction/index']];
		$workgroupItem = ['label' => Yii::t('translation', 'menu.workgroup'), 'url' => ['/workgroup/index']];

		$menuItems[] = ['label' => Yii::t('translation', 'menu.administration'), 'items' => [
			$registerItem,
			$accessControlItem,
			$line,
			$institutionItem,
			$jurisdictionItem,
			$workgroupItem
		    ],
		];
	    }


	    $change = ['label' => Yii::t('translation', 'menu.change_password'), 'url' => ['/site/request-password-reset']];
	    $logout = '<li>'
		    . Html::beginForm(['/site/logout'], 'post')
		    . Html::submitButton(
			    Yii::t('translation', 'menu.logout'), ['class' => 'btn btn-link logout']
		    )
		    . Html::endForm()
		    . '</li>';

	    // Profile
	    $menuItems[] = ['label' => Yii::$app->user->identity->username, 'items' => [
		    $change,
		    $logout],
	    ];


	    return $menuItems;
	}
    }

}
