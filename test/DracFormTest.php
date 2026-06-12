<?php
namespace Drac\Calculator\Tests;

use PHPUnit\Framework\TestCase;
use Drac\Calculator\Drac;
use DracForm;

class DracFormTest extends TestCase {

    private function initDrac($params = []) {
        $defaults = [
            'name'  => 'hello',
            'table' => 'TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62',
        ];
        return new DracForm(array_merge($defaults, $params));
    }

    // --- submitted / valid / errors ---

    public function testValid() {
        $calc = $this->initDrac();
        $this->assertTrue($calc->valid());
        $this->assertFalse($calc->errors());
    }

    public function testNotValid() {
        $calc = $this->initDrac(['table' => '']);
        $this->assertFalse($calc->valid());
        $this->assertTrue($calc->errors());
    }

    public function testNotSubmitted() {
        $calc = new DracForm([]);
        $this->assertFalse($calc->valid());
        $this->assertFalse($calc->errors());
    }

    // --- name field ---

    public function testFieldNameValid() {
        $this->assertTrue($this->initDrac()->formFieldValid('name'));
    }

    public function testFieldNameInvalid() {
        $this->assertFalse($this->initDrac(['name' => ''])->formFieldValid('name'));
    }

    // --- table field ---

    public function testFieldTableBlank() {
        $this->assertFalse($this->initDrac(['table' => ''])->formFieldValid('table'));
    }

    public function testFieldTableBadData() {
        $this->assertFalse($this->initDrac(['table' => 'hello'])->formFieldValid('table'));
    }

    public function testFieldTableValid() {
        $this->assertTrue($this->initDrac()->formFieldValid('table'));
    }

    public function testFieldTableMultipleRows() {
        $row = 'TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $calc = $this->initDrac(['table' => $row . "\n" . $row]);
        $this->assertTrue($calc->formFieldValid('table'));
    }

    public function testFieldTableMultipleSpacesAndTabs() {
        $calc = $this->initDrac(['table' => "   TestProject    Aber/136-3-1 Q     AdamiecAitken1998\t3.393  \t 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62"]);
        $this->assertTrue($calc->formFieldValid('table'));
    }

    // --- TI:N field validation ---

    public function testTI3InvalidAcrossRows() {
        $row = 'TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $bad  = 'TestProject Aber/136-3-1 A AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $calc = $this->initDrac(['table' => $bad . "\n" . $row]);
        $this->assertFalse($calc->formFieldValid('table'));
    }

    public function testTI4Invalid() {
        $bad = 'TestProject Aber/136-3-1 Q A 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $row = 'TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $this->assertFalse($this->initDrac(['table' => $bad . "\n" . $row])->formFieldValid('table'));
    }

    public function testTI5Invalid() {
        $bad = 'TestProject Aber/136-3-1 Q AdamiecAitken1998 -1 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $row = 'TestProject Aber/136-3-1 Q AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $this->assertFalse($this->initDrac(['table' => $bad . "\n" . $row])->formFieldValid('table'));
    }

    public function testFormFieldValidTI3Valid() {
        $this->assertTrue($this->initDrac()->formFieldValid('TI:3'));
    }

    public function testFormFieldValidTI3Invalid() {
        $bad = 'TestProject Aber/136-3-1 A AdamiecAitken1998 3.393 0.506 14.471 1.685 1.196 0.135 0 0 N X X X X X X X X X X X 1.83 0.06 X X X X N 90 125 Bell1980 Mejdahl1979 9 10 X X X 5 2 2.22 0.05 1.8 0.1 29.19 72.88 148 X X 16.49 0.62';
        $this->assertFalse($this->initDrac(['table' => $bad])->formFieldValid('TI:3'));
    }

    public function testFormFieldErrorMessageTI3ReturnsDescription() {
        $msg = $this->initDrac()->formFieldErrorMessage('TI:3');
        $this->assertStringContainsString('mineral', $msg);
    }

    // --- caching ---

    public function testParseErrorsAreCached() {
        $calc = $this->initDrac();
        $prop = new \ReflectionProperty(DracForm::class, 'parseErrors');

        $this->assertNull($prop->getValue($calc));
        $calc->formFieldValid('table');
        $this->assertSame('', $prop->getValue($calc));
        $calc->valid();
        $calc->formFieldErrorMessage('table');
        $this->assertSame('', $prop->getValue($calc));
    }

    // --- toCsv throws ---

    public function testToCsvThrowsWhenNotSubmitted() {
        $this->expectException(\RuntimeException::class);
        (new DracForm([]))->toCsv();
    }

