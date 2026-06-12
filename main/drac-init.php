<?php

    // Enable to display php errors:
    // ini_set('display_errors', 1);
    // error_reporting(~0);

    define('DRAC_URL', '' );

    global $drac_form;

    require_once __DIR__ . '/drac_form.php';

    $current = empty($_GET['show']) ? '' : $_GET['show'];
    if( $current == 'calculator' ) {

        $drac_data = (empty($_POST["drac_data"]) ? array() : $_POST["drac_data"]);
        $drac_form = new DracForm($drac_data);

        if( $drac_form->valid() ) {
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $drac_form->outputFileName());
            header("Pragma: no-cache");
            header("Expires: 0");
            $output = $drac_form->toCsv();
            echo $output;
            exit;
        }

    } elseif( $current == 'datatabledownload' ) {

        $datatableid = empty($_GET['datatableid']) ? 0 : intval( $_GET['datatableid'] );
        $datatableids = array( 1, 2, 3, 4, 5, 6, 7 );

        if( in_array( $datatableid, $datatableids ) ) {
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=datatable-" .  $datatableid . ".csv" );
            header("Pragma: no-cache");
            header("Expires: 0");
            require_once __DIR__ . '/../datatable-templates/table-' . $datatableid . '-csv.php';
            exit;
        }
    }
