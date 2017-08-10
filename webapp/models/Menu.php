<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace webapp\models;

use Yii;
use yii\helpers\Html;

/**
 * Description of Menu
 *
 * @author victor.leite
 */
class Menu {

    public static function getMainManu() {

	$languageMenu = ['label' => Yii::t('translation', 'menu.language') . ' (' . \Yii::$app->language . ')', 'items' => Language::getMenuLanguageItens()];

	if (Yii::$app->user->isGuest) { // GUEST
	    $menuItems[] = $languageMenu;
	    $menuItems[] = ['label' => Yii::t('translation', 'menu.login'), 'url' => ['/site/login']];
	} else { // LOGGED
	    $menuItems[] = ['label' => Yii::t('translation', 'menu.home'), 'url' => ['/site/index']];

	    if (Yii::$app->user->can('/admin/*')) {

		//$line = '<li role="separator" class="divider"></li>';
		// ALERTS MENU ITEM ---------------------------------------------------------------------------------
		$menuItems[] = ['label' => Yii::t('translation', 'menu.alerts_menu_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.alert_create_btn'), 'url' => ['/alert']],
			    ['label' => Yii::t('translation', 'menu.alerts_manage'), 'url' => ['/alert']]
		    ],
		];

		// ADMINISTRATION MENU ITEM------------------------------------------------------------------------------
		$generalConfigMenu = ['label' => Yii::t('translation', 'menu.general_config_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.user_register'), 'url' => ['/user/index']],
			    ['label' => Yii::t('translation', 'menu.access_control'), 'url' => ['/admin']],
			    ['label' => Yii::t('translation', 'menu.config_variables'), 'url' => ['/config']],
			    ['label' => Yii::t('translation', 'menu.languages'), 'url' => ['/language']],
		]];

		$operativeMenu = ['label' => Yii::t('translation', 'menu.operative_menu_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.institution'), 'url' => ['/operative/institution/index']],
			    ['label' => Yii::t('translation', 'menu.jurisdiction'), 'url' => ['/operative/jurisdiction/index']],
			    ['label' => Yii::t('translation', 'menu.workgroup'), 'url' => ['/operative/workgroup/index']]
		]];

		$localMenu = ['label' => Yii::t('translation', 'menu.local_menu_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.country'), 'url' => ['/local/country/index']],
			    ['label' => Yii::t('translation', 'menu.state'), 'url' => ['/local/state/index']],
			    ['label' => Yii::t('translation', 'menu.region'), 'url' => ['/local/region/index']],
			    ['label' => Yii::t('translation', 'menu.city'), 'url' => ['/local/city/index']]
		]];

		$risklMenu = ['label' => Yii::t('translation', 'menu.risk_menu_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.risk'), 'url' => ['/risk/risk/index']],
			    ['label' => Yii::t('translation', 'menu.event'), 'url' => ['/risk/event/index']],
			    ['label' => Yii::t('translation', 'menu.eventtype'), 'url' => ['/risk/event-type/index']],
			    ['label' => Yii::t('translation', 'menu.event_risk_description'), 'url' => ['/risk/event-risk-description/index']],
			    ['label' => Yii::t('translation', 'menu.event_risk_instruction'), 'url' => ['/risk/event-risk-instruction/index']],
		]];

		$communicationMenu = ['label' => Yii::t('translation', 'menu.communication_menu_label'), 'items' => [
			    ['label' => Yii::t('translation', 'menu.group'), 'url' => ['/communication/group/index']],
			    ['label' => Yii::t('translation', 'menu.recipient'), 'url' => ['/communication/recipient/index']],
			    ['label' => Yii::t('translation', 'menu.trigger'), 'url' => ['/communication/trigger/index']],
			    ['label' => Yii::t('translation', 'menu.behavior'), 'url' => ['/communication/behavior/index']],
		]];

		$menuItems[] = ['label' => Yii::t('translation', 'menu.administration'), 'items' => [
			$generalConfigMenu,
			$operativeMenu,
			$localMenu,
			$risklMenu,
			$communicationMenu
		    ],
		];
	    }


	    $change = ['label' => Yii::t('translation', 'menu.change_password'), 'url' => ['/site/request-password-reset']];

	    $formLogout = Html::beginForm(['/site/logout'], 'post') . Html::submitButton(
			    Yii::t('translation', 'menu.logout'), ['class' => 'btn btn-link logout']
		    ) . Html::endForm();
	    $logout = Html::tag('li', $formLogout, []);


	    // Profile
	    $menuItems[] = ['label' => Yii::$app->user->identity->username, 'options' => ['class' => 'nav navbar-nav navbar-right'], 'items' => [
		    $languageMenu,
		    $change,
		    $logout],
	    ];


	    return $menuItems;
	}
    }

}
