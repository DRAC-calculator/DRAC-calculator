<?php

    // Enable to display php errors:
    // ini_set('display_errors', 1);
    // error_reporting(~0);

    define('DRAC_ROOT', dirname(__FILE__) . '/..' );
    define('DRAC_URL', '' );
    define('DRAC_VERSION', '1.1' );
    define('DRAC_DB_PATH', DRAC_ROOT . '/../sqlite/' );
    define('DRAC_DB_FILE', 'db.sqlite3' );

    try {
        global $drac_calc;
        global $drac_db;


        // Connect to the sqlite3 database

        $db_path = DRAC_DB_PATH;
        $db_file =  $db_path . DRAC_DB_FILE;

        // Create the database file if it doesn't exist
        if (!file_exists($db_path)) { mkdir($db_path); }
        if (!file_exists($db_file)) { touch($db_file); }

        $drac_db = new PDO('sqlite:' . $db_file);
        $drac_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $drac_db->exec("CREATE TABLE IF NOT EXISTS submissions (
            id INTEGER PRIMARY KEY, 
            name VARCHAR(255),
            submitted_at DATETIME, 
            ip_address VARCHAR(255), 
            drac_version VARCHAR(255), 
            input TEXT, 
            output TEXT
        )");

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        require_once(DRAC_ROOT . '/calculator/drac.php');

        $current = empty($_GET['show']) ? '' : $_GET['show'];
        if( $current == 'calculator' ) {

            $globals = array();
            $drac_data = (empty($_POST["drac_data"]) ? array() : $_POST["drac_data"]);
            $drac_calc = new Drac($globals, $drac_data);

            if( !empty( $drac_calc->values['table'] ) ) {
                $query = $drac_db->prepare("
                    INSERT INTO submissions (name, submitted_at, ip_address, drac_version, input) 
                    VALUES (?, datetime('now'), ?, ?, ?)
                ");
                $query->execute( array( 
                    $drac_calc->values['name'], 
                    $ip, 
                    DRAC_VERSION,
                    $drac_calc->values['table'] 
                ) );
                $db_submission_id = $drac_db->lastInsertId(); 
            }

            if( $drac_calc->valid() ) {
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename=" . $drac_calc->output_file_name);
                header("Pragma: no-cache");
                header("Expires: 0");
                $output = $drac_calc->run_calc();        

                $query = $drac_db->prepare("UPDATE submissions SET output=? WHERE id=?");
                $query->execute( array($output, $db_submission_id) );

                echo $output;

                $drac_db = null;
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

                $drac_db = null;
                exit;
            }
        } elseif( $current == 'viewdb' ) {

            $stmt = $drac_db->prepare("SELECT * FROM submissions");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print_r( $rows );

            $drac_db = null;
            exit;
        }

        $drac_db = null;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
