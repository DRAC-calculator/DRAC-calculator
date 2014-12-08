<?php
	global $drac_LT6;

	$sets = array_keys( $drac_LT6 );
	$params = array_keys( $drac_LT6[$sets[0]] );

	echo 'Geomagnetic latitude (°), ';
	foreach($sets as $set) {
		echo $set .',';
	}
	echo "\n";

	foreach( $params as $param ) {
		echo $param .',';
		foreach( $sets as $set ) {
			echo round( $drac_LT6[$set][$param], 3 ) .',';
		}
		echo "\n";
	}
