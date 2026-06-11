<?php
	$drac_LT5 = LookupTables::lt5();

	foreach($drac_LT5 as $key => $value) {
		echo $key .',';
		echo $value;
		echo "\n";
	}
	