<?php
// run:   phpunit test/drac_test.php

define('DRAC_ROOT', dirname(__FILE__) . '/..' );
define('DRAC_VERSION', 'XXX' );
require(DRAC_ROOT . '/calculator/drac.php');

class DracTest extends PHPUnit_Framework_TestCase
{
    function initDrac($params = array()) {
        $defaults = array(
          'name' => 'hello',
          'table' => 'TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62',
        );
        $globals = array(
        );
        return new Drac($globals, array_merge($defaults, $params));
    }

    public function testValid() {
        $calc = $this->initDrac();
        $this->assertEquals($calc->valid(), true);
        $this->assertEquals($calc->errors(), false);
    }
    public function testNotValid() {
        $calc = $this->initDrac(array('table' => ''));
        $this->assertEquals($calc->valid(), false);
        $this->assertEquals($calc->errors(), true);
    }
    public function testNotSubmitted() {
        $calc =  new Drac(array(), array());
        $this->assertEquals($calc->valid(), false);
        $this->assertEquals($calc->errors(), false);
    }

    public function testFieldNameValuesValid() {
        $calc = $this->initDrac();
        $this->assertEquals($calc->fieldValid('name'), true);
    }
    public function testFieldNameValuesInvalid() {
        $calc = $this->initDrac(array('name' => ''));
        $this->assertEquals($calc->fieldValid('name'), false);
    }

    public function testFieldTableValuesBlank() {
        $calc = $this->initDrac(array('table' => ''));
        $this->assertEquals($calc->fieldValid('table'), false);
    }
    public function testFieldTableValuesBadData() {
        $calc = $this->initDrac(array('table' => "hello"));
        $this->assertEquals($calc->fieldValid('table'), false);
    }
    public function testFieldTableValuesValid() {
        $calc = $this->initDrac();
        $this->assertEquals($calc->fieldValid('table'), true);
    }
    public function testFieldTableMultipleRows() {
        $calc = $this->initDrac(array('table' => "TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62\nTestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62"));
        $this->assertEquals($calc->fieldValid('table'), true);
    }
    public function testFieldTableMultipleSpacesAndTabs() {
       $calc = $this->initDrac(array('table' => "   TestProject    Aber/136-3-1 Q     AdamiecAitken1998\t3.393  \t 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62"));
        $this->assertEquals($calc->fieldValid('table'), true);
    }

    public function testTI3() {
        $calc = $this->initDrac(array('table' => "TestProject Aber/136-3-1 A AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62\nTestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62"));
        $this->assertEquals($calc->fieldValid('table'), false);
    }
    public function testTI4() {
        $calc = $this->initDrac(array('table' => "TestProject Aber/136-3-1 Q A 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62\nTestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62"));
        $this->assertEquals($calc->fieldValid('table'), false);
    }
    public function testTI5() {
        $calc = $this->initDrac(array('table' => "TestProject Aber/136-3-1 Q AdamiecAitken1998 -1 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62\nTestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62"));
        $this->assertEquals($calc->fieldValid('table'), false);
    }

