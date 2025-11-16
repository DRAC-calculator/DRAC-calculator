<?php require(DRAC_ROOT . '/main/html_helpers.php'); ?>

<h1>DRAC &mdash; News</h1>

<?php echo drac_menu_html(); ?>

<h2>News</h2>

<p>A function for DRAC has been added to the R Luminescence package (version 0.6.0, release date 30/05/16; Kreutzer et al., 2016), where the ‘use_DRAC( )’ function provides an interface between the R package and DRAC and ‘template_DRAC( )’ creates a DRAC input template for use in ‘use_DRAC( )’. </p>

<p>Instructions for using this function in the R Luminescence package can be found here <a href="http://www.r-luminescence.de/tutorial/Using_DRAC_in_R.html">http://www.r-luminescence.de/tutorial/Using_DRAC_in_R.html</a>. Information on the Luminescence package can be found at <a href="http://www.r-luminescence.de/en/index_en.html">http://www.r-luminescence.de/en/index_en.html</a>.</p>

<h2>Updates</h2>

<h4>November 2025 - update to DRAC v 1.3</h4>

<p>Revisions to DRAC: </p>
<ul>
<li>Restriction on the largest grain size parameter possible (TI:32-33) changed from 1000 μm to 5000 μm</li>
<li>The conversion factors of Cresswell et al. (2018) have been added and are available for use. </li>
<li>The alpha grain size attenuation factors of Martin et al. (2014) have been added and are available for use.</li>
<li>The data tables page has been updated to include the data of Cresswell et al. (2018) and Martin et al. (2014)</li>
<li>Minor aesthetic modifications to the website have been made.  </li>
</ul>
<p>Revisions to the <a href="downloads/Supplementary_Information.xlsx">Supplementary Information</a></p>
<ul>
    <li>Updated contents page</li>
    <li>Addition of Cresswell et al and Martin et al datasets</li>
    <li>Extension of grain size attenuation datasets (alpha and beta)</li>
    <li>Updated worked examples for quartz and feldspar to incorporate new datasets (polymineral example remains the same as v1.2)</li>
    <li>DRAC input and output table updated</li>
    <li>References updated</li>
</ul>
<p>Version 1.2 of DRAC is still available at this <a href="../drac_v1_2">link</a>, but will be removed after 1st July 2026.</p>

<h4>August 2016 – update to DRAC v 1.2</h4>

<p>Revisions:</p>
<ul>
<li>The gamma scaling function was not operational in v1.1. This has been corrected and tested.</li>
<li>Restrictions on the input of cosmic dose rate parameters (TI:43-49) in the presence of user cosmic dose rate (TI:50-51) has been removed.</li>
<li>DRAC Input and Output templates are now available in .csv format.</li>
<li>Aesthetic modifications have been made to the DRAC input and output templates.</li>
</ul>



