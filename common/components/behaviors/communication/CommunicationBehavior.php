<?php

namespace common\components\behaviors\communication;

use yii\db\ActiveRecord;
use yii\base\Behavior;

/**
 * Description of CommunicationBehavior
 *
 * @author victor.leite
 */
class CommunicationBehavior extends Behavior {

    public $groups = [];
    public $workgroups = [];
    public $params = [];

    public function events() {
	return [
	    ActiveRecord::EVENT_AFTER_INSERT => 'run',
	    ActiveRecord::EVENT_AFTER_UPDATE => 'run',
	];
    }

}
