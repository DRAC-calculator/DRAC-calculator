<?php require(DRAC_ROOT . '/main/html_helpers.php'); ?>
<?php require(DRAC_ROOT . '/calculator/lookup_tables.php'); ?>

<h1>DRAC &mdash; Data Tables</h1>

<?php echo drac_menu_html(); ?>

<p>
	A list of the different data sets available for use in DRAC:
</p>
<ol>
	<li>
        Radionuclide conversion factors:
        <a href="?show=datatables&amp;datatableid=1">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=1">Download CSV</a>
    </li>
	<li>
        Grain size attenuation factors for alpha dose rates:
        <a href="?show=datatables&amp;datatableid=2">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=2">Download CSV</a>
    </li>
	<li>
        Grain size attenuation factors for beta dose rates:
        <a href="?show=datatables&amp;datatableid=3">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=3">Download CSV</a>
    </li>
	<li>
        Etch depth attenuation factors:
        <a href="?show=datatables&amp;datatableid=4">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=4">Download CSV</a>
    </li>
	<li>
        Water content attenuation factors:
        <a href="?show=datatables&amp;datatableid=5">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=5">Download CSV</a>
    </li>
	<li>
        F, J and H parameters used for cosmic dose rate calculation:
        <a href="?show=datatables&amp;datatableid=6">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=6">Download CSV</a>
    </li>
    <li>
        Gamma dose scaling:
        <a href="?show=datatables&amp;datatableid=7">View</a>, 
        <a href="?show=datatabledownload&amp;datatableid=7">Download CSV</a>
    </li>
	
</ol>

<?php
    $datatableid = empty($_GET['datatableid']) ? 0 : intval( $_GET['datatableid'] );
    $datatableids = array( 1, 2, 3, 4, 5, 6, 7 );

    if( in_array( $datatableid, $datatableids ) ) {
        require_once(DRAC_ROOT . '/datatable-templates/table-' . $datatableid . '-html.php');
    } else {

    }
?>

<p>Full references for each of the datasets can be accessed via the <a href="<?php DRAC_URL ?>?show=references">References</a> page.</p>

<p>We invite authors who calculate new and/or updated datasets for dose rate calculation to submit their datasets for use in DRAC. If you are interested, please contact us.</p>

