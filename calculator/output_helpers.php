<?php
require(DRAC_ROOT . '/calculator/lookup_tables.php');

function LT1($set, $param) {
    global $drac_LT1;
    $set = strtolower( $set );
    return $drac_LT1[$set][$param];
}

function LT2($set, $name, $grain) {
    global $drac_LT2;
    $set = strtolower( $set );
    $grain = intval($grain);
    return $drac_LT2[$set][$name][$grain];
}

function LT3($set, $name, $grain) {
    global $drac_LT3;
    $set = strtolower( $set );
    $grain = intval($grain);
    return $drac_LT3[$set][$name][$grain];
}

function LT4($set, $name, $depth) {
    global $drac_LT4;
    $set = strtolower( $set );
    $depth = intval($depth);
    return $drac_LT4[$set][$name][$depth];
}

function LT5($name) {
    global $drac_LT5;
    return $drac_LT5[$name];
}

function LT6($name, $value) {
    global $drac_LT6;
    return $drac_LT6[$name][$value];
}

function LT7($name, $value) {
    global $drac_LT7;
    return $drac_LT7[$name][$value];
}

function lt1_convert($inputs, $param, $a) {
    $result = $inputs[$a] * LT1( $inputs['TI:4'], $param );
    return $result;
}
function lt1_convert_d($inputs, $param, $a, $b, $scale=null) {
    $u = LT1( $inputs['TI:4'], $param );
    $du = LT1( $inputs['TI:4'], 'δ' . $param );

    if( $scale == null ){
      $scale = lt1_convert($inputs, $param, $a);
      if ( $scale == 0 ) {
          return 0;
      }
    }
    $result = $scale * sqrt( pow( $du / $u, 2 ) + pow( $inputs[$b] / $inputs[$a], 2 ) );
    return $result;
}

function lt2_factor($inputs, $type) {
    return ( LT2( $inputs['TI:34'], $type, $inputs['TI:32'] ) + LT2( $inputs['TI:34'], $type, $inputs['TI:33'] ) ) / 2.0;
}
function lt3_factor($inputs, $type, $set=null ) {
    if( $set == null ) { $set = $inputs['TI:35']; };
    return ( LT3( $set, $type, $inputs['TI:32'] ) + LT3( $set, $type, $inputs['TI:33'] ) ) / 2.0;
}
function lt4_factor($inputs, $type, $set=null ) {
    if( $set == null ) { $set = $inputs['TI:38']; };
    return ( LT4( $set, $type, $inputs['TI:36'] ) + LT4( $set, $type, $inputs['TI:37'] ) ) / 2.0;
}

function lt2_factor_d($inputs, $type) {
    return abs( LT2( $inputs['TI:34'], $type, $inputs['TI:32'] ) - LT2( $inputs['TI:34'], $type, $inputs['TI:33'] ) ) * 0.5;
}
function lt3_factor_d($inputs, $type, $set=null ) {
    if( $set == null ) { $set = $inputs['TI:35']; };
    return abs( LT3( $set, $type, $inputs['TI:32'] ) - LT3( $set, $type, $inputs['TI:33'] ) ) * 0.5;
}
function lt4_factor_d($inputs, $type, $set=null ) {
    if( $set == null ) { $set = $inputs['TI:38']; };
    return abs( LT4( $set, $type, $inputs['TI:36'] ) - LT4( $set, $type, $inputs['TI:37'] ) ) * 0.5;
}

function lt7_factor($inputs, $type) {
    if( ( strtoupper( $inputs['TI:13'] ) == 'N' ) || ( VALUE( $inputs, 'TI:43' ) > 0.3 ) ) {
        return 1;
    } else {
        $d = round( VALUE( $inputs, 'TI:43' ) * 2, 3) / 2 ;
        $d = str_pad( $d, 5, '0' );
        return LT7( $type, $d );
    }
}

function sqrt_sum_sqrs() {
    $items = func_get_args();
    $items = array_map( function($item) { return pow( $item, 2 ); }, $items );
    return sqrt( array_sum( $items ) );
}
function factor_sqrt_sum_sqr_ratio( $inputs, $a, $b, $c, $d, $e ) {
    if( VALUE( $inputs, $a ) == 0 ) {
        return 0;
    } else {
        $arg1 = ( VALUE( $inputs, $c ) == 0 ? 0 : VALUE( $inputs, $b ) / VALUE( $inputs, $c ) );
        $arg2 = ( VALUE( $inputs, $e ) == 0 ? 0 : VALUE( $inputs, $d ) / VALUE( $inputs, $e ) );
        return VALUE( $inputs, $a ) * sqrt_sum_sqrs( $arg1, $arg2 );
    }
}

global $drac_values_cache;

function drac_clear_value_cache() {
    global $drac_values_cache;
    $drac_values_cache = array();
}
drac_clear_value_cache();

function VALUE( $inputs, $item ) {
    global $drac_values_cache;
    if( !array_key_exists( $item, $drac_values_cache ) ) {
        $is_output = (strpos( $item, 'TI:', 0 ) === false);
        if( $is_output ) {
            $drac_outputs = drac_outputs();
            $f = $drac_outputs[$item]['value'];
            $value = $f( $inputs );
        } else {
            $value = $inputs[$item];
        }
        $drac_values_cache[$item] = $value;
    }
    return $drac_values_cache[$item];
}

function VALUES() {
    $items = func_get_args();
    $inputs = array_shift( $items );
    return array_map( function($item) use (&$inputs) { return VALUE( $inputs, $item ); }, $items );
}
