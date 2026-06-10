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
* `/calculator/drac.php` - Calculator setup code
* `/calculator/lookup_tables.php` - Lookup table data


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
./vendor/bin/phpunit test/drac_test.php      # calculator unit tests
./vendor/bin/phpunit test/helpers_test.php   # validation helper tests
./vendor/bin/phpunit test/integration_test.php  # HTTP integration tests (requires php -S)
```

## License

DRAC Calculator is licensed under GPLv3. Further details can be found in the file LICENSE.
