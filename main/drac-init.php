<?php

    // Enable to display php errors:
    // ini_set('display_errors', 1);
    // error_reporting(~0);

    define('DRAC_ROOT', dirname(__FILE__) . '/..' );
    define('DRAC_URL', '' );
    define('DRAC_VERSION', '1.1' );

    global $drac_calc;

    require_once(DRAC_ROOT . '/calculator/drac.php');

    $current = empty($_GET['show']) ? '' : $_GET['show'];
    if( $current == 'calculator' ) {

        $globals = array();
        $drac_data = (empty($_POST["drac_data"]) ? array() : $_POST["drac_data"]);
        $drac_calc = new Drac($globals, $drac_data);

        if( $drac_calc->valid() ) {
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $drac_calc->output_file_name);
            header("Pragma: no-cache");
            header("Expires: 0");
            $output = $drac_calc->run_calc();
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
            require_once(DRAC_ROOT . '/datatable-templates/table-' . $datatableid . '-csv.php');
            exit;
        }
    }
