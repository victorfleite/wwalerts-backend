<?php

/**
 * SimpleStatusTrait
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

use \yii\helpers\StringHelper;

trait SimpleStatusTrait {
     
    public static function getStatusLabel($p) {
	$className = strtolower(StringHelper::basename(get_called_class()));
	switch ($p) {
	    case self::STATUS_ACTIVE:
		return \Yii::t('translation', "$className.status_active");
	    case self::STATUS_INACTIVE:
		return \Yii::t('translation', "$className.status_inactive");
	    default:
		break;
	}
    }

    public static function getStatusCombo() {
	$className = strtolower(StringHelper::basename(get_called_class()));
	return [
	    self::STATUS_ACTIVE => \Yii::t('translation', "$className.status_active"),
	    self::STATUS_INACTIVE => \Yii::t('translation', "$className.status_inactive"),
	];
    }


}
