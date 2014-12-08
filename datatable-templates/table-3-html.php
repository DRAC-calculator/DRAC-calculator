
<h3 id="table3">3) Grain size attenuation beta</h3>
<table>
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
	
		foreach($sets as $set) {
			echo '<thead>';
			echo '<tr>';
			echo '<th colspan="9">' . $names_pres[$set] .'</th>';
			echo '</tr>';

			echo '<tr>';
			echo '<td>Grain size (μm)</td>';
			foreach( array_keys( $drac_LT3[$set] ) as $param ) {
				echo '<td>' . $param .'</td>';
			}
			echo '</tr>';
			echo '</thead>';

			foreach( $grains as $grain ) {
				echo '<tr>';
				echo '<td>' . $grain .'</td>';
				foreach( array_keys( $drac_LT3[$set] )  as $param) {
					echo '<td>' . round( $drac_LT3[$set][$param][$grain], 3 ) .'</td>';
				}
				echo '</tr>';
			}
		}
	?>
</table>
<p><a href="?show=datatabledownload&amp;datatableid=3">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>
