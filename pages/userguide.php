<?php require_once(DRAC_ROOT . '/main/html_helpers.php'); ?>
<?php require_once(DRAC_ROOT . '/calculator/inputs.php'); ?>
<?php require_once(DRAC_ROOT . '/calculator/outputs.php'); ?>

<h1>DRAC &mdash; User Guide</h1>

<?php echo drac_menu_html(); ?>

<p>DRAC has been designed to be straightforward to use and useful to the trapped charge dating community. Dose rate data is input into DRAC using a downloadable template and the output is generated in a .csv file, which can be downloaded and saved by the user. Details of the inputs required by DRAC and the outputs produced are given in the <a href="#drac_inputs">DRAC inputs</a> and <a href="#drac_outputs">DRAC outputs</a> tables below.</p>

<p>Details of the calculation process can be found in the accompanying journal article in Quaternary Geochronology. For those with access to this journal, it can be accessed at <a href="">[hyperlink]</a>. Alternatively, a copy of the accepted author manuscript is available <a href="#drac_downloads">here</a>.</p>

<p>In order to calculate a Ḋ using DRAC, simply:
<ol>
<li>Download the DRAC Input &amp; Output template file and input your data and factor selections into the appropriate columns, taking care to use the correct units and referring to the inputs table below to ensure correct data input. Whilst not all data input fields are required for Ḋ calculation, each column should be populated including those not being used. </li>
<li>Copy and paste your data from the template directly into the data input box on the <a href="<?php echo DRAC_URL ?>?show=calculator">Calculator</a> page. You can calculate Ḋ for up to 100 samples at a time. You should also provide a name for the suite of calculations.</li>
<li>Press calculate.</li>
<li>A DRACoutput.csv file will be produced (see example version, which can be downloaded). This file will contain all of the input data and table outputs listed below.</li>
</ol>
</p>

<p>Please ensure you cite the use of DRAC in your work, published or otherwise. Please cite the website name and version (e.g. DRAC v<?php echo DRAC_VERSION ?>) and the accompanying journal article: Durcan, J.A., King, G.E., Duller, G.A.T., 2015. DRAC: Dose rate and age calculation for trapped charge dating. Quaternary Geochronology, submitted. [at present a download to the submitted document].</p>

<h3 id="drac_downloads">Downloads</h3>
<ul>
	<li><a href="<?php echo DRAC_URL ?>downloads/DRAC_Input_and_Output_Template.xlsx">DRAC Input &amp; Output template</a></li>
	<li><a href="<?php echo DRAC_URL ?>downloads/Supplementary_Information.xlsx">Supplementary Information</a></li>
	<!-- <li><a href="<?php echo DRAC_URL ?>downloads/XXX">XXX</a></li> -->
	<li>Durcan et al., Submitted</li>
</ul>

<h3 id="drac_inputs">DRAC Inputs</h3>

<table class="drac_values_table">
	<tr>
		<th>Table Input</th>
		<th>Name</th>
		<th>Required</th>
		<th style="width: 50%;">Description</th>
	</tr>
	<?php
		$inputs = drac_inputs();
		$keys = array_keys( $inputs );
		$desc_rowspan_count = 1;
		for($i=0; $i < count($inputs); $i++) {
			$key = $keys[$i];
			$input = $inputs[$key];
			echo '<tr>';
			echo '<td>' . $key .'</td>';
			echo '<td>' . drac_format_table_html( $input['name'] ) .'</td>';
			echo '<td>' . ($input['required'] ? "Y" : "N") .'</td>';
			if( $desc_rowspan_count > 1 ){
				$desc_rowspan_count--;
			} else {
				while( ($i + $desc_rowspan_count < count($inputs)) && ($inputs[$keys[$i + $desc_rowspan_count]]['description'] == $input['description'] )) {
					$desc_rowspan_count++;
				}
				if( $desc_rowspan_count > 1 ) {
					echo '<td rowspan="' . $desc_rowspan_count . '">' . drac_format_table_html( $input['description'] ) .'</td>';
				} else {
					echo '<td>' . drac_format_table_html( $input['description'] ) .'</td>';
				}
			}
			echo '</tr>';
		}
	?>
</table>

<h3 id="drac_outputs">DRAC Outputs</h3>

<table class="drac_values_table">
	<tr>
		<th>Table Output</th>
		<th>Name</th>
		<th style="width: 50%;">Description</th>
	</tr>
	<?php
		$outputs = drac_outputs();
		$keys = array_keys( $outputs );
		$desc_rowspan_count = 1;
		for($i=0; $i < count($outputs); $i++) {
			$key = $keys[$i];
			$output = $outputs[$key];
			echo '<tr>';
			echo '<td>' . $key .'</td>';
			echo '<td>' . drac_format_table_html( $output['name'] ) .'</td>';
			if( $desc_rowspan_count > 1 ){
				$desc_rowspan_count--;
			} else {
				while( ($i + $desc_rowspan_count < count($outputs)) && ($outputs[$keys[$i + $desc_rowspan_count]]['description'] == $output['description'] )) {
					$desc_rowspan_count++;
				}
				if( $desc_rowspan_count > 1 ) {
					echo '<td rowspan="' . $desc_rowspan_count . '">' . $output['description'] .'</td>';
				} else {
					echo '<td>' . $output['description'] .'</td>';
				}
			}
			echo '</tr>';
		}
	?>
</table>
