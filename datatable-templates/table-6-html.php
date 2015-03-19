
<h3 id="table6">6) F, J and H parameters used for cosmic dose rate calculation</h3>
<p>
	From Prescott and Hutton, 1994, after Prescott and Stefan, 1982.
</p>

<table>
	<?php
		global $drac_LT6;

		$sets = array_keys( $drac_LT6 );
		$params = array_keys( $drac_LT6[$sets[0]] );

		echo '<thead>';
		echo '<tr>';
		echo '<th>Geomagnetic latitude (°)</th>';
		foreach($sets as $set) {
			echo '<th>' . $set .'</th>';
		}
		echo '</tr>';
		echo '</thead>';

		foreach( $params as $param ) {
			echo '<tr>';
			echo '<td>' . $param .'</td>';
			foreach( $sets as $set ) {
				echo '<td>' . round( $drac_LT6[$set][$param], 3 ) .'</td>';
			}
			echo '</tr>';
		}
	?>
</table>
<p><a href="?show=datatabledownload&amp;datatableid=6">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>