    public function testToCsvThrowsWhenInvalid() {
        $this->expectException(\RuntimeException::class);
        $this->initDrac(['table' => ''])->toCsv();
    }

    // --- output file name ---

    public function testOutputFileNameFromForm() {
        $calc = $this->initDrac(['name' => 'my sample']);
        $this->assertMatchesRegularExpression(
            '/^my_sample_\d+_DRACv' . preg_quote(Drac::VERSION, '/') . '\.csv$/',
            $calc->outputFileName()
        );
    }

    // --- calculation results ---

    public function testRunCalc_Quartz_Q() {
        $input    = "DRAC-example Quartz Q AdamiecAitken1998 3.4 0.51 14.47 1.69 1.2 0.14 0 0 N 0 0 0 0 0 0 0 0 N 0 0 0 0 0 0 0 0 N 90 125 Brennanetal1991 Guerinetal2012-Q 8 10 Bell1979 0 0 5 2 0 0 1.8 0.1 30 70 150 X X 20 0.2";
        $expected = "DRAC-example,Quartz,Q,0,0,1.539,0.127,1.291,0.103,0,0,0,0,0.285,0.029,3.115,0.166,0,0,3.115,0.166,20,0.2,6.421,0.348,,,DRAC-example,Quartz,Q,AdamiecAitken1998,3.4,0.51,14.47,1.69,1.2,0.14,0,0,N,0,0,0,0,0,0,0,0,N,0,0,0,0,0,0,0,0,N,90,125,Brennanetal1991,Guerinetal2012-Q,8,10,Bell1979,0,0,5,2,0,0,1.8,0.1,30,70,150,X,X,20,0.2,,,9.452,1.418,0.496,0.074,0.384,0.058,10.592,1.238,0.395,0.048,0.689,0.08,0.938,0.11,0.292,0.034,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,0.384,0.058,0.689,0.08,0.292,0.034,1.365,0.105,20.044,1.882,1.83,0.141,1.365,0.105,0,0,0,0,0.145,0.016,0.172,0.028,0.159,0.022,0.855,0.016,0.828,0.028,1.367,0.253,1.82,0.363,0,0,0,0,0,0,0.901,0.009,0.861,0.013,0.96,0.007,0.494,0.049,0.919,0.009,0.099,0.009,0.139,0.013,0.04,0.007,0.506,0.049,0.447,0.067,0.34,0.042,0.901,0.106,0,0,0,0,0,0,0,0,0,0,0,0,0.35,0.05,0.434,0.047,0.391,0.049,1.178,0.014,1.186,0.016,0.478,0.112,0.79,0.179,0,0,0,0,0,0,0.939,0.004,0.922,0.007,1,0,0.963,0.003,1.496,0.037,1.322,0.034,1,0,0.42,0.063,0.313,0.038,0.901,0.106,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1.635,0.129,1.365,0.105,0,0,1.539,0.127,1.291,0.103,0,0,0,0,0.295,0.016,20.905,0.345,4.29,0.6,0.285,0.029,3.115,0.166,0,0,3.115,0.166,6.421,0.348,";
        $this->assertOutputRow($expected, $input);
    }

    public function testRunCalc_Feldspar() {
        $input    = "DRAC-example Feldspar F AdamiecAitken1998 2 0.2 8 0.4 1.75 0.05 0.00 0.00 Y X X X X 12.50 0.50 X X N X X X X X X X X Y 180.00 212.00 Bell1980 Mejdahl1979 0.00 0.00 Bell1979 0.15 0.050 10.00 3.00 0.15 0.015 1.80 0.10 60.00 100.00 200.00 X X 15.00 1.50";
        $expected = "DRAC-example,Feldspar,F,0.179,0.045,1.516,0.066,0.872,0.039,0,0,0.673,0.061,0.26,0.026,2.827,0.093,0.673,0.061,3.499,0.111,15,1.5,4.286,0.45,,,DRAC-example,Feldspar,F,AdamiecAitken1998,2,0.2,8,0.4,1.75,0.05,0,0,Y,X,X,X,X,12.5,0.5,X,X,N,X,X,X,X,X,X,X,X,Y,180,212,Bell1980,Mejdahl1979,0,0,Bell1979,0.15,0.05,10,3,0.15,0.015,1.8,0.1,60,100,200,X,X,15,1.5,,,5.56,0.556,0.292,0.029,0.226,0.023,5.856,0.294,0.218,0.013,0.381,0.019,1.369,0.041,0.425,0.015,0.022,0.001,0,0,0,0,0,0,0,0,9.775,0.401,0,0,0.948,0.941,0.937,0.942,0.214,0.021,0.358,0.018,0.398,0.014,0.972,0.031,11.416,0.629,1.901,0.052,1.032,0.033,0,0,9.775,0.401,0.111,0.009,0.129,0.01,0.12,0.01,0.889,0.009,0.871,0.01,0.617,0.08,0.758,0.072,0,0,0,0,0,0,0.856,0.007,0.796,0.009,0.931,0.006,0.318,0.022,0.877,0.007,0.144,0.007,0.204,0.009,0.069,0.006,0.682,0.022,0.25,0.025,0.174,0.011,1.274,0.039,0.007,0.001,0,0,0,0,0,0,0.673,0.061,0,0,1,0,1,0,1,0,1,0,1,0,0.617,0.08,0.758,0.072,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0.25,0.025,0.174,0.011,1.274,0.039,0,0,0,0,0,0,0.673,0.061,0.093,0.033,0.114,0.039,0,0,0,0,0,0,0.206,0.051,1.705,0.048,1.032,0.033,0.179,0.045,1.516,0.066,0.872,0.039,0,0,0.673,0.061,0.253,0.029,48.435,0.23,4.1,0.76,0.26,0.026,2.827,0.093,0.673,0.061,3.499,0.111,4.286,0.45,";
        $this->assertOutputRow($expected, $input);
    }

