<?php

namespace common\components\behaviors\communication\custom;

use common\components\behaviors\communication\CommunicationBehavior;
use common\components\behaviors\communication\iCommunicationBehavior;

/**
 * Description of EmailBehavior
 *
 * @author victor.leite
 */
class EmailBehavior extends CommunicationBehavior implements iCommunicationBehavior {

    public function run($event) {
	//TODO Implement here the code. Use Job queue, if possible.	
    }

}
