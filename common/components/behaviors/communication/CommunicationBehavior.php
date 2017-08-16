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

    /**
     * The object of webapp\modules\communication\models\Trigger will be injected
     * @var type 
     */
    public $trigger;

    /**
     * The object of webapp\modules\communication\models\Group will be injected
     * @var type 
     */
    public $groups;

    /**
     * The object of webapp\modules\communication\models\Workgroups will be injected automatically.
     * It is a list of workgroups
     * @var type 
     */
    public $workgroups;

    /**
     * The object of webapp\modules\communication\models\Behavior will be injected
     * @var type 
     */
    public $behavior;

    /**
     * 
     * @return type
     */
    public function events() {
	return [
	    ActiveRecord::EVENT_AFTER_INSERT => 'run',
	    ActiveRecord::EVENT_AFTER_UPDATE => 'run',
	];
    }

}
