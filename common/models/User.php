<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of User
 *
 * @author educatux
 */
class User extends \dektrium\user\models\User {
    
    // Implement update of data from api-central
    public function login($user, $remember)
    {
        echo parent::login($user, $remember);
        
        die('to aqui uai');
        $params = array(
            "serverid" => $server->serverid,           
        );
        $response = \Httpful\Request::post($uri . Constantes::API_ESCOLA_USER_DATA_AND_AUTENTICATE_SERVICE)
                ->addHeaders(array(
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ))->body(Json::encode($params))
                ->send();
      
        
        
    }
}
