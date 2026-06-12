<?php
namespace Drac\Calculator\Tests;

use PHPUnit\Framework\TestCase;
use Drac\Calculator\Drac;

class DracTest extends TestCase {

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

    public function testVersion() {
        $this->assertEquals('1.3', Drac::VERSION);
    }

    public function testValidWithValidData() {
        $drac = new Drac($this->keyedRow());
        $this->assertTrue($drac->valid());
        $this->assertFalse($drac->errors());
    }

    public function testValidWithInvalidData() {
        $row = $this->keyedRow();
        $row['TI:3'] = 'INVALID';
        $drac = new Drac($row);
        $this->assertFalse($drac->valid());
        $this->assertTrue($drac->errors());
    }

    public function testOutputFileName() {
        $calc = new Drac($this->keyedRow());
        $this->assertMatchesRegularExpression(
            '/^DRAC-example_\d+_DRACv' . preg_quote(Drac::VERSION, '/') . '\.csv$/',
            $calc->outputFileName()
        );
    }

    public function testOutputFileNameTimestamp() {
        $calc = new Drac($this->keyedRow());
        $before = time();
        $filename = $calc->outputFileName();
        $after = time();
        preg_match('/_(\d+)_DRACv/', $filename, $m);
        $this->assertGreaterThanOrEqual($before, (int)$m[1]);
        $this->assertLessThanOrEqual($after, (int)$m[1]);
    }

    public function testNullValueTreatedAsX() {
        $row = $this->keyedRow();
        $row['TI:50'] = null;
        unset($row['TI:51']);
        $calc = new Drac($row);
        $this->assertTrue($calc->valid());
        $result = $calc->calculate();
        $this->assertSame('X', $result['TI:50']);
        $this->assertSame('X', $result['TI:51']);
    }

    public function testEmptyStringTreatedAsX() {
        $row = $this->keyedRow();
        $row['TI:50'] = '';
        $row['TI:51'] = '   ';
        $calc = new Drac($row);
        $this->assertTrue($calc->valid());
        $result = $calc->calculate();
        $this->assertSame('X', $result['TI:50']);
        $this->assertSame('X', $result['TI:51']);
    }

    public function testMalformedNumberIsRejected() {
        $row = $this->keyedRow();
        $row['TI:5'] = '12abc';
        $drac = new Drac($row);
        $this->assertFalse($drac->valid());
        $this->assertTrue($drac->fieldHasErrors('TI:5'));
    }

    public function testBlankRequiredFloatIsRejected() {
        $row = $this->keyedRow();
        $row['TI:41'] = 'X';
        $drac = new Drac($row);
        $this->assertFalse($drac->valid());
        $this->assertTrue($drac->fieldHasErrors('TI:41'));
    }

    public function testToCsvThrowsWhenNotValid() {
        $this->expectException(\RuntimeException::class);
        $row = $this->keyedRow();
        $row['TI:3'] = 'INVALID';
        (new Drac($row))->toCsv();
    }

    public function testCalculateThrowsWhenNotValid() {
        $this->expectException(\RuntimeException::class);
        $row = $this->keyedRow();
        $row['TI:3'] = 'INVALID';
        (new Drac($row))->calculate();
    }

    public function testCalculateSingleRowReturnsFlat() {
        $result = (new Drac($this->keyedRow()))->calculate();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('TI:1', $result);
        $this->assertArrayHasKey('TO:GP', $result);
        $this->assertArrayNotHasKey(0, $result);
    }

    public function testCalculateMultiRowReturnsArrayOfArrays() {
        $rows = [$this->keyedRow(), $this->keyedRow()];
        $result = (new Drac($rows))->calculate();
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertArrayHasKey('TI:1', $result[0]);
        $this->assertArrayHasKey('TO:GP', $result[0]);
    }