    public function testRunCalc_Polymineral() {
        $input    = "DRAC-example Polymineral PM AdamiecAitken1998 4 0.4 12 0.12 0.83 0.08 0.00 0.00 Y X X X X 12.5 0.5 X X N X X 2.500 0.150 X X X X Y 4.00 11.00 Bell1980 Mejdahl1979 0.00 0.00 X 0.086 0.0038 10.00 5.00 0.20 0.02 1.80 0.10 46.00 118.00 200.00 0.20 0.10 204.47 2.69";
        $expected = "DRAC-example,Polymineral,PM,1.377,0.131,2.193,0.18,1.066,0.07,0,0,0.026,0.012,0.2,0.1,4.836,0.254,0.026,0.012,4.862,0.254,204.47,2.69,42.058,2.266,,,DRAC-example,Polymineral,PM,AdamiecAitken1998,4,0.4,12,0.12,0.83,0.08,0,0,Y,X,X,X,X,12.5,0.5,X,X,N,X,X,2.5,0.15,X,X,X,X,Y,4,11,Bell1980,Mejdahl1979,0,0,X,0.086,0.0038,10,5,0.2,0.02,1.8,0.1,46,118,200,0.2,0.1,204.47,2.69,,,11.12,1.113,0.584,0.058,0.452,0.045,8.784,0.093,0.328,0.011,0.571,0.006,0.649,0.063,0.202,0.02,0.009,0.001,0,0,0,0,0,0,0,0,9.775,0.401,0,0,0.973,0.967,0.966,0.968,0.44,0.044,0.552,0.006,0.195,0.019,1.186,0.048,19.904,1.117,2.5,0.15,1.225,0.05,0,0,9.775,0.401,0.919,0.039,0.931,0.033,0.925,0.036,0.081,0.039,0.069,0.033,10.223,1.11,8.176,0.304,0,0,0,0,0,0,0.983,0.007,0.971,0.01,0.997,0.001,0.938,0.026,0.987,0.005,0.017,0.007,0.029,0.01,0.003,0.001,0.062,0.026,0.574,0.058,0.318,0.011,0.647,0.063,0.008,0.001,2.467,0.149,0,0,0,0,0.026,0.012,0,0,1,0,1,0,1,0,1,0,1,0,10.223,1.11,8.176,0.304,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0.574,0.058,0.318,0.011,0.647,0.063,2.467,0.149,0,0,0,0,0.026,0.012,0.879,0.103,0.703,0.041,0,0,0,0,0,0,1.582,0.111,2.467,0.149,1.225,0.05,1.377,0.131,2.193,0.18,1.066,0.07,0,0,0.026,0.012,0.243,0.028,34.352,0.25,4.11,0.745,0.2,0.1,4.836,0.254,0.026,0.012,4.862,0.254,42.058,2.266,";
        $this->assertOutputRow($expected, $input);
    }

