<?php

namespace common\models;

class Util {

    /**
     *  Convert Color Hexadecimal to Array of RGB
     * @param type $colour
     * @return boolean
     */
    public static function hex2rgb($colour) {
	if ($colour[0] == '#') {
	    $colour = substr($colour, 1);
	}
	if (strlen($colour) == 6) {
	    list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
	} elseif (strlen($colour) == 3) {
	    list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
	} else {
	    return false;
	}
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);
	return array('r' => $r, 'g' => $g, 'b' => $b);
    }

    /**
     * Convert Color Hexadecimal to RGB(A)
     * @param type $hex
     * @param type $opacity
     * @return string
     */
    public static function convertColorHexToRGB($hex, $opacity = null) {
	$ar = self::hex2rgb($hex);
	if (is_array($ar)) {
	    if (!$opacity) {
		return "rgb({$ar['r']},{$ar['g']},{$ar['b']})";
	    } else {
		return "rgba({$ar['r']},{$ar['g']},{$ar['b']},{$opacity})";
	    }
	} else {
	    return '';
	}
    }

}
