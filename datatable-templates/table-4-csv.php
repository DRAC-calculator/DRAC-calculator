<?php
	global $drac_LT4;
	$sets = array_keys( $drac_LT4 );
	$params = array_keys( $drac_LT4[$sets[0]] );
	$etchs = array_keys( $drac_LT4[$sets[0]][$params[0]] );

	$names_pres = array( 
		"bell1979" => "Bell1979 Beta",
		"brennan2003" => "Brennan2003 Beta",
		"bell1980alpha" => "Bell1980 Alpha",
	);

	echo ',';
	foreach($sets as $set) {
		for( $i = 0; $i < count( array_keys( $drac_LT4[$set] ) ) ;  $i++ ) {
			echo $names_pres[$set] .',';
		}
	}
	echo "\n";

	echo 'Etch depth (microns), ';
	foreach($sets as $set) {
		foreach( array_keys( $drac_LT4[$set] ) as $param ) {
			echo str_replace('φ','phi2e', $param) .',';
		}
	}
	echo "\n";

	foreach( $etchs as $etch ) {
		echo $etch .',';
		foreach($sets as $set) {
			foreach( array_keys( $drac_LT4[$set] )  as $param) {
				echo round( $drac_LT4[$set][$param][$etch], 3 ) .',';
			}
		}
		echo "\n";
	}
