<h3 id="table1">1) Conversion factors</h3>

<p>
	The alpha, beta and gamma dose (Gy.ka<sup>-1</sup>) produced per unit of the parent radionuclide: for 1 ppm Th, 1 ppm U, 1 ppm Rb and 1% K.
</p>
<p>
	DRAC accepts radionuclide concentrations in ppm (U, Th, Rb) and % (K) only. Concentrations in other units, such as Bq.kg<sup>-1</sup>, should be converted to ppm/% prior to using DRAC.
</p>

<table>
	<?php 
		global $drac_LT1;
		$names = array_keys( $drac_LT1 );

		$names_pres = array( 
			'liritzisetal2013' => 'Liritzisetal2013', 
			'guerinetal2011' => 'Guerinetal2011', 
			'adamiecaitken1998' => 'AdamiecAitken1998',
		);

		echo '<thead>';
		echo '<tr>';
		echo '<th></th>';
		foreach( $names as $name ) {
			echo '<th>' . $names_pres[$name] .'</th>';
		}
		echo '</tr>';
		echo '</thead>';
		foreach( array_keys( $drac_LT1[$names[0]] ) as $param ) {
			echo '<tr>';
			echo '<td>' . $param .'</td>';
			foreach($names as $name) {
				echo '<td>';
				if( $param == "Rbβ" || $param == "δRbβ" ) {
					echo $drac_LT1[$name][$param];
				} else {
					echo round( $drac_LT1[$name][$param], 3);
				}
				echo '</td>';
			}
			echo '</tr>';
		}
	?>
</table>

<p><a href="?show=datatabledownload&amp;datatableid=1">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>
