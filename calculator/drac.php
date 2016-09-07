<?php
require(DRAC_ROOT . '/calculator/inputs.php');
require(DRAC_ROOT . '/calculator/outputs.php');
require(DRAC_ROOT . '/calculator/csv_outputs.php');

class Drac {

    public $values;
    public $submitted;

    function __construct($globals, $params) {
       $this->submitted = (count($params) > 0);
       $this->values = array();
       $this->values['name'] = empty($params['name']) ? '' : trim($params['name']);
       $this->values['table'] = empty($params['table']) ? '' : trim($params['table']);
       $this->data = null;

       $filename =  str_replace(' ', '_', trim( $this->values['name'] ));
       $this->output_file_name =  $filename . '_' . time() . '_DRACv' . DRAC_VERSION .'.csv';
    }

    public function value($field) {
        return $this->values[$field];
    }

    public function fieldValid($field) {
        if(!$this->submitted) { return true; }
        if($field == 'table') {
            return $this->validate_table_error_messages($this->values[$field]) == "";
        }
        if($field == 'name') {
            return !empty($this->values[$field]);
        }
        $field_info = $this->drac_inputs($field);
        $validate_func = $field_info['validate'];
        return $validate_func($this->values[$field]);
    }

    public function fieldErrorMessage($field) {
        if($field == 'table') {
            return $this->validate_table_error_messages($this->value($field));
        }
        if($field == 'name') {
            return 'Name must not be blank.';
        }
        $field_info = $this->drac_inputs($field);
        return $field_info['error_message'];
    }

    public function errorMessage() {
        return $this->valid() ? "" : "ERROR: Some fields were invalid.";
    }

    public function valid() {
        $output = $this->submitted;

        $validate_func = function($val){ return !empty($val); };
        $output = $output && $validate_func($this->values['name']);

        $output = $output && ($this->validate_table_error_messages($this->values['table']) == "");

        return $output;
    }

    public function errors() {
        return $this->submitted && !$this->valid();
    }


    public function run_calc() {
        if( empty( $this->data ) ) {
            assert( $this->valid() );
        }
        assert( !empty( $this->data ) );

        $output = "";

        $output .= "DRAC " . DRAC_VERSION . " output\n";
        $output .= "\n";
        $output .= "Full details of the inputs required for a DRAC dose rate calculation and the calculation process can be found in the paper and the DRAC website (www.aber.ac.uk/alrl/drac).\n";
        $output .= "\n";
        $output .= "\"Please cite all uses of DRAC, including the version number, as Durcan, J.A., King, G.E., and Duller, G.A.T., 2015. DRAC: Dose rate and age calculator for trapped charge dating. Quaternary Geochronology, 28, 54-61. Corresponding authors: Julie Durcan (julie.durcan@ouce.ox.ac.uk) and Georgina King (georgina.king@uni-koeln.de).\"\n";
        $output .= "\n";
        $output .= "DRAC Highlights,,,,,,,,,,,,,,,,,,,,,,,,,,,DRAC Inputs,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,DRAC Outputs\n";
        $output .= "\n";

        foreach( drac_csv_outputs() as $t ) {
            $output .= $t . ',';
        }
        $output .= "\n";

        $drac_inputs = drac_inputs();
        $drac_outputs = drac_outputs();

        foreach( drac_csv_outputs() as $t ) {
            if( $t == "" ) {
                $value = "";
            } else {
                $is_output = (strpos( $t, 'TI:', 0 ) === false);
                if( $is_output ) {
                    $value = $drac_outputs[$t]['name_ascii'];
                } else {
                    $value = $drac_inputs[$t]['name_ascii'];
                }
            }
            $output .= $value . ',';
        }
        $output .= "\n";

        foreach( $this->data as $input_row ) {
            drac_clear_value_cache();

            foreach( drac_csv_outputs() as $t ) {

                if( $t == "" ) {
                    $value = "";
                } else {
                    $is_output = (strpos( $t, 'TI:', 0 ) === false);

                    $value = VALUE( $input_row, $t );

                    // round values
                    if( $is_output && (floatval( $value ) == $value) && ($value != 0) ) {
                        $value = round( $value, 3 );
                    }
                }

                $output .= $value . ',';
            }

            $output .= "\n";
        }

        return $output;
    }

    private function validate_table_error_messages($text) {
        $errors = "";
        if(empty($text)) { $errors .= "Data table must not be blank.\n"; }

        $text = str_replace("\n\r", "\n", $text);
        $text = preg_replace("/[ \t]+/", " ", $text);
        $rows = explode("\n", $text);

        $this->data = array();

        for ($i = 0; $i < count($rows); $i++) {
            $row = trim($rows[$i]);

            $num_columns = drac_input_columns_count();

            $cols = explode(" ", $row);
            if(count($cols) != $num_columns) {
                $errors .= "Row " . ($i + 1) . ": Expected " . $num_columns . " columns, found " . count($cols) . ".\n";
            }

            $data_row = array();

            for ($j = 0; $j < min(count($cols), $num_columns); $j++) {
                $col = trim($cols[$j]);

                $ti = 'TI:' . ($j + 1);

                $data_row[$ti] = $col;

                $properites = $this->drac_inputs($ti);
                $validate_func = $properites['validate'];
                $custom_errors = "";

                if( !valid_blank_input($properites, $col) && !$validate_func($cols[$j], $cols, $custom_errors) ) {
                    $errors .= 'Row ' . ($i + 1) . ', Column ' . ($j + 1) . ' (' . $ti . ' ' . $properites['name'] . ') Found "' . $col . '": ' . $properites['description'] . " " . $custom_errors . "\n";
                }

                if( $properites['type'] == 'float' && !valid_blank_input($properites, $col) ) {
                    $col = floatval($col);
                }
                $data_row[$ti] = $col;
            }

            array_push( $this->data, $data_row );
        }
        // print_r($errors);
        return $errors;
    }

    private function drac_inputs($item) {
        $inputs = drac_inputs();
        return $inputs[$item];
    }
}
