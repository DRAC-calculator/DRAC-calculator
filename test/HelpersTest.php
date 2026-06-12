<?php
namespace Drac\Calculator\Tests;

use function Drac\Calculator\{within_range, greater_than, greater_or_equal_to, less_than, valid_blank, valid_blank_input};

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase {

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

    public function test__valid_blank() {
        $this->assertEquals(valid_blank('X'), true);
        $this->assertEquals(valid_blank('x'), false);
        $this->assertEquals(valid_blank(''), false);
        $this->assertEquals(valid_blank('0'), false);
        $this->assertEquals(valid_blank('XX'), false);
    }

    public function test__valid_blank_input() {
        $optional = ['required' => false];
        $required = ['required' => true];
        $this->assertEquals(valid_blank_input($optional, 'X'), true);
        $this->assertEquals(valid_blank_input($optional, 'x'), false);
        $this->assertEquals(valid_blank_input($optional, ''), false);
        $this->assertEquals(valid_blank_input($optional, '0'), false);
        $this->assertEquals(valid_blank_input($required, 'X'), false);
    }

}
