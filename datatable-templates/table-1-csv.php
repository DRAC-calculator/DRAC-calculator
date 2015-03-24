<?php
	global $drac_LT1;
	$names = array_keys( $drac_LT1 );
	$names_pres = array(
		'liritzisetal2013' => 'Liritzisetal2013',
		'guerinetal2011' => 'Guerinetal2011',
		'adamiecaitken1998' => 'AdamiecAitken1998',
	);

	echo ',';
	foreach( $names as $name ) {
		echo  $names_pres[$name] .',';
	}
	echo "\n";

	foreach( array_keys( $drac_LT1[$names[0]] ) as $param ) {

		$ascii_conversions = array(
			'δUα' => 'Err Dalpha from 1 ppm U',
			'δThα' => 'Err Dalpha from 1 ppm Th',
			'δUβ' => 'Err Dbeta from 1 ppm U',
			'δThβ' => 'Err Dbeta from 1 ppm Th',
			'δKβ' => 'Err Dbeta from 1% K',
			'δRbβ' => 'Err Dbeta from 1 ppm Rb',
			'δUγ' => 'Err Dgamma from 1 ppm U',
			'δThγ' => 'Err Dgamma from 1 ppm Th',
			'δKγ' => 'Err Dgamma from 1% K',
			'Uα' => 'Dalpha from 1 ppm U',
			'Thα' => 'Dalpha from 1 ppm Th',
			'Uβ' => 'Dbeta from 1 ppm U',
			'Thβ' => 'Dbeta from 1 ppm Th',
			'Kβ' => 'Dbeta from 1% K',
			'Rbβ' => 'Dbeta from 1 ppm Rb',
			'Uγ' => 'Dgamma from 1 ppm U',
			'Thγ' => 'Dgamma from 1 ppm Th',
			'Kγ' => 'Dgamma from 1% K',
		);
		$ascii_param = $param;
		foreach( $ascii_conversions as $search => $replace ) {
			$ascii_param = str_replace($search, $replace, $ascii_param);
		}
		echo $ascii_param . ',';

		foreach($names as $name) {
			if( $param == "Rbβ" || $param == "δRbβ" ) {
				echo $drac_LT1[$name][$param] .',';
			} else if ( $param == "δUβ" || $param == "δUγ" || $param == "δThγ" ) {
				echo round( $drac_LT1[$name][$param], 4) .',';
			} else {
				echo round( $drac_LT1[$name][$param], 3) .',';
			}
		}
		echo "\n";
	}
