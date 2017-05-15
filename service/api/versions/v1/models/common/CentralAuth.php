<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\versions\v1\models\common;

use api\versions\v1\models\common\Config;

/**
 * Description of CentralAuth
 *
 * @author educatux
 */
class CentralAuth {
    /**
     * Validate if the autentication from central-api is iqual a local config.
     * @param type $serverid
     * @param type $masterkey
     * @return boolean
     */
    public static function validateAuthFromCentral($serverid, $masterkey){
        $config = Config::loadVars();
        if ($config->getVar("SERVERID") == $serverid && $config->getVar("MASTERKEY") == $masterkey){
            return true;
        }
        return false;
        
    }
    
}
