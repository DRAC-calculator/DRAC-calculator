<?php
require_once __DIR__ . '/version.php';
require_once __DIR__ . '/inputs.php';
require_once __DIR__ . '/outputs.php';
require_once __DIR__ . '/csv_outputs.php';

class Drac {

    const VERSION = DRAC_VERSION;

    public array $data;
    private ?string $validationErrors = null;
    private array $rowFieldErrors = [];

    public function __construct(array $input) {
        if (isset($input['TI:1'])) {
            $this->data = [$this->_normalizeKeyedRow($input)];
        } else {
            $this->data = array_map([$this, '_normalizeKeyedRow'], array_values($input));
        }
    }

    public static function inputs(): array {
        return drac_inputs();
    }

    public function valid(): bool {
        return $this->_validateKeyedErrors() === '';
    }

    public function errors(): bool {
        return !$this->valid();
    }

    public function fieldErrors(): array {
        $this->_validateKeyedErrors();
        return count($this->rowFieldErrors) === 1
            ? $this->rowFieldErrors[0]
            : $this->rowFieldErrors;
    }

    public function fieldHasErrors(string $field): bool {
        $this->_validateKeyedErrors();
        foreach ($this->rowFieldErrors as $rowErrors) {
            if (isset($rowErrors[$field])) return true;
        }
        return false;
    }

    public function validationErrorDetails(): string {
        return $this->_validateKeyedErrors();
    }

    public function calculate(): array {
        if (!$this->valid()) {
            throw new \RuntimeException('Cannot run calculation: inputs are invalid.');
        }
        if (empty($this->data)) {
            throw new \RuntimeException('Cannot run calculation: no data rows.');
        }

        $rows = array_map([$this, '_computeRow'], $this->data);
        return count($rows) === 1 ? $rows[0] : $rows;
    }

    public function toCsv(): string {
        if (!$this->valid()) {
            throw new \RuntimeException('Cannot run calculation: inputs are invalid.');
        }
        if (empty($this->data)) {
            throw new \RuntimeException('Cannot run calculation: no data rows.');
        }

        $output = '';

        $output .= "DRAC " . self::VERSION . "\n";
        $output .= "\n";
        $output .= "Full details of the inputs required for a DRAC dose rate calculation and the calculation process can be found in the paper and the DRAC website (www.aber.ac.uk/alrl/drac).\n";
        $output .= "\n";
        $output .= "\"Please cite all uses of DRAC, including the version number, as Durcan, J.A., King, G.E., and Duller, G.A.T., 2015. DRAC: Dose rate and age calculator for trapped charge dating. Quaternary Geochronology, 28, 54-61. Contact details for authors: Julie Durcan (julie.durcan@ouce.ox.ac.uk), Georgina King (georgina.king@unil.ch) and Geoff Duller (ggd@aber.ac.uk).\"\n";
        $output .= "\n";
        $output .= "DRAC Highlights,,,,,,,,,,,,,,,,,,,,,,,,,,,DRAC Inputs,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,DRAC Outputs\n";
        $output .= "\n";

        foreach (drac_csv_outputs() as $t) {
            $output .= $t . ',';
        }
        $output .= "\n";

        $drac_inputs = drac_inputs();
        $drac_outputs = drac_outputs();

        foreach (drac_csv_outputs() as $t) {
            if ($t === '') {
                $value = '';
            } else {
                $is_output = strpos($t, 'TI:', 0) === false;
                $value = $is_output ? $drac_outputs[$t]['name_ascii'] : $drac_inputs[$t]['name_ascii'];
            }
            $output .= $value . ',';
        }
        $output .= "\n";

        foreach ($this->data as $input_row) {
            $computed = $this->_computeRow($input_row);

            foreach (drac_csv_outputs() as $t) {
                if ($t === '') {
                    $value = '';
                } else {
                    $is_output = strpos($t, 'TI:', 0) === false;
                    $value = $computed[$t];
                    if ($is_output && (floatval($value) == $value) && ($value != 0)) {
                        $value = round($value, 3);
                    }
                }
                $output .= $value . ',';
            }
            $output .= "\n";
        }

        return $output;
    }

    public function outputFileName(): string {
        $name = $this->data[0]['TI:1'] ?? '';
        return str_replace(' ', '_', trim($name)) . '_' . time() . '_DRACv' . self::VERSION . '.csv';
    }

    private function _normalizeKeyedRow(array $row): array {
        $normalized = [];
        foreach (drac_inputs() as $key => $props) {
            $val = isset($row[$key]) ? trim((string)$row[$key]) : 'X';
            if ($val === '') { $val = 'X'; }
            if ($props['type'] === 'float' && !valid_blank_input($props, $val)) {
                $val = floatval($val);
            }
            $normalized[$key] = $val;
        }
        return $normalized;
    }

    private function _validateKeyedErrors(): string {
        if ($this->validationErrors !== null) {
            return $this->validationErrors;
        }

        $errors = '';
        $n_cols = drac_input_columns_count();

        foreach ($this->data as $i => $row) {
            $cols = [];
            for ($j = 1; $j <= $n_cols; $j++) {
                $cols[] = $row["TI:$j"];
            }
            $this->rowFieldErrors[$i] = [];
            foreach (drac_inputs() as $key => $props) {
                $val = $row[$key];
                $custom_errors = '';
                if (!valid_blank_input($props, $val) && !($props['validate'])($val, $cols, $custom_errors)) {
                    $msg = 'Found "' . $val . '": ' . $props['description'] . ($custom_errors !== '' ? ' ' . $custom_errors : '');
                    $this->rowFieldErrors[$i][$key] = $msg;
                    $errors .= 'Row ' . ($i + 1) . ', ' . $key . ' (' . $props['name'] . ') ' . $msg . "\n";
                }
            }
        }

        $this->validationErrors = $errors;
        return $errors;
    }

    private function _computeRow(array $input_row): array {
        drac_clear_value_cache();
        $row = $input_row;
        foreach (drac_outputs() as $key => $_) {
            $row[$key] = VALUE($input_row, $key);
        }
        return $row;
    }
}
