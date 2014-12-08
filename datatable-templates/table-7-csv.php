<?php
	global $drac_LT7;

	$sets = array_keys( $drac_LT7 );
	$params = array_keys( $drac_LT7[$sets[0]] );

	echo 'Depth (m), ';
	foreach($sets as $set) {
		echo $set .',';
	}
	echo "\n";

	foreach( $params as $param ) {
		echo $param .',';
		foreach( $sets as $set ) {
			echo round( $drac_LT7[$set][$param], 3 ) .',';
		}
		echo "\n";
	}
