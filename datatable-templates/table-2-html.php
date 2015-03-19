<h3 id="table2">2) Grain size attenuation factors - alpha</h3>
<table>
	<?php
		global $drac_LT2;
		$sets = array_keys( $drac_LT2 );
		$params = array_keys( $drac_LT2[$sets[0]] );
		$grains = array_keys( $drac_LT2[$sets[0]][$params[0]] );

		$names_pres = array(
			'brennanetal1991' => 'Brennanetal1991',
			'bell1980' => 'Bell1980',
		);

		foreach($sets as $set) {
			echo '<thead>';
			echo '<tr>';
			echo '<th colspan="7">' . $names_pres[$set] .'</th>';
			echo '</tr>';

			echo '<tr>';
			echo '<td>Grain size (μm)</td>';
			foreach( $params as $param) {
				echo '<td>' . $param .'</td>';
			}
			echo '</tr>';
			echo '</thead>';

			foreach( $grains as $grain ) {
				echo '<tr>';
				echo '<td>' . $grain .'</td>';
				foreach( $params as $param) {
					echo '<td>' . round( $drac_LT2[$set][$param][$grain], 3 ) .'</td>';
				}
				echo '</tr>';
			}
		}
	?>
</table>
<p><a href="?show=datatabledownload&amp;datatableid=2">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>
