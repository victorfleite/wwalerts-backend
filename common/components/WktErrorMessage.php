<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

/**
 * Description of WktErrorMessage
 *
 * @author victor.leite
 */
class WktErrorMessage {

    public $reason;
    public $location;

    public function setReason($reason) {
	$this->reason = $reason;
    }

    public function setLocation($location) {
	$this->location = $location;
    }

}
