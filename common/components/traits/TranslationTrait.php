<?php

/**
 * TranslationTrait
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

use \yii\helpers\ArrayHelper;

trait TranslationTrait {

    /**
     * Return combo array translated
     * @param type $key
     * @param type $value
     * @return type
     */
    public static function getTranslatedComboArray($key, $value) {
	$list = self::find()->orderBy($value)->all();	
	$r = [];
	if (count($list) > 0) {
	    foreach ($list as $item) {
		$r[$item->{$key}] = \Yii::t('translation', $item->{$value});
	    }
	}
	return $r;
    }

}