    public function testRunCalc_Quartz() {
        $input = "DRAC-example Quartz Q AdamiecAitken1998 3.4 0.51 14.47 1.69 1.2 0.14 0 0 N 0 0 0 0 0 0 0 0 N 0 0 0 0 0 0 0 0 N 90 125 Brennanetal1991 Guerinetal2012-Q 8 10 Bell1979 0 0 5 2 2.2 0.22 1.8 0.1 30 70 150 X X 20 0.2";
        $expected = "DRAC-example,Quartz,Q,0,0,1.539,0.127,1.291,0.103,0,0,0,0,0.154,0.015,2.984,0.164,0,0,2.984,0.164,20,0.2,6.702,0.374,,,DRAC-example,Quartz,Q,AdamiecAitken1998,3.4,0.51,14.47,1.69,1.2,0.14,0,0,N,0,0,0,0,0,0,0,0,N,0,0,0,0,0,0,0,0,N,90,125,Brennanetal1991,Guerinetal2012-Q,8,10,Bell1979,0,0,5,2,2.2,0.22,1.8,0.1,30,70,150,0,0,20,0.2,,,9.452,1.418,0.496,0.074,0.384,0.058,10.592,1.238,0.395,0.048,0.689,0.08,0.938,0.11,0.292,0.034,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,0.384,0.058,0.689,0.08,0.292,0.034,1.365,0.105,20.044,1.882,1.83,0.141,1.365,0.105,0,0,0,0,0.145,0.016,0.172,0.028,0.159,0.022,0.855,0.016,0.828,0.028,1.367,0.253,1.82,0.363,0,0,0,0,0,0,0.901,0.009,0.861,0.013,0.96,0.007,0.494,0.049,0.919,0.009,0.099,0.009,0.139,0.013,0.04,0.007,0.506,0.049,0.447,0.067,0.34,0.042,0.901,0.106,0,0,0,0,0,0,0,0,0,0,0,0,0.35,0.05,0.434,0.047,0.391,0.049,1.178,0.014,1.186,0.016,0.478,0.112,0.79,0.179,0,0,0,0,0,0,0.939,0.004,0.922,0.007,1,0,0.963,0.003,1.496,0.037,1.322,0.034,1,0,0.42,0.063,0.313,0.038,0.901,0.106,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1.635,0.129,1.365,0.105,0,0,1.539,0.127,1.291,0.103,0,0,0,0,0.16,0.018,20.905,0.345,4.29,0.6,0.154,0.015,2.984,0.164,0,0,2.984,0.164,6.702,0.374,";
        $this->assertOutputRow( $expected, $input );
    }

    public function testRunCalc_Feldspar() {
        $input = "DRAC-example Feldspar F AdamiecAitken1998 2 0.2 8 0.4 1.75 0.05 0.00 0.00 Y X X X X 12.50 0.50 X X N X X X X X X X X Y 180.00 212.00 Bell1980 Mejdahl1979 0.00 0.00 Bell1979 0.15 0.050 10.00 3.00 0.15 0.015 1.80 0.10 60.00 100.00 200.00 X X 15.00 1.50";
        $expected = "DRAC-example,Feldspar,F,0.179,0.045,1.516,0.066,0.926,0.041,0,0,0.673,0.061,0.26,0.026,2.881,0.094,0.673,0.061,3.554,0.112,15,1.5,4.220,0.442,,,DRAC-example,Feldspar,F,AdamiecAitken1998,2,0.2,8,0.4,1.75,0.05,0,0,Y,X,X,X,X,12.5,0.5,X,X,N,X,X,X,X,X,X,X,X,Y,180,212,Bell1980,Mejdahl1979,0,0,Bell1979,0.15,0.05,10,3,0.15,0.015,1.8,0.1,60,100,200,X,X,15,1.5,,,5.56,0.556,0.292,0.029,0.226,0.023,5.856,0.294,0.218,0.013,0.381,0.019,1.369,0.041,0.425,0.015,0.022,0.001,0,0,0,0,0,0,0,0,9.775,0.401,0,0,0.938,0.93,0.926,0.932,0.212,0.021,0.354,0.018,0.394,0.014,0.962,0.031,11.416,0.629,1.901,0.052,1.032,0.033,0,0,9.775,0.401,0.111,0.009,0.129,0.01,0.12,0.01,0.889,0.009,0.871,0.01,0.617,0.08,0.758,0.072,0,0,0,0,0,0,0.856,0.007,0.796,0.009,0.931,0.006,0.318,0.022,0.877,0.007,0.144,0.007,0.204,0.009,0.069,0.006,0.682,0.022,0.25,0.025,0.174,0.011,1.274,0.039,0.007,0.001,0,0,0,0,0,0,0.673,0.061,0,0,1,0,1,0,1,0,1,0,1,0,0.617,0.08,0.758,0.072,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0.25,0.025,0.174,0.011,1.274,0.039,0,0,0,0,0,0,0.673,0.061,0.093,0.033,0.114,0.039,0,0,0,0,0,0,0.206,0.051,1.705,0.048,1.032,0.033,0.179,0.045,1.516,0.066,0.926,0.041,0,0,0.673,0.061,0.253,0.029,48.435,0.23,4.1,0.76,0.26,0.026,2.881,0.094,0.673,0.061,3.554,0.112,4.220,0.442,";
        $this->assertOutputRow( $expected, $input );
    }

