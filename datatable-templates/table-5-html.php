
<h3 id="table5">5) Water Attenuation Factors</h3>
<p>
	From Aitken and Zie, 1990.
</p>

<table>
	<?php 
		global $drac_LT5;
		foreach($drac_LT5 as $key => $value) {
			echo '<tr>';
			echo '<th>' . $key .'</th>';
			echo '<td>' . $value .'</td>';
			echo '</tr>';
		}
	?>
</table>
<p><a href="?show=datatabledownload&amp;datatableid=5">Download CSV</a> <a href="#" style="float: right;">↑ Back to top</a></p>

