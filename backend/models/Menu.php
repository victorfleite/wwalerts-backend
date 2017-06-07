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


	/*return [
		['label' => 'Action', 'url' => '#'],
		['label' => 'Submenu 1', 'active' => true, 'items' => [
			['label' => 'Action', 'url' => '#'],
			['label' => 'Another action', 'url' => '#'],
			['label' => 'Something else here', 'url' => '#'],
		    '<li class="divider"></li>',
			['label' => 'Submenu 2', 'items' => [
				['label' => 'Action', 'url' => '#'],
				['label' => 'Another action', 'url' => '#'],
				['label' => 'Something else here', 'url' => '#'],
			    '<li class="divider"></li>',
				['label' => 'Separated link', 'url' => '#'],
			]],
		]],
		['label' => 'Something else here', 'url' => '#'],
	    '<li class="divider"></li>',
		['label' => 'Separated link', 'url' => '#'],
	];*/


	$languageMenu = ['label' => Yii::t('translation', 'menu.language'), 'items' => [
		    ['label' => Yii::t('translation', 'menu.language.english'), 'url' => ['site/set-language', 'language' => 'en']],
		    ['label' => Yii::t('translation', 'menu.language.portuguese'), 'url' => ['site/set-language', 'language' => 'pt-BR']],
	]];

	if (Yii::$app->user->isGuest) { // GUEST
	    $menuItems[] = $languageMenu;
	    $menuItems[] = ['label' => Yii::t('translation', 'menu.login'), 'url' => ['/site/login']];
	} else { // LOGGED
	    $menuItems[] = ['label' => Yii::t('translation', 'menu.home'), 'url' => ['/site/index']];
	    $menuItems[] = $languageMenu;

	    if (Yii::$app->user->can('/admin/*')) {

		//$line = '<li role="separator" class="divider"></li>';

		$generalConfigMenu = ['label' => Yii::t('translation', 'menu.general_config_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.user_register'), 'url' => ['/user/index']],
			    ['label' => Yii::t('translation', 'menu.access_control'), 'url' => ['/admin']],
			    ['label' => Yii::t('translation', 'menu.config_variables'), 'url' => ['/config']],
		]];

		$operativeMenu = ['label' => Yii::t('translation', 'menu.operative_menu_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.institution'), 'url' => ['/institution/index']],
			    ['label' => Yii::t('translation', 'menu.jurisdiction'), 'url' => ['/jurisdiction/index']],
			    ['label' => Yii::t('translation', 'menu.workgroup'), 'url' => ['/workgroup/index']]
		]];


		$menuItems[] = ['label' => Yii::t('translation', 'menu.administration'), 'items' => [
			$generalConfigMenu,
			$operativeMenu,
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
	    $menuItems[] = ['label' => Yii::$app->user->identity->username, 'options' => ['class' => 'nav navbar-nav navbar-right'], 'items' => [
		    $change,
		    $logout],
	    ];


	    return $menuItems;
	}
    }

}
