<?php
namespace Drac\Calculator\Tests;

use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase {

    private static int $port = 8799;
    private static mixed $server_proc = null;

    public static function setUpBeforeClass(): void {
        $root = realpath(dirname(__FILE__) . '/..');
        $cmd  = sprintf('php -S localhost:%d -t %s', self::$port, escapeshellarg($root));
        $descriptors = [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']];
        self::$server_proc = proc_open($cmd, $descriptors, $pipes);

        for ($i = 0; $i < 40; $i++) {
            $fp = @fsockopen('localhost', self::$port, $errno, $errstr, 0.1);
            if ($fp) { fclose($fp); break; }
            usleep(100_000);
        }
    }

    public static function tearDownAfterClass(): void {
        if (self::$server_proc !== null) {
            proc_terminate(self::$server_proc);
            proc_close(self::$server_proc);
        }
    }

    private function get(string $path): array {
        $body = file_get_contents('http://localhost:' . self::$port . $path);
        return ['body' => $body, 'headers' => $http_response_header ?? []];
    }

    private function post(string $path, array $data): array {
        $context = stream_context_create(['http' => [
            'method'        => 'POST',
            'header'        => 'Content-Type: application/x-www-form-urlencoded',
            'content'       => http_build_query($data),
            'ignore_errors' => true,
        ]]);
        $body = file_get_contents('http://localhost:' . self::$port . $path, false, $context);
        return ['body' => $body, 'headers' => $http_response_header ?? []];
    }

    // --- page render tests ---

    public function testUserGuidePage(): void {
        $r = $this->get('/blank.php?show=userguide');
        $this->assertStringContainsString('<h1>DRAC &mdash; User Guide</h1>', $r['body']);
    }

    public function testDatatablesPage(): void {
        $r = $this->get('/blank.php?show=datatables');
        $this->assertStringContainsString('<h1>DRAC &mdash; Data Tables</h1>', $r['body']);
    }

    public function testNewsPage(): void {
        $r = $this->get('/blank.php?show=news');
        $this->assertStringContainsString('<h1>DRAC &mdash; News</h1>', $r['body']);
    }

    public function testWhoWeArePage(): void {
        $r = $this->get('/blank.php?show=whoweare');
        $this->assertStringContainsString('<h1>DRAC &mdash; Who we are</h1>', $r['body']);
    }

    public function testReferencesPage(): void {
        $r = $this->get('/blank.php?show=references');
        $this->assertStringContainsString('<h1>DRAC &mdash; References</h1>', $r['body']);
    }

    // --- calculator tests ---

    public function testCalculatorPageLoads(): void {
        $r = $this->get('/blank.php?show=calculator');
        $this->assertStringContainsString('<h1>DRAC &mdash; Calculator</h1>', $r['body']);
    }

    public function testCalculatorErrorOnEmptySubmission(): void {
        $r = $this->post('/blank.php?show=calculator', [
            'drac_data' => ['name' => '', 'table' => ''],
        ]);
        $this->assertStringContainsString('drac_field_error', $r['body']);
        $this->assertStringContainsString('Name must not be blank', $r['body']);
        $this->assertStringContainsString('Data table must not be blank', $r['body']);
    }

    public function testCalculatorErrorOnInvalidTableData(): void {
        $r = $this->post('/blank.php?show=calculator', [
            'drac_data' => ['name' => 'TestProject', 'table' => 'bad data'],
        ]);
        $this->assertStringContainsString('drac_field_error', $r['body']);
        $this->assertStringContainsString('Expected 53 columns', $r['body']);
    }

    public function testDatatableDownload(): void {
        $r = $this->get('/blank.php?show=datatabledownload&datatableid=1');
        $headers = implode("\n", $r['headers']);
        $this->assertStringContainsString('text/csv', $headers);
        $this->assertStringContainsString('Content-Disposition: attachment', $headers);
        $this->assertStringContainsString('filename=datatable-1.csv', $headers);
    }

    public function testDatatableDownloadInvalidId(): void {
        $r = $this->get('/blank.php?show=datatabledownload&datatableid=99');
        $headers = implode("\n", $r['headers']);
        $this->assertStringNotContainsString('text/csv', $headers);
    }

    public function testCalculatorDownloadOnValidData(): void {
        $validRow = 'DRAC-example Quartz Q AdamiecAitken1998 3.4 0.51 14.47 1.69 1.2 0.14 0 0 N '
                  . '0 0 0 0 0 0 0 0 N 0 0 0 0 0 0 0 0 N 90 125 Brennanetal1991 Guerinetal2012-Q '
                  . '8 10 Bell1979 0 0 5 2 0 0 1.8 0.1 30 70 150 X X 20 0.2';
        $r = $this->post('/blank.php?show=calculator', [
            'drac_data' => ['name' => 'TestDownload', 'table' => $validRow],
        ]);
        $headers = implode("\n", $r['headers']);
        $this->assertStringContainsString('text/csv', $headers);
        $this->assertStringContainsString('Content-Disposition: attachment', $headers);
        $this->assertStringContainsString('DRAC-example', $r['body']);
    }
}
