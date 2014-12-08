
<h3 id="table4">4) Table4</h3>
<table>
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
	
		foreach($sets as $set) {
			echo '<thead>';
			echo '<tr>';
			echo '<th colspan="9">' . $names_pres[$set] .'</th>';
			echo '</tr>';

			echo '<tr>';
			echo '<td>Etch depth (μm)</td>';
			foreach( array_keys( $drac_LT4[$set] ) as $param ) {
				echo '<td>' . $param .'</td>';
			}
			echo '</tr>';
			echo '</thead>';

			foreach( $etchs as $etch ) {
				echo '<tr>';
				echo '<td>' . $etch .'</td>';
				foreach( array_keys( $drac_LT4[$set] )  as $param) {
					echo '<td>' . round( $drac_LT4[$set][$param][$etch], 3 ) .'</td>';
				}
				echo '</tr>';
			}
		}
	?>
</table>
<p><a href="?show=datatabledownload&amp;datatableid=4">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>
