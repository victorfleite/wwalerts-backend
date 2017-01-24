<?php

namespace common\models;

class Util {
   
    static function getDiaDaSemana($num){
        
        switch ($num){
            case 0:
                return 'Dom';
            break;
            case 1:
                return 'Seg';
            break;
            case 2:
                return 'Ter';
            break;
            case 3:
                return 'Qua';
            break;
            case 4:
                return 'Qui';
            break;
            case 5:
                return 'Sex';
            break;
            case 6:
                return 'Sáb';
            break;
        }
        return null;
        
    }
    static function generateHashSha256(){
        $token = md5(uniqid(""));
        return hash('sha256', $token.date('dmY'));        
    }
}
