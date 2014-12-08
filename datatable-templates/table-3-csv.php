<?php 
	global $drac_LT3;
	$sets = array_keys( $drac_LT3 );
	$params = array_keys( $drac_LT3[$sets[0]] );
	$grains = array_keys( $drac_LT3[$sets[0]][$params[0]] );

	$names_pres = array( 
		"mejdahl1979" => "Mejdahl1979",
		"brennan2003" => "Brennan2003",
		"guerinetal2012-q" => "GuerinEtAl2012-Q",
		"guerinetal2012-f" => "GuerinEtAl2012-F",
		"readhead2002" => "Readhead2002",
	);

	echo ',';
	foreach($sets as $set) {
		for( $i = 0; $i < count( array_keys( $drac_LT3[$set] ) ) ;  $i++ ) {
			echo $names_pres[$set] .',';
		}
	}
	echo "\n";

	echo 'Grain size (microns), ';
	foreach($sets as $set) {
		foreach( array_keys( $drac_LT3[$set] ) as $param ) {
			echo str_replace('φ', 'phi', $param) .',';
		}
	}
	echo "\n";

	foreach( $grains as $grain ) {
		echo $grain .',';
		foreach($sets as $set) {
			foreach( array_keys( $drac_LT3[$set] )  as $param) {
				echo round( $drac_LT3[$set][$param][$grain], 3 ) .',';
			}
		}
		echo "\n";
	}