    public function testRunCalc_Polymineral() {
        $input = "DRAC-example Polymineral PM AdamiecAitken1998 4 0.4 12 0.12 0.83 0.08 0.00 0.00 Y X X X X 12.5 0.5 X X N X X 2.500 0.150 X X X X Y 4.00 11.00 Bell1980 Mejdahl1979 0.00 0.00 X 0.086 0.0038 10.00 5.00 X X X X X X X 0.20 0.10 204.47 2.69 ";
        $expected = "DRAC-example,Polymineral,PM,1.377,0.131,2.193,0.18,1.1,0.072,0,0,0.026,0.012,0.2,0.1,4.87,0.254,0.026,0.012,4.896,0.255,204.47,2.69,41.765,2.241,,,DRAC-example,Polymineral,PM,AdamiecAitken1998,4,0.4,12,0.12,0.83,0.08,0,0,Y,X,X,X,X,12.5,0.5,X,X,N,X,X,2.5,0.15,X,X,X,X,Y,4,11,Bell1980,Mejdahl1979,0,0,X,0.086,0.0038,10,5,X,X,X,X,X,X,X,0.2,0.1,204.47,2.69,,,11.12,1.113,0.584,0.058,0.452,0.045,8.784,0.093,0.328,0.011,0.571,0.006,0.649,0.063,0.202,0.02,0.009,0.001,0,0,0,0,0,0,0,0,9.775,0.401,0,0,1,1,1,1,0.452,0.045,0.571,0.006,0.202,0.02,1.225,0.05,19.904,1.117,2.5,0.15,1.225,0.05,0,0,9.775,0.401,0.919,0.039,0.931,0.033,0.925,0.036,0.081,0.039,0.069,0.033,10.223,1.11,8.176,0.304,0,0,0,0,0,0,0.983,0.007,0.971,0.01,0.997,0.001,0.938,0.026,0.987,0.005,0.017,0.007,0.029,0.01,0.003,0.001,0.062,0.026,0.574,0.058,0.318,0.011,0.647,0.063,0.008,0.001,2.467,0.149,0,0,0,0,0.026,0.012,0,0,1,0,1,0,1,0,1,0,1,0,10.223,1.11,8.176,0.304,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0.574,0.058,0.318,0.011,0.647,0.063,2.467,0.149,0,0,0,0,0.026,0.012,0.879,0.103,0.703,0.041,0,0,0,0,0,0,1.582,0.111,2.467,0.149,1.225,0.05,1.377,0.131,2.193,0.18,1.1,0.072,0,0,0.026,0.012,0.2,0.1,0,0,0,0,0.2,0.1,4.87,0.254,0.026,0.012,4.896,0.255,41.765,2.241,";
        $this->assertOutputRow( $expected, $input );
    }


    // public function testRunCalc_XXXX() {
    //     $input = "XXXX";
    //     $expected = "XXXX";
    //     $this->assertOutputRow( $expected, $input );
    // }


    private function assertOutputRow( $expected, $input, $row=10, $header=9 ) {
        $calc = $this->initDrac( array('table' => $input) );
        $output_data = explode("\n", $calc->run_calc());
        $output = $output_data[$row];

        $expected_array = explode(",", $expected);
        $output_array = explode(",", $output);
        $output_header_numbers_array = explode(",", $output_data[$header-1]);
        $output_header_array = explode(",", $output_data[$header]);

        $length = count( $expected_array );

        for( $i=0; $i < $length; $i++) {
            $expected = trim( $expected_array[$i] );
            if( ( floatval( $expected ) == 0 ) && ( $output_array[$i] == 'X' ) ) { continue; }
            $this->assertEquals( $expected, $output_array[$i], "FIELD: [" . $output_header_numbers_array[$i] . "] " . $output_header_array[$i] );
        }

        $this->assertEquals( count( $expected_array ), count( $output_array ) );
    }

    private function assertOutputContains( $expected, $input ) {
        $calc = $this->initDrac( array('table' => $input) );
        $this->assertContains( $expected, $calc->run_calc() );
    }
}
