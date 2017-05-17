<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

use \yii\helpers\VarDumper;
/**
 * Description of Dumper
 *
 * @author victor.leite
 */
class Dumper extends \yii\base\Component {
   
    public function debug($obj, $stop = true){
        echo "<pre>";
        VarDumper::dump($obj);
        echo "</pre>";
        if($stop){
            die();
        }
    }
    
}
