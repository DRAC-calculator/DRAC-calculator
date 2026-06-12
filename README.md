# DRAC Calculator

DRAC is a Dose Rate and Age Calculator which has been designed to calculate environmental dose rates (Ḋ) and ages for trapped charge dating applications.


## Code breakdown

Directory structure:
* `/calculator` - Calculator code
* `/pages` - Page content (each page has a separate file)
* `/main` - Web app initialisation code
* `/datatable-templates` - Templates to write out the data tables
* `/downloads` - Files available for download
* `/images` - Images used
* `/test` - PHPUnit test files

Calculator files include:
* `/calculator/inputs.php` - Input descriptions and validations
* `/calculator/outputs.php` - Output descriptions and calculations
* `/calculator/Drac.php` - Calculator setup code
* `/calculator/LookupTables.php` - Lookup table data


## Running locally

`blank.php` is a stripped-down entry point that has no external dependencies, unlike `index.php` which requires Aberystwyth University server infrastructure. Use it when developing locally.

Start PHP's built-in web server from the project root:

```bash
    php -S localhost:8080
```

Then open [http://localhost:8080/blank.php](http://localhost:8080/blank.php) in a browser.

## Testing

Install dependencies (e.g. phpunit) with [Composer](https://getcomposer.org/):

```bash
composer install
```

Run the tests:

```bash
./vendor/bin/phpunit test/drac_test.php         # Drac library unit tests
./vendor/bin/phpunit test/drac_form_test.php    # DracForm wrapper tests
./vendor/bin/phpunit test/helpers_test.php      # validation helper tests
./vendor/bin/phpunit test/integration_test.php  # HTTP integration tests (requires php -S)
```

## DRAC Calculator As A Library

The calculator can be used as a PHP library without the web layer. The library lives in the `Drac\Calculator` namespace and is autoloadable via Composer (PSR-4).

### Installing with Composer

The package is not published on Packagist, so add the [GitHub repository](https://github.com/DRAC-calculator/DRAC-calculator) to your project's `composer.json` and require the `dev` branch:

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/DRAC-calculator/DRAC-calculator" }
    ],
    "require": {
        "drac-calculator/drac-calculator": "dev-dev"
    }
}
```

Then use the class via the autoloader:

```php
require_once 'vendor/autoload.php';
use Drac\Calculator\Drac;
```

Alternatively, without Composer, include `calculator/Drac.php` directly:

```php
require_once 'calculator/Drac.php';
use Drac\Calculator\Drac;
```

### Version

```php
echo Drac::VERSION; // e.g. "1.3"
```

### Single sample

Keys are `TI:1` through `TI:53` (see `calculator/inputs.php` for the full list and valid values). Optional values can be omitted.

```php
$calc = new Drac([
    'TI:1'  => 'MyProject',
    'TI:2'  => 'Sample-1',
    'TI:3'  => 'Q',
    'TI:4'  => 'Cresswelletal2018',
    'TI:5'  => '3.4',   'TI:6'  => '0.51',
    'TI:7'  => '14.47', 'TI:8'  => '1.69',
    'TI:9'  => '1.2',   'TI:10' => '0.14',
    'TI:11' => '0',     'TI:12' => '0',
    'TI:13' => 'N',
    'TI:31' => 'N',
    'TI:32' => '90',   'TI:33' => '125',
    'TI:34' => 'Brennanetal1991',
    'TI:35' => 'Guerinetal2012-Q',
    'TI:36' => '8',    'TI:37' => '10',
    'TI:38' => 'Bell1979',
    'TI:39' => '0',    'TI:40' => '0',
    'TI:41' => '5',    'TI:42' => '2',
    'TI:43' => '2.22', 'TI:44' => '0.05',
    'TI:45' => '1.8',  'TI:46' => '0.1',
    'TI:47' => '30',   'TI:48' => '70',  'TI:49' => '150',
    'TI:52' => '20',  'TI:53' => '0.2',
]);

if (!$calc->valid()) {
    echo "Invalid inputs\n";
}

$result = $calc->calculate();
// Single-row input returns a flat associative array of all TI:N inputs and TO:XX outputs.

printf("Environmental dose rate: %.3f ± %.3f Gy/ka\n",
    $result['TO:GM'],   // Environmental Dose Rate
    $result['TO:GN']    // errEnvironmental Dose Rate
);
printf("Age: %.3f ± %.3f ka\n",
    $result['TO:GO'],   // Age
    $result['TO:GP']    // errAge
);
```

`calculate()` returns full-precision floats. `toCsv()` rounds outputs to 3 decimal places and prepends the citation header required for published use.

#### Handling invalid inputs

`valid()` validates all fields. If any fail, `errors()` returns `true` and `calculate()` / `toCsv()` will throw a `RuntimeException`. Call `fieldErrors()` to get a structured map of which fields failed and why.

```php
$calc = new Drac(['TI:1' => 'MyProject', 'TI:3' => 'INVALID', /* ... */]);

if ($calc->errors()) {
    $errors = $calc->fieldErrors();
    // e.g. ['TI:3' => 'Found "INVALID": The mineral used for dating must be ...']
    foreach ($errors as $field => $message) {
        echo "$field: $message\n";
    }
}
```


### Generating citation-wrapped CSV

```php
$csv = $calc->toCsv(); // string suitable for file_put_contents or echo with CSV headers
```

## License

DRAC Calculator is licensed under GPLv3. Further details can be found in the file LICENSE.
