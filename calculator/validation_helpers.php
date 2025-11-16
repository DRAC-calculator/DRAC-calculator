<?php

function within_range($start, $end, $val) {
	// if( empty($val) ) {
	// 	return true;
	// }
	$float = floatval($val);
	if( strval($float) != $val ) {
		return false;
	}
	if( $float < $start || $float > $end ) {
		return false;
	}
	return true;
}

function greater_than($start, $val) {
	$float = floatval($val);
	if( strval($float) != $val ) {
		return false;
	}
	if( $float <= $start ) {
		return false;
	}
	return true;
}

function greater_or_equal_to($start, $val) {
	$float = floatval($val);
	if( strval($float) != $val ) {
		return false;
	}
	if( $float < $start ) {
		return false;
	}
	return true;
}

function less_than($start, $val) {
	$float = floatval($val);
	if( strval($float) != $val ) {
		return false;
	}
	if( $float >= $start ) {
		return false;
	}
	return true;
}

function valid_blank_input($input_properties, $value) {
    $required = $input_properties['required'];
    if( !$required && valid_blank($value) ) {
        return true;
    }
    return false;
}

function valid_blank($value) {
		return strcmp($value, 'X') == 0;
}

function alpha_attenuation_value_present($set, $grain){
    global $drac_LT2;
    $set = strtolower( $set );
    $grain = intval($grain);
	$name = 'Uranium 1-φ(D)';
	if (isset($grain,$drac_LT2[$set][$name][$grain])){
		return true;
	} else {
		return false;
	}
}

function beta_attenuation_value_present($set, $grain){
    global $drac_LT3;
    $set = strtolower( $set );
	$name = 'U 1-φ(D)';
    $grain = intval($grain);
	if (isset($grain,$drac_LT3[$set][$name][$grain])){
		return true;
	} else {
		return false;
	}
}