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
