<?php 
	global $drac_LT2;
	$sets = array_keys( $drac_LT2 );
	$params = array_keys( $drac_LT2[$sets[0]] );
	$grains = array_keys( $drac_LT2[$sets[0]][$params[0]] );

	$names_pres = array( 
		'martinetal2014' => 'Martinetal2014',
		'brennanetal1991' => 'Brennanetal1991', 
		'bell1980' => 'Bell1980', 
	);

	echo ',';
	foreach($sets as $set) {
		foreach( $params as $param) {
			echo $names_pres[$set] . ',';
		}
	}
	echo "\n";

	echo 'Grain size (microns), ';
	foreach($sets as $set) {
		foreach( $params as $param) {
			echo str_replace('φ', 'phi', $param) .',';
		}
	}
	echo "\n";

	foreach( $grains as $grain ) {
		echo $grain .',';
		foreach($sets as $set) {
			foreach( $params as $param) {
				if (isset($grain,$drac_LT2[$set][$param][$grain])){
				 echo round( $drac_LT2[$set][$param][$grain], 3 ) .',';				 
				} else {
				 echo ' ,';
				}
			}	
		}
		echo "\n";
	}
	