<?php require(DRAC_ROOT . '/main/html_helpers.php'); ?>

<h1>DRAC &mdash; Calculator</h1>

<?php echo drac_menu_html(); ?>

<p>DRAC will calculate dose rates for up to 100 samples at a time. Users should copy and paste data from their DRAC template file into the data box below and press calculate. </p>

<p>DRAC will return an error if fields are not correctly populated. If an error message is returned, please double-check your data input and refer to the <a href="<?php echo DRAC_URL ?>?show=userguide">user guide</a>.</p>

<?php require(DRAC_ROOT . '/main/form.php'); ?>

<p>DRAC v<?php echo DRAC_VERSION; ?></p> Release date: March 2015
<p>DRAC source code is available at <a href="https://github.com/DRAC-calculator/DRAC-calculator">DRAC-calculator</a></p>

<p>
	Disclaimer: DRAC has been checked and tested extensively to ensure a mathematically correct Ḋ calculation. With the information contained on this website, in the accompanying journal article and in the open access source code, it is intended that the calculation process is clear and transparent. It is the responsibility of the user to ensure that they are satisfied with this calculation process and that their data input is accurate. A significant amount of time, care and attention has been dedicated to the construction of DRAC, however we as authors are not responsible for miscalculation as a result of the use of this calculator.
</p>
