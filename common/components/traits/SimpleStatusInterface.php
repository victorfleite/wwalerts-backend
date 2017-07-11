<?php

/**
 * SimpleStatusInterface
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

interface  SimpleStatusInterface{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public static function getStatusLabel($status);
    public static function getStatusCombo();

}