    public function testCalculateWrapsComputeErrorsWithOutputKey() {
        $row = $this->keyedRow();
        foreach (['TI:5', 'TI:6', 'TI:7', 'TI:8', 'TI:9', 'TI:10'] as $key) {
            $row[$key] = '0';
        }
        $row['TI:50'] = '0';  // user cosmic dose rate overrides the calculated one
        $row['TI:51'] = '0';
        $drac = new Drac($row);
        $this->assertTrue($drac->valid());
        try {
            $drac->calculate();
            $this->fail('Expected RuntimeException for zero dose rate');
        } catch (\RuntimeException $e) {
            $this->assertStringContainsString('TO:GO', $e->getMessage());
            $this->assertInstanceOf(\DivisionByZeroError::class, $e->getPrevious());
        }
    }

    public function testCalculateAge() {
        $result = (new Drac($this->keyedRow()))->calculate();
        $this->assertEqualsWithDelta(6.421, round($result['TO:GO'], 3), 1e-9);
        $this->assertEqualsWithDelta(0.348, round($result['TO:GP'], 3), 1e-9);
    }

    public function testStaticInputsReturnsAllFields() {
        $inputs = Drac::inputs();
        $this->assertArrayHasKey('TI:1', $inputs);
        $this->assertArrayHasKey('TI:53', $inputs);
        $this->assertArrayHasKey('name', $inputs['TI:3']);
        $this->assertArrayHasKey('description', $inputs['TI:3']);
        $this->assertArrayHasKey('validate', $inputs['TI:3']);
    }

    public function testFieldErrorsEmptyWhenValid() {
        $calc = new Drac($this->keyedRow());
        $this->assertTrue($calc->valid());
        $this->assertSame([], $calc->fieldErrors());
    }

    public function testFieldErrorsReturnsPerFieldMessageSingleRow() {
        $row = $this->keyedRow();
        $row['TI:3'] = 'BADMINERAL';
        $calc = new Drac($row);
        $this->assertFalse($calc->valid());
        $errors = $calc->fieldErrors();
        $this->assertArrayHasKey('TI:3', $errors);
        $this->assertStringContainsString('Found "BADMINERAL"', $errors['TI:3']);
    }

    public function testFieldErrorsMultiRowReturnsPerRowArray() {
        $goodRow = $this->keyedRow();
        $badRow  = $this->keyedRow();
        $badRow['TI:3'] = 'BADMINERAL';
        $calc = new Drac([$goodRow, $badRow]);
        $this->assertFalse($calc->valid());
        $errors = $calc->fieldErrors();
        $this->assertCount(2, $errors);
        $this->assertSame([], $errors[0]);
        $this->assertArrayHasKey('TI:3', $errors[1]);
    }

    public function testFieldHasErrorsReturnsFalseWhenValid() {
        $calc = new Drac($this->keyedRow());
        $this->assertFalse($calc->fieldHasErrors('TI:3'));
    }

    public function testFieldHasErrorsReturnsTrueForInvalidField() {
        $row = $this->keyedRow();
        $row['TI:3'] = 'BADMINERAL';
        $calc = new Drac($row);
        $this->assertTrue($calc->fieldHasErrors('TI:3'));
        $this->assertFalse($calc->fieldHasErrors('TI:5'));
    }

    public function testMinimumRequiredFieldsAreValid() {
        $row = array_fill_keys(array_keys(Drac::inputs()), 'X');
        $row['TI:1']  = 'MinimalTest';
        $row['TI:2']  = 'Quartz';
        $row['TI:3']  = 'Q';
        $row['TI:32'] = '90';
        $row['TI:33'] = '125';
        $row['TI:34'] = 'Bell1980';
        $row['TI:35'] = 'Mejdahl1979';
        $row['TI:36'] = '8';
        $row['TI:37'] = '10';
        $row['TI:41'] = '5';
        $row['TI:42'] = '2';
        $calc = new Drac($row);
        $this->assertTrue($calc->valid());
    }

    public function testFieldHasErrorsAcrossMultipleRows() {
        $goodRow = $this->keyedRow();
        $badRow  = $this->keyedRow();
        $badRow['TI:3'] = 'BADMINERAL';
        $calc = new Drac([$goodRow, $badRow]);
        $this->assertTrue($calc->fieldHasErrors('TI:3'));
    }
}
