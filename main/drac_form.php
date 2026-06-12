<?php
require_once __DIR__ . '/../calculator/drac.php';

class DracForm {

    public bool $submitted;
    private array $values;
    private ?string $parseErrors = null;
    private ?Drac $drac = null;

    public function __construct(array $params) {
        $this->submitted = !empty($params);
        $this->values = [
            'name'  => empty($params['name'])  ? '' : trim($params['name']),
            'table' => empty($params['table']) ? '' : trim($params['table']),
        ];
    }

    public function valid(): bool {
        if (!$this->submitted) return false;
        if (empty($this->values['name'])) return false;
        if ($this->_parseErrors() !== '') return false;
        return $this->drac->valid();
    }

    public function errors(): bool {
        return $this->submitted && !$this->valid();
    }

    public function errorMessage(): string {
        return $this->valid() ? '' : 'ERROR: Some fields were invalid.';
    }

    public function value(string $field) {
        return $this->values[$field] ?? null;
    }

    public function formFieldValid(string $field): bool {
        if (!$this->submitted) return true;
        if ($field === 'name') return !empty($this->values['name']);
        if ($this->_parseErrors() !== '') return false;
        if ($field === 'table') return $this->drac->valid();
        return !$this->drac->fieldHasErrors($field);
    }

    public function formFieldErrorMessage(string $field): string {
        if ($field === 'name') return 'Name must not be blank.';
        if ($field === 'table') {
            $parseErrors = $this->_parseErrors();
            return $parseErrors !== '' ? $parseErrors : $this->drac->validationErrorDetails();
        }
        return drac_inputs()[$field]['description'] ?? '';
    }

    public function toCsv(): string {
        if (!$this->valid()) {
            throw new \RuntimeException('Cannot generate CSV: form is not valid.');
        }
        return $this->drac->toCsv();
    }

    public function outputFileName(): string {
        return str_replace(' ', '_', trim($this->values['name'])) . '_' . time() . '_DRACv' . Drac::VERSION . '.csv';
    }

    private function _parseErrors(): string {
        if ($this->parseErrors !== null) return $this->parseErrors;

        $text = $this->values['table'];
        if (empty($text)) {
            return $this->parseErrors = "Data table must not be blank.\n";
        }

        $text = str_replace("\n\r", "\n", $text);
        $text = preg_replace("/[ \t]+/", " ", $text);
        $row_strings = explode("\n", $text);
        $num_columns = drac_input_columns_count();
        $errors = '';
        $rows = [];

        foreach ($row_strings as $i => $row_str) {
            $cols = explode(" ", trim($row_str));
            if (count($cols) !== $num_columns) {
                $errors .= "Row " . ($i + 1) . ": Expected " . $num_columns . " columns, found " . count($cols) . ".\n";
            }
            $row = [];
            for ($j = 0; $j < min(count($cols), $num_columns); $j++) {
                $row['TI:' . ($j + 1)] = trim($cols[$j]);
            }
            $rows[] = $row;
        }

        if ($errors === '') {
            $this->drac = new Drac($rows);
        }

        return $this->parseErrors = $errors;
    }
}