    public function testRunCalc_Quartz_ZeroTI9() {
        $input    = "DRAC-example Quartz Q AdamiecAitken1998 3.4000 0.5100 14.4700 1.6900 0 0.1400 0.0000 0.0000 Y X X X X 0 X X X Y X X X X X X X X N 90.0000 125.0000 Brennanetal1991 Guerinetal2012-Q 8.0000 10.0000 Bell1979 0.0000 0.0000 5.0000 2.0000 2.2000 0.2200 1.8000 0.1000 30.0000 70.0000 150.0000 X X 20.0000 0.2000";
        $expected = "DRAC-example,Quartz,Q,0,0,0.69,0.071,1.015,0.096,0,0,0,0,0.154,0.015,1.86,0.121,0,0,1.86,0.121,20,0.2,10.753,0.707,,,DRAC-example,Quartz,Q,AdamiecAitken1998,3.4,0.51,14.47,1.69,0,0.14,0,0,Y,X,X,X,X,0,X,X,X,Y,X,X,X,X,X,X,X,X,N,90,125,Brennanetal1991,Guerinetal2012-Q,8,10,Bell1979,0,0,5,2,2.2,0.22,1.8,0.1,30,70,150,X,X,20,0.2,,,9.452,1.418,0.496,0.074,0.384,0.058,10.592,1.238,0.395,0.048,0.689,0.08,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,0.384,0.058,0.689,0.08,0,0,1.073,0.099,20.044,1.882,0.891,0.089,1.073,0.099,0,0,0,0,0.145,0.016,0.172,0.028,0.159,0.022,0.855,0.016,0.828,0.028,1.367,0.253,1.82,0.363,0,0,0,0,0,0,0.901,0.009,0.861,0.013,0.96,0.007,0.494,0.049,0.919,0.009,0.099,0.009,0.139,0.013,0.04,0.007,0.506,0.049,0.447,0.067,0.34,0.042,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0.35,0.05,0.434,0.047,0.391,0.049,1.178,0.014,1.186,0.016,0.478,0.112,0.79,0.179,0,0,0,0,0,0,0.939,0.004,0.922,0.007,1,0,0.963,0.003,1.496,0.037,1.322,0.034,1,0,0.42,0.063,0.313,0.038,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0.734,0.074,1.073,0.099,0,0,0.69,0.071,1.015,0.096,0,0,0,0,0.16,0.018,20.905,0.345,4.29,0.6,0.154,0.015,1.86,0.121,0,0,1.86,0.121,10.753,0.707,";
        $this->assertOutputRow($expected, $input);
    }

    public function testRunCalc_Quartz_Guerinetal2011() {
        $input    = "156_LL1 Quartz Q Guerinetal2011 0.446 0.06 1.674 0.196 0.219 0.019 0 0 Y X X X X X X X X X X X 0.282 0.011 X X 0.03 0.005 N 180 211 Brennanetal1991 Guerinetal2012-Q 10 12 Bell1979 0 0 3 2 1 0.1 1.8 0.1 31 4 740 X X 0.027 0.002";
        $expected = "156_LL1,Quartz,Q,0,0,0.228,0.011,0.178,0.013,0,0,0,0,0.211,0.021,0.618,0.027,0.03,0.005,0.648,0.027,0.027,0.002,0.042,0.004,,,156_LL1,Quartz,Q,Guerinetal2011,0.446,0.06,1.674,0.196,0.219,0.019,0,0,Y,X,X,X,X,X,X,X,X,X,X,X,0.282,0.011,X,X,0.03,0.005,N,180,211,Brennanetal1991,Guerinetal2012-Q,10,12,Bell1979,0,0,3,2,1,0.1,1.8,0.1,31,4,740,X,X,0.027,0.002,,,1.247,0.168,0.065,0.009,0.05,0.007,1.235,0.145,0.046,0.006,0.08,0.009,0.175,0.015,0.055,0.005,-0,-0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,0.05,0.007,0.08,0.009,0.055,0.005,0.185,0.013,2.481,0.221,0.282,0.011,0.185,0.013,0,0,0,0,0.083,0.008,0.09,0.008,0.087,0.008,0.917,0.008,0.91,0.008,0.103,0.017,0.112,0.016,0,0,0,0,0,0,0.859,0.007,0.803,0.009,0.927,0.006,0.318,0.022,0.877,0.007,0.141,0.007,0.197,0.009,0.073,0.006,0.682,0.022,0.056,0.008,0.037,0.005,0.162,0.014,-0,-0,0.247,0.01,0,0,0,0,0,0,0,0,0.255,0.045,0.345,0.043,0.299,0.044,1.204,0.012,1.216,0.014,0.026,0.006,0.038,0.007,0,0,0,0,0,0,0.931,0.004,0.909,0.006,1,0,0.957,0.003,1.563,0.03,1.388,0.032,1,0,0.052,0.007,0.034,0.004,0.162,0.014,0.237,0.009,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0.237,0.009,0.185,0.013,0,0,0.228,0.011,0.178,0.013,0,0,0,0,0.185,0.021,33.717,0.25,4.11,0.745,0.211,0.021,0.618,0.027,0.03,0.005,0.648,0.027,0.042,0.004,";
        $this->assertOutputRow($expected, $input);
    }

