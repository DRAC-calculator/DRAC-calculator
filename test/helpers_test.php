<?php
// run:   phpunit test/helpers_test.php 

define('DRAC_ROOT', dirname(__FILE__) . '/..' );
require(DRAC_ROOT . '/calculator/validation_helpers.php');

class HelpersTest extends PHPUnit_Framework_TestCase {

     public function test__within_range() {
        $this->assertEquals(within_range(0, 10, '0'), true);
        $this->assertEquals(within_range(0, 10, '10'), true);
        $this->assertEquals(within_range(0, 10, '-1'), false);
        $this->assertEquals(within_range(0, 10, '11'), false);
        $this->assertEquals(within_range(0, 10, '10.1'), false);
        $this->assertEquals(within_range(0, 10, 'aaa'), false);
        $this->assertEquals(within_range(0, 10, '2aaa'), false);
    }

    public function test__greater_than() {
        $this->assertEquals(greater_than(1, '2'), true);
        $this->assertEquals(greater_than(1, '1'), false);
        $this->assertEquals(greater_than(1, '-1'), false);
        $this->assertEquals(greater_than(1, '0.9'), false);
        $this->assertEquals(greater_than(1, 'aaa'), false);
        $this->assertEquals(greater_than(1, '2aaa'), false);
    }

    public function test__greater_or_equal_to() {
        $this->assertEquals(greater_or_equal_to(1, '2'), true);
        $this->assertEquals(greater_or_equal_to(1, '1'), true);
        $this->assertEquals(greater_or_equal_to(1, '-1'), false);
        $this->assertEquals(greater_or_equal_to(1, '0.9'), false);
        $this->assertEquals(greater_or_equal_to(1, 'aaa'), false);
        $this->assertEquals(greater_or_equal_to(1, '2aaa'), false);
    }

    public function test__less_than() {
        $this->assertEquals(less_than(1, '2'), false);
        $this->assertEquals(less_than(1, '1'), false);
        $this->assertEquals(less_than(1, '-1'), true);
        $this->assertEquals(less_than(1, '0.9'), true);
        $this->assertEquals(less_than(1, 'aaa'), false);
        $this->assertEquals(less_than(1, '2aaa'), false);
    }

}