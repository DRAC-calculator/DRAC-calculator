
<h3 id="table7">7) Gamma dose scaling factors</h3>
<p>
	From Aitken, 1985.
</p>

<table>
	<?php
		global $drac_LT7;

		$sets = array_keys( $drac_LT7 );
		$params = array_keys( $drac_LT7[$sets[0]] );

		echo '<thead>';
		echo '<tr>';
		echo '<th>Depth (m)</th>';
		foreach($sets as $set) {
			echo '<th>' . $set .'</th>';
		}
		echo '</tr>';
		echo '</thead>';

		foreach( $params as $param ) {
			echo '<tr>';
			echo '<td>' . $param .'</td>';
			foreach( $sets as $set ) {
				echo '<td>' . round( $drac_LT7[$set][$param], 3 ) .'</td>';
			}
			echo '</tr>';
		}
	?>
</table>
<p><a href="?show=datatabledownload&amp;datatableid=7">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>