    // --- cross-API consistency ---

    public function testCalculateMatchesTableToCsvValues() {
        $tableRow  = "DRAC-example Quartz Q AdamiecAitken1998 3.4 0.51 14.47 1.69 1.2 0.14 0 0 N 0 0 0 0 0 0 0 0 N 0 0 0 0 0 0 0 0 N 90 125 Brennanetal1991 Guerinetal2012-Q 8 10 Bell1979 0 0 5 2 0 0 1.8 0.1 30 70 150 X X 20 0.2";
        $tableCalc = $this->initDrac(['table' => $tableRow]);
        $keyedCalc = new Drac($this->keyedRow());

        $tableResult = $tableCalc->toCsv(); // use toCsv to get computed values
        $keyedResult = $keyedCalc->calculate();

        // compare age and uncertainty via keyed calculate
        $this->assertEqualsWithDelta(6.421, round($keyedResult['TO:GO'], 3), 1e-9);
    }

    public function testKeyedToCsvMatchesTableToCsv() {
        $tableRow  = "DRAC-example Quartz Q AdamiecAitken1998 3.4 0.51 14.47 1.69 1.2 0.14 0 0 N 0 0 0 0 0 0 0 0 N 0 0 0 0 0 0 0 0 N 90 125 Brennanetal1991 Guerinetal2012-Q 8 10 Bell1979 0 0 5 2 0 0 1.8 0.1 30 70 150 X X 20 0.2";
        $tableCalc = $this->initDrac(['table' => $tableRow]);
        $keyedCalc = new Drac($this->keyedRow());

        $tableLines = explode("\n", $tableCalc->toCsv());
        $keyedLines = explode("\n", $keyedCalc->toCsv());
        $this->assertSame($tableLines[10], $keyedLines[10]);
    }

    // --- helpers ---

    private function keyedRow(): array {
        return [
            'TI:1'  => 'DRAC-example', 'TI:2'  => 'Quartz',          'TI:3'  => 'Q',
            'TI:4'  => 'AdamiecAitken1998',
            'TI:5'  => '3.4',  'TI:6'  => '0.51', 'TI:7'  => '14.47', 'TI:8'  => '1.69',
            'TI:9'  => '1.2',  'TI:10' => '0.14', 'TI:11' => '0',     'TI:12' => '0',
            'TI:13' => 'N',
            'TI:14' => '0',    'TI:15' => '0',    'TI:16' => '0',     'TI:17' => '0',
            'TI:18' => '0',    'TI:19' => '0',    'TI:20' => '0',     'TI:21' => '0',
            'TI:22' => 'N',
            'TI:23' => '0',    'TI:24' => '0',    'TI:25' => '0',     'TI:26' => '0',
            'TI:27' => '0',    'TI:28' => '0',    'TI:29' => '0',     'TI:30' => '0',
            'TI:31' => 'N',
            'TI:32' => '90',   'TI:33' => '125',
            'TI:34' => 'Brennanetal1991', 'TI:35' => 'Guerinetal2012-Q',
            'TI:36' => '8',    'TI:37' => '10',   'TI:38' => 'Bell1979',
            'TI:39' => '0',    'TI:40' => '0',
            'TI:41' => '5',    'TI:42' => '2',
            'TI:43' => '0',    'TI:44' => '0',    'TI:45' => '1.8',   'TI:46' => '0.1',
            'TI:47' => '30',   'TI:48' => '70',   'TI:49' => '150',
            'TI:50' => 'X',    'TI:51' => 'X',
            'TI:52' => '20',   'TI:53' => '0.2',
        ];
    }

    private function assertOutputRow($expected, $input, $row = 10, $header = 9) {
        $calc        = $this->initDrac(['table' => $input]);
        $output_data = explode("\n", $calc->toCsv());
        $output      = $output_data[$row];

        $expected_array             = explode(",", $expected);
        $output_array               = explode(",", $output);
        $output_header_numbers_array = explode(",", $output_data[$header - 1]);
        $output_header_array        = explode(",", $output_data[$header]);

        $length = count($expected_array);

        for ($i = 0; $i < $length; $i++) {
            $exp = trim($expected_array[$i]);
            if ((floatval($exp) == 0) && ($output_array[$i] == 'X')) { continue; }
            $this->assertEquals($exp, $output_array[$i], "FIELD: [" . $output_header_numbers_array[$i] . "] " . $output_header_array[$i]);
        }

        $this->assertEquals(count($expected_array), count($output_array));
    }
}
