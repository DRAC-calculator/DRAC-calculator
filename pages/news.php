<?php require(DRAC_ROOT . '/main/html_helpers.php'); ?>

<h1>DRAC &mdash; News</h1>

<?php echo drac_menu_html(); ?>

<h2>News</h2>

<p>A function for DRAC has been added to the R Luminescence package (version 0.6.0, release date 30/05/16; Kreutzer et al., 2016), where the ‘use_DRAC( )’ function provides an interface between the R package and DRAC and ‘template_DRAC( )’ creates a DRAC input template for use in ‘use_DRAC( )’. </p>

<p>Instructions for using this function in the R Luminescence package can be found here <a href="http://www.r-luminescence.de/tutorial/Using_DRAC_in_R.html">http://www.r-luminescence.de/tutorial/Using_DRAC_in_R.html</a>. Information on the Luminescence package can be found at <a href="http://www.r-luminescence.de/en/index_en.html">http://www.r-luminescence.de/en/index_en.html</a>.</p>

<h2>Updates</h2>

<h4>August 2016 – update to DRAC v 1.2</h4>

<p>Revisions:</p>
<ul>
<li>The gamma scaling function was not operational in v1.1. This has been corrected and tested.</li>
<li>Restrictions on the input of cosmic dose rate parameters (TI:43-49) in the presence of user cosmic dose rate (TI:50-51) has been removed.</li>
<li>DRAC Input and Output templates are now available in .csv format.</li>
<li>Aesthetic modifications have been made to the DRAC input and output templates.</li>
</ul>
