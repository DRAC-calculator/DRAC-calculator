<?php
require(DRAC_ROOT . '/calculator/output_helpers.php');

function drac_outputs() {
    // Common descriptions used across multiple items
    $external = 'The calculated external dose rates from the provided radionuclide concentrations and selected conversion factors.';
    $internal = 'The calculated internal dose rates from the provided radionuclide concentrations and selected conversion factors.';
    $scaling_factor = 'The scaling factors of Aitken (1985) used to correct gamma dose rates of samples taken from within 0.3 m of the ground surface.';
    $depth_scaled = 'The gamma dose rates and uncertainties corrected for shallow depth (<0.3 m).';
    $infinite_matrix = 'The infinite matrix external and internal dose rates. Calculated either from the radionuclide concentrations and conversion factors or the user defined dose rates. These values are used as the basis for all subsequent calculations.';
    $alpha_grain_size_attn = 'The alpha grain size attenuation factors and uncertainties calculated from the selected dataset and for the specified grain size range. The value is calculated as the average of the attenuation factors for the two grain size extremes and the uncertainty is 50% of the range. If dose rates are calculated using radionuclide concentrations, they are attenuated individually. If a dose rate is provided by the user, it is attenuated using the combined attenuation factor.';
    $alpha_grain_size_abs = 'The alpha grain size absorption factors and uncertainties calculated from the selected dataset and for the specified grain size range. The value is calculated as the average of the attenuation factors for the two grain size extremes and the uncertainty is 50% of the range.';
    $alpha_grain_size_corrected = 'The external and internal alpha dose rates corrected for grain size attenuation and absorption.';
    $beta_grain_size_attn = 'The beta grain size attenuation factors and uncertainties calculated from the selected dataset and for the specified grain size range. The value is calculated as the average of the attenuation factors for the two grain size extremes and the uncertainty is 50% of the range. If dose rates are calculated using radionuclide concentrations, they are attenuated individually. If a dose rate is provided by the user, it is attenuated using the combined attenuation factor based on the ratio of Mejdahl (1979).';
    $beta_grain_size_abs = 'The beta grain size absorption factors and uncertainties calculated from the selected dataset and for the specified grain size range. The value is calculated as the average of the attenuation factors for the two grain size extremes and the uncertainty is 50% of the range.';
    $beta_grain_size_corrected = 'The external and internal beta dose rates corrected for grain size attenuation and absorption.';
    $alpha_etch_attn = 'The alpha etch depth attenuation factors calculated from the Bell (1980) dataset for the specified etch depth. The value is calculated as the average of the attenuation factors for the etch depth extremes and the uncertainty is 50% of the range. If dose rates are calculated using radionuclide concentrations, they are attenuated individually. If a dose rate is provided by the user, it is attenuated using the combined attenuation factor.';
    $alpha_etch_abs = 'Alpha etch depth absorption factors calculated from the Bell (1980) dataset for the specified etch depth. The value is calculated as the average of the attenuation factors for the etch depth extremes and the uncertainty is 50% of the range.';
    $alpha_etch_corrected = 'The external and internal alpha dose rates corrected for etch depth attenuation and absorption.';
    $beta_etch_attn = 'The beta etch depth attenuation factors calculated from the selected dataset. The value is calculated as the average of the attenuation factors for the etch depth extremes and the uncertainty is 50% of the range. The uncertainty is ±2%. If dose rates are calculated using radionuclide concentrations, they are attenuated individually. If a dose rate is provided by the user, it is attenuated using the combined attenuation factor.';
    $beta_etch_abs = 'The beta etch depth absorption factors calculated from the selected dataset. The value is calculated as the average of the attenuation factors for the etch depth extremes and the uncertainty is 50% of the range.';
    $beta_etch_corrected = 'The external and internal beta dose rates corrected for etch depth attenuation and absorption.';
    $a_value_corrected = 'The external and internal alpha dose rates corrected for alpha track efficiency using the provided a-value.';
    $external_dry = 'The external dose rates corrected for grain size and etch depth attenuation.';
    $water_corrected = 'The water attenuated external alpha, beta and gamma dose rates.';
    $internal_dry = 'The attenuated internal alpha and beta dose rates.';
    $drac_int_ext_dose_rate = 'DRAC calculated external and internal dose rates.';

    return array(
        'TO:A' =>  array(
            'name' => 'External U Ḋα (Gy.ka-1)',
            'name_ascii' => 'External U alphadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Uα', 'TI:5' );  },
        ),
        'TO:B' =>  array(
            'name' => 'External δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'External errU alphadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Uα', 'TI:5', 'TI:6' );  },
        ),
        'TO:C' =>  array(
            'name' => 'External U Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External U betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Uβ', 'TI:5' );  },
        ),
        'TO:D' =>  array(
            'name' => 'External δU Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External errU betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Uβ', 'TI:5', 'TI:6' );  },
        ),
        'TO:E' =>  array(
            'name' => 'External U Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External U gammadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Uγ', 'TI:5' );  },
        ),
        'TO:F' =>  array(
            'name' => 'External δU Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External errU gammadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Uγ', 'TI:5', 'TI:6' );  },
        ),
        'TO:G' =>  array(
            'name' => 'External Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'External Th alphadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Thα', 'TI:7' );  },
        ),
        'TO:H' =>  array(
            'name' => 'External δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'External errTh alphadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Thα', 'TI:7', 'TI:8' );  },
        ),
        'TO:I' =>  array(
            'name' => 'External Th Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External Th betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Thβ', 'TI:7' );  },
        ),
        'TO:J' =>  array(
            'name' => 'External δTh Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External errTh betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Thβ', 'TI:7', 'TI:8' );  },
        ),
        'TO:K' =>  array(
            'name' => 'External Th Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External Th gammadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Thγ', 'TI:7' );  },
        ),
        'TO:L' =>  array(
            'name' => 'External δTh Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External errTh gammadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Thγ', 'TI:7', 'TI:8' );  },
        ),
        'TO:M' =>  array(
            'name' => 'External K Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External K betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Kβ', 'TI:9' );  },
        ),
        'TO:N' =>  array(
            'name' => 'External δK Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External errK betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Kβ', 'TI:9', 'TI:10' );  },
        ),
        'TO:O' =>  array(
            'name' => 'External K Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External K gammadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert( $i, 'Kγ', 'TI:9' );  },
        ),
        'TO:P' =>  array(
            'name' => 'External δK Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External errK gammadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){  return lt1_convert_d( $i, 'Kγ', 'TI:9', 'TI:10' );  },
        ),
        'TO:Q' =>  array(
            'name' => 'External Rb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External Rb betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i) {
                if( strtoupper( $i['TI:13'] ) == 'Y' ) {
                    if ( $i['TI:9'] == 0 ) {
                      return 0;
                    } else {
                      return (-9.17 + (38.13 * VALUE( $i, 'TI:9' ))) * LT1( $i['TI:4'], 'Rbβ' );
                    }
                } else if( !valid_blank( $i['TI:11'] ) && !valid_blank( $i['TI:12'] ) ) {
                    return lt1_convert( $i, 'Rbβ', 'TI:11' );
                } else {
                    return 0;
                }
            },
        ),
        'TO:R' =>  array(
            'name' => 'External δRb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External errRb betadoserate (Gy.ka-1)',
            'description' => $external,
            'value' => function($i){
                if ( VALUE( $i, 'TO:Q' ) == 0 ) {
                  return 0;
                } else if( strtoupper( $i['TI:13'] ) == 'Y' ) {
                    return lt1_convert_d( $i, 'Rbβ', 'TI:9', 'TI:10', VALUE( $i, 'TO:Q' ));
                } else if( !valid_blank( $i['TI:11'] ) && !valid_blank( $i['TI:12'] ) ) {
                    return lt1_convert_d( $i, 'Rbβ', 'TI:11', 'TI:12', VALUE( $i, 'TO:Q' ));
                } else {
                    return 0;
                }
            },
        ),
        'TO:S' =>  array(
            'name' => 'Internal U Ḋα (Gy.ka-1)',
            'name_ascii' => 'Internal U alphadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert( $i, 'Uα', 'TI:14' );  },
        ),
        'TO:T' =>  array(
            'name' => 'Internal δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'Internal errU alphadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert_d( $i, 'Uα', 'TI:14', 'TI:15' );  },
        ),
        'TO:U' =>  array(
            'name' => 'Internal U Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal U betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert( $i, 'Uβ', 'TI:14' );  },
        ),
        'TO:V' =>  array(
            'name' => 'Internal δU Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal errU betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert_d( $i, 'Uβ', 'TI:14', 'TI:15' );  },
        ),
        'TO:W' =>  array(
            'name' => 'Internal Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'Internal Th alphadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert( $i, 'Thα', 'TI:16' );  },
        ),
        'TO:X' =>  array(
            'name' => 'Internal δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'Internal errTh alphadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert_d( $i, 'Thα', 'TI:16', 'TI:17' );  },
        ),
        'TO:Y' =>  array(
            'name' => 'Internal Th Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal Th betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert( $i, 'Thβ', 'TI:16' );  },
        ),
        'TO:Z' =>  array(
            'name' => 'Internal δTh Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal errTh betadoserate (Gy.ka-1) ',
            'description' => $internal,
            'value' => function($i){  return lt1_convert_d( $i, 'Thβ', 'TI:16', 'TI:17' );  },
        ),
        'TO:AA' =>  array(
            'name' => 'Internal K Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal K betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert( $i, 'Kβ', 'TI:18' );  },
        ),
        'TO:AB' =>  array(
            'name' => 'Internal δK Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal errK betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){  return lt1_convert_d( $i, 'Kβ', 'TI:18', 'TI:19' );  },
        ),
        'TO:AC' =>  array(
            'name' => 'Internal Rb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal Rb betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i) {
                if( strtoupper( $i['TI:22'] ) == 'Y' ) {
                  if ( $i['TI:18'] == 0 ) {
                    return 0;
                  } else {
                    return (-9.17 + (38.13 * VALUE( $i, 'TI:18' ))) * LT1( $i['TI:4'], 'Rbβ' );
                  }
                } else if( !valid_blank( $i['TI:20'] ) && !valid_blank( $i['TI:21'] ) ) {
                    return lt1_convert( $i, 'Rbβ', 'TI:20' );
                } else {
                    return 0;
                }
            },
        ),
        'TO:AD' =>  array(
            'name' => 'Internal δRb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal errRb betadoserate (Gy.ka-1)',
            'description' => $internal,
            'value' => function($i){
                if ( VALUE( $i, 'TO:AC' ) == 0 ) {
                    return 0;
                } else if( !valid_blank( $i['TI:20'] ) && !valid_blank( $i['TI:21'] ) ) {
                    return lt1_convert_d( $i, 'Rbβ', 'TI:20', 'TI:21', VALUE( $i, 'TO:AC' ) );
                }
                else if( strtoupper( $i['TI:22'] ) == 'Y' ) {
                    return lt1_convert_d( $i, 'Rbβ', 'TI:18', 'TI:19', VALUE( $i, 'TO:AC' ) );
                } else {
                    return 0;
                }
            },
        ),
        'TO:AE' =>  array(
            'name' => 'U Ḋγ scaling factor',
            'name_ascii' => 'U gammadoserate scaling factor',
            'description' => $scaling_factor,
            'value' => function($i){  return lt7_factor( $i, 'U' );  },
        ),
        'TO:AF' =>  array(
            'name' => 'Th Ḋγ scaling factor',
            'name_ascii' => 'Th gammadoserate scaling factor',
            'description' => $scaling_factor,
            'value' => function($i){  return lt7_factor( $i, 'Th' );  },
        ),
        'TO:AG' =>  array(
            'name' => 'K Ḋγ scaling factor',
            'name_ascii' => 'K gammadoserate scaling factor',
            'description' => $scaling_factor,
            'value' => function($i){  return lt7_factor( $i, 'K' );  },
        ),
        'TO:AH' =>  array(
            'name' => 'Average Ḋγ scaling factor',
            'name_ascii' => 'Average gammadoserate scaling factor',
            'description' => $scaling_factor,
            'value' => function($i){  return lt7_factor( $i, 'weighted average' );  },
        ),
        'TO:AI' =>  array(
            'name' => 'Depth scaled U Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled U gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AE' ) * VALUE( $i, 'TO:E' );  },
        ),
        'TO:AJ' =>  array(
            'name' => 'Depth scaled δU Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled errU gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AE' ) * VALUE( $i, 'TO:F' );  },
        ),
        'TO:AK' =>  array(
            'name' => 'Depth scaled Th Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled Th gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AF' ) * VALUE( $i, 'TO:K' );  },
        ),
        'TO:AL' =>  array(
            'name' => 'Depth scaled δTh Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled errTh gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AF' ) * VALUE( $i, 'TO:L' );  },
        ),
        'TO:AM' =>  array(
            'name' => 'Depth scaled K Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled K gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AG' ) * VALUE( $i, 'TO:O' );  },
        ),
        'TO:AN' =>  array(
            'name' => 'Depth scaled δK Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled errK gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AG' ) * VALUE( $i, 'TO:P' );  },
        ),
        'TO:AO' =>  array(
            'name' => 'Depth scaled user external Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled user external gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AH' ) * VALUE( $i, 'TO:AU' );  },
        ),
        'TO:AP' =>  array(
            'name' => 'Depth scaled δuser external Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Depth scaled erruser external gammadoserate (Gy.ka-1)',
            'description' => $depth_scaled,
            'value' => function($i){  return VALUE( $i, 'TO:AH' ) * VALUE( $i, 'TO:AV' );  },
        ),
        'TO:AQ' =>  array(
            'name' => 'External infinite matrix Ḋα (Gy.ka-1)',
            'name_ascii' => 'External infinite matrix alphadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                if ( !valid_blank( $i['TI:23'] ) && $i['TI:23'] != 0 ) {
                    return $i['TI:23'];
                } else {
                    return array_sum( VALUES( $i, 'TO:A','TO:G' ) );
                }
            },
        ),
        'TO:AR' =>  array(
            'name' => 'External infinite matrix δḊα (Gy.ka-1)',
            'name_ascii' => 'External infinite matrix erralphadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                if ( !valid_blank( $i['TI:24'] ) && $i['TI:24'] != 0 ) {
                    return $i['TI:24'];
                } else {
                    return sqrt( array_sum( array_map( function($v){ return pow( $v, 2); }, VALUES( $i, 'TO:B','TO:H' ) ) ) );
                }
            },
        ),
        'TO:AS' =>  array(
            'name' => 'External infinite matrix Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External infinite matrix betadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                if ( !valid_blank( $i['TI:25'] ) && $i['TI:25'] != 0 ) {
                    return $i['TI:25'];
                } else {
                    return array_sum( VALUES( $i, 'TO:C','TO:I','TO:M','TO:Q' ) );
                }
            },
        ),
        'TO:AT' =>  array(
            'name' => 'External infinite matrix δḊβ (Gy.ka-1)',
            'name_ascii' => 'External infinite matrix errbetadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                if ( !valid_blank( $i['TI:26'] ) && $i['TI:26'] != 0 ) {
                    return $i['TI:26'];
                } else {
                    return sqrt( array_sum( array_map( function($v){ return pow( $v, 2); }, VALUES( $i, 'TO:D','TO:J','TO:N','TO:R' ) ) ) );
                }
            },
        ),
        'TO:AU' =>  array(
            'name' => 'External infinite matrix Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External infinite matrix gammadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                if ( !valid_blank( $i['TI:27'] ) && $i['TI:27'] != 0 ) {
                    return $i['TI:27'];
                } else {
                    return array_sum( VALUES( $i, 'TO:E','TO:K','TO:O' ) );
                }
            },
        ),
        'TO:AV' =>  array(
            'name' => 'External infinite matrix δḊγ (Gy.ka-1)',
            'name_ascii' => 'External infinite matrix errgammadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                if ( !valid_blank( $i['TI:28'] ) && $i['TI:28'] != 0 ) {
                    return $i['TI:28'];
                } else {
                    return sqrt( array_sum( array_map( function($v){ return pow( $v, 2); }, VALUES( $i, 'TO:F','TO:L','TO:P' ) ) ) );
                }
            },
        ),
        'TO:AW' =>  array(
            'name' => 'Internal infinite matrix Ḋα (Gy.ka-1)',
            'name_ascii' => 'Internal infinite matrix alphadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                return array_sum( VALUES( $i, 'TO:S','TO:W' ) );
            },
        ),
        'TO:AX' =>  array(
            'name' => 'Internal infinite matrix δḊα (Gy.ka-1)',
            'name_ascii' => 'Internal infinite matrix erralphadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                return sqrt( array_sum( array_map( function($v){ return pow( $v, 2); }, VALUES( $i, 'TO:T','TO:X' ) ) ) );
            },
        ),
        'TO:AY' =>  array(
            'name' => 'Internal infinite matrix Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal infinite matrix betadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                return array_sum( VALUES( $i, 'TO:U','TO:Y','TO:AA','TO:AC' ) );
            },
        ),
        'TO:AZ' =>  array(
            'name' => 'Internal infinite matrix δḊβ (Gy.ka-1)',
            'name_ascii' => 'Internal infinite matrix errbetadoserate (Gy.ka-1)',
            'description' => $infinite_matrix,
            'value' => function($i){
                return sqrt( array_sum( array_map( function($v){ return pow( $v, 2); }, VALUES( $i, 'TO:V','TO:Z','TO:AB','TO:AD' ) ) ) );
            },
        ),
        'TO:BA' =>  array(
            'name' => 'U Alpha grain size attenuation factor',
            'name_ascii' => 'U Alpha grain size attenuation factor',
            'description' => $alpha_grain_size_attn,
            'value' => function($i){  return lt2_factor( $i, 'Uranium 1-φ(D)' );  },
        ),
        'TO:BB' =>  array(
            'name' => 'δU Alpha grain size attenuation factor',
            'name_ascii' => 'errU Alpha grain size attenuation factor',
            'description' => $alpha_grain_size_attn,
            'value' => function($i){  return lt2_factor_d( $i, 'Uranium 1-φ(D)' );  },
        ),
        'TO:BC' =>  array(
            'name' => 'Th Alpha grain size attenuation factor',
            'name_ascii' => 'Th Alpha grain size attenuation factor',
            'description' => $alpha_grain_size_attn,
            'value' => function($i){  return lt2_factor( $i, 'Thorium 1-φ(D)' );  },
        ),
        'TO:BD' =>  array(
            'name' => 'δTh Alpha grain size attenuation factor',
            'name_ascii' => 'errTh Alpha grain size attenuation factor',
            'description' => $alpha_grain_size_attn,
            'value' => function($i){  return lt2_factor_d( $i, 'Thorium 1-φ(D)' );  },
        ),
        'TO:BE' =>  array(
            'name' => 'Combined alpha grain size attenuation factor',
            'name_ascii' => 'Combined alpha grain size attenuation factor',
            'description' => $alpha_grain_size_attn,
            'value' => function($i){  return lt2_factor( $i, 'Combined 1-φ(D)' );  },
        ),
        'TO:BF' =>  array(
            'name' => 'δCombined alpha grain size attenuation factor',
            'name_ascii' => 'errCombined alpha grain size attenuation factor',
            'description' => $alpha_grain_size_attn,
            'value' => function($i){  return lt2_factor_d( $i, 'Combined 1-φ(D)' );  },
        ),
        'TO:BG' =>  array(
            'name' => 'U Alpha grain size absorption factor',
            'name_ascii' => 'U Alpha grain size absorption factor',
            'description' => $alpha_grain_size_abs,
            'value' => function($i){  return lt2_factor( $i, 'Uranium φ(D)' );  },
        ),
        'TO:BH' =>  array(
            'name' => 'δU Alpha grain size absorption factor',
            'name_ascii' => 'errU Alpha grain size absorption factor',
            'description' => $alpha_grain_size_abs,
            'value' => function($i){  return lt2_factor_d( $i, 'Uranium φ(D)' );  },
        ),
        'TO:BI' =>  array(
            'name' => 'Th Alpha grain size absorption factor',
            'name_ascii' => 'Th Alpha grain size absorption factor',
            'description' => $alpha_grain_size_abs,
            'value' => function($i){  return lt2_factor( $i, 'Thorium φ(D)' );  },
        ),
        'TO:BJ' =>  array(
            'name' => 'δTh Alpha grain size absorption factor',
            'name_ascii' => 'errTh Alpha grain size absorption factor',
            'description' => $alpha_grain_size_abs,
            'value' => function($i){  return lt2_factor_d( $i, 'Thorium φ(D)' );  },
        ),
        'TO:BK' =>  array(
            'name' => 'Grain size corrected external U Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external U alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BA' ) * VALUE( $i, 'TO:A' );  },
        ),
        'TO:BL' =>  array(
            'name' => 'Grain size corrected external δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external errU alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:BK', 'TO:B', 'TO:A', 'TO:BB', 'TO:BA' );  },
        ),
        'TO:BM' =>  array(
            'name' => 'Grain size corrected external Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external Th alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BC' ) * VALUE( $i, 'TO:G' );  },
        ),
        'TO:BN' =>  array(
            'name' => 'Grain size corrected external δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external errTh alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:BM', 'TO:H', 'TO:G', 'TO:BD', 'TO:BC' );  },
        ),
        'TO:BO' =>  array(
            'name' => 'Grain size corrected user external Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected user external alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BE' ) * $i['TI:23'];  },
        ),
        'TO:BP' =>  array(
            'name' => 'Grain size corrected user external δḊα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected user external erralphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:BO', 'TO:AR', 'TO:AQ', 'TO:BF', 'TO:BE' );  },
        ),
        'TO:BQ' =>  array(
            'name' => 'Grain size corrected internal U Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal U alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BG' ) * VALUE( $i, 'TO:S' );  },
        ),
        'TO:BR' =>  array(
            'name' => 'Grain size corrected internal δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal errU alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:BQ', 'TO:T', 'TO:S', 'TO:BH', 'TO:BG' );  },
        ),
        'TO:BS' =>  array(
            'name' => 'Grain size corrected internal Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal Th alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BI' ) * VALUE( $i, 'TO:W' );  },
        ),
        'TO:BT' =>  array(
            'name' => 'Grain size corrected internal δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal errTh alphadoserate (Gy.ka-1)',
            'description' => $alpha_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:BS', 'TO:X', 'TO:W', 'TO:BJ', 'TO:BI' );  },
        ),
        'TO:BU' =>  array(
            'name' => 'U-Beta grain size attenuation factor',
            'name_ascii' => 'U-Beta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor( $i, 'U 1-φ(D)' );  },
        ),
        'TO:BV' =>  array(
            'name' => 'U-δBeta grain size attenuation factor',
            'name_ascii' => 'U-errBeta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor_d( $i, 'U 1-φ(D)' );  },
        ),
        'TO:BW' =>  array(
            'name' => 'Th-Beta grain size attenuation factor',
            'name_ascii' => 'Th-Beta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor( $i, 'Th 1-φ(D)' );  },
        ),
        'TO:BX' =>  array(
            'name' => 'Th-δBeta grain size attenuation factor',
            'name_ascii' => 'Th-errBeta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor_d( $i, 'Th 1-φ(D)' );  },
        ),
        'TO:BY' =>  array(
            'name' => 'K-Beta grain size attenuation factor',
            'name_ascii' => 'K-Beta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor( $i, 'K 1-φ(D)' );  },
        ),
        'TO:BZ' =>  array(
            'name' => 'K-δBeta grain size attenuation factor',
            'name_ascii' => 'K-errBeta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor_d( $i, 'K 1-φ(D)' );  },
        ),
        'TO:CA' =>  array(
            'name' => 'Rb-Beta grain size attenuation factor',
            'name_ascii' => 'Rb-Beta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor( $i, 'Rb 1-φ(D)', 'readhead2002' );  },
        ),
        'TO:CB' =>  array(
            'name' => 'Rb-δBeta grain size attenuation factor',
            'name_ascii' => 'Rb-errBeta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor_d( $i, 'Rb 1-φ(D)', 'readhead2002' );  },
        ),
        'TO:CC' =>  array(
            'name' => 'Compiled beta grain size attenuation factor',
            'name_ascii' => 'Compiled beta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor( $i, 'Comb 1-φ(D)' );  },
        ),
        'TO:CD' =>  array(
            'name' => 'δCompiled beta grain size attenuation factor',
            'name_ascii' => 'errCompiled beta grain size attenuation factor',
            'description' => $beta_grain_size_attn,
            'value' => function($i){  return lt3_factor_d( $i, 'Comb 1-φ(D)' );  },
        ),
        'TO:CE' =>  array(
            'name' => 'U-Beta grain size absorption factor',
            'name_ascii' => 'U-Beta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor( $i, 'U φ(D)' );  },
        ),
        'TO:CF' =>  array(
            'name' => 'U-δBeta grain size absorption factor',
            'name_ascii' => 'U-errBeta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor_d( $i, 'U φ(D)' );  },
        ),
        'TO:CG' =>  array(
            'name' => 'Th-Beta grain size absorption factor',
            'name_ascii' => 'Th-Beta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor( $i, 'Th φ(D)' );  },
        ),
        'TO:CH' =>  array(
            'name' => 'Th-δBeta grain size absorption factor',
            'name_ascii' => 'Th-errBeta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor_d( $i, 'Th φ(D)' );  },
        ),
        'TO:CI' =>  array(
            'name' => 'K-Beta grain size absorption factor',
            'name_ascii' => 'K-Beta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor( $i, 'K φ(D)' );  },
        ),
        'TO:CJ' =>  array(
            'name' => 'K-δBeta grain size absorption factor',
            'name_ascii' => 'K-errBeta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor_d( $i, 'K φ(D)' );  },
        ),
        'TO:CK' =>  array(
            'name' => 'Rb-Beta grain size absorption factor',
            'name_ascii' => 'Rb-Beta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor( $i, 'Rb φ(D)', 'readhead2002'  ); },
        ),
        'TO:CL' =>  array(
            'name' => 'Rb-δBeta grain size absorption factor',
            'name_ascii' => 'Rb-errBeta grain size absorption factor',
            'description' => $beta_grain_size_abs,
            'value' => function($i){  return lt3_factor_d( $i, 'Rb φ(D)', 'readhead2002'  );  },
        ),
        'TO:CM' =>  array(
            'name' => 'Grain size corrected external U Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external U betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BU' ) *  VALUE( $i, 'TO:C' );  },
        ),
        'TO:CN' =>  array(
            'name' => 'Grain size corrected external δU Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external errU betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:CM', 'TO:BV', 'TO:BU', 'TO:D', 'TO:C' );  },
        ),
        'TO:CO' =>  array(
            'name' => 'Grain size corrected external Th Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external Th betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BW' ) *  VALUE( $i, 'TO:I' );  },
        ),
        'TO:CP' =>  array(
            'name' => 'Grain size corrected external δTh Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external errTh betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:CO', 'TO:BX', 'TO:BW', 'TO:J', 'TO:I' );  },
        ),
        'TO:CQ' =>  array(
            'name' => 'Grain size corrected external K Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external K betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:BY' ) *  VALUE( $i, 'TO:M' );  },
        ),
        'TO:CR' =>  array(
            'name' => 'Grain size corrected external δK Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external errK betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:CQ', 'TO:BZ', 'TO:BY', 'TO:N', 'TO:M' );  },
        ),
        'TO:CS' =>  array(
            'name' => 'Grain size corrected external Rb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external Rb betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:CA' ) *  VALUE( $i, 'TO:Q' );  },
        ),
        'TO:CT' =>  array(
            'name' => 'Grain size corrected external δRb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected external errRb betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:CS', 'TO:CB', 'TO:CA', 'TO:R', 'TO:Q' );  },
        ),
        'TO:CU' =>  array(
            'name' => 'Grain size corrected user external Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected user external betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return $i['TI:25'] *  VALUE( $i, 'TO:CC' );  },
        ),
        'TO:CV' =>  array(
            'name' => 'Grain size corrected user external δḊβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected user external errbetadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){ return factor_sqrt_sum_sqr_ratio( $i, 'TO:CU', 'TO:CD', 'TO:CC', 'TO:AT', 'TO:AS' );  },
        ),
        'TO:CW' =>  array(
            'name' => 'Grain size corrected internal U Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal U betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:CE' ) *  VALUE( $i, 'TO:U' );  },
        ),
        'TO:CX' =>  array(
            'name' => 'Grain size corrected internal δU Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal errU betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){ return factor_sqrt_sum_sqr_ratio( $i, 'TO:CW', 'TO:CF', 'TO:CE', 'TO:V', 'TO:U' );  },
        ),
        'TO:CY' =>  array(
            'name' => 'Grain size corrected internal Th Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal Th betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:CG' ) *  VALUE( $i, 'TO:Y' );  },
        ),
        'TO:CZ' =>  array(
            'name' => 'Grain size corrected internal δTh Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal errTh betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){ return factor_sqrt_sum_sqr_ratio( $i, 'TO:CY', 'TO:CH', 'TO:CG', 'TO:Z', 'TO:Y' );  },
        ),
        'TO:DA' =>  array(
            'name' => 'Grain size corrected internal K Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal K betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:CI' ) *  VALUE( $i, 'TO:AA' );  },
        ),
        'TO:DB' =>  array(
            'name' => 'Grain size corrected internal δK Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal errK betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){ return factor_sqrt_sum_sqr_ratio( $i, 'TO:DA', 'TO:CJ', 'TO:CI', 'TO:AB', 'TO:AA' );  },
        ),
        'TO:DC' =>  array(
            'name' => 'Grain size corrected internal Rb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal Rb betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:CK' ) *  VALUE( $i, 'TO:AC' );  },
        ),
        'TO:DD' =>  array(
            'name' => 'Grain size corrected internal δRb Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Grain size corrected internal errRb betadoserate (Gy.ka-1)',
            'description' => $beta_grain_size_corrected,
            'value' => function($i){ return factor_sqrt_sum_sqr_ratio( $i, 'TO:DC', 'TO:CL', 'TO:CK', 'TO:AD', 'TO:AC' );  },
        ),
        'TO:DE' =>  array(
            'name' => 'U-Alpha etch attenuation factor',
            'name_ascii' => 'U-Alpha etch attenuation factor',
            'description' => $alpha_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'U 1-φ(D)', "bell1980alpha" ) : 1; },
        ),
        'TO:DF' =>  array(
            'name' => 'U-δAlpha Etch attenuation factor',
            'name_ascii' => 'U-errAlpha Etch attenuation factor',
            'description' => $alpha_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'U 1-φ(D)', "bell1980alpha" )  : 0;  },
        ),
        'TO:DG' =>  array(
            'name' => 'Th-Alpha etch attenuation factor',
            'name_ascii' => 'Th-Alpha etch attenuation factor',
            'description' => $alpha_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'Th 1-φ(D)', "bell1980alpha" ) : 1; },
        ),
        'TO:DH' =>  array(
            'name' => 'Th-δAlpha etch attenuation factor',
            'name_ascii' => 'Th-errAlpha etch attenuation factor',
            'description' => $alpha_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'Th 1-φ(D)', "bell1980alpha" )  : 0;  },
        ),
        'TO:DI' =>  array(
            'name' => 'Compiled alpha etch attenuation factor',
            'name_ascii' => 'Compiled alpha etch attenuation factor',
            'description' => $alpha_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'Combined 1-φ(D)', "bell1980alpha" ) : 1; },
        ),
        'TO:DJ' =>  array(
            'name' => 'δCompiled alpha etch attenuation factor',
            'name_ascii' => 'errCompiled alpha etch attenuation factor',
            'description' => $alpha_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'Combined 1-φ(D)', "bell1980alpha" )  : 0;  },
        ),
        'TO:DK' =>  array(
            'name' => 'U-Alpha etch absorption factor',
            'name_ascii' => 'U-Alpha etch absorption factor',
            'description' => $alpha_etch_abs,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'U φ(D)', "bell1980alpha" ) : 1; },
        ),
        'TO:DL' =>  array(
            'name' => 'U-δAlpha Etch absorption factor',
            'name_ascii' => 'U-errAlpha Etch absorption factor',
            'description' => $alpha_etch_abs,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'U φ(D)', "bell1980alpha" )  : 0;  },
        ),
        'TO:DM' =>  array(
            'name' => 'Th-Alpha etch absorption factor',
            'name_ascii' => 'Th-Alpha etch absorption factor',
            'description' => $alpha_etch_abs,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'Th φ(D)', "bell1980alpha" ) : 1; },
        ),
        'TO:DN' =>  array(
            'name' => 'Th-δAlpha etch absorption factor',
            'name_ascii' => 'Th-errAlpha etch absorption factor',
            'description' => $alpha_etch_abs,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'Th φ(D)', "bell1980alpha" )  : 0;  },
        ),
        'TO:DO' =>  array(
            'name' => 'Etch corrected external U Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external U alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:DE' ) * VALUE( $i, 'TO:BK' );  },
        ),
        'TO:DP' =>  array(
            'name' => 'Etch corrected external δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external errU alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:DO', 'TO:DF', 'TO:DE', 'TO:BL', 'TO:BK' );  },
        ),
        'TO:DQ' =>  array(
            'name' => 'Etch corrected external Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external Th alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:DG' ) * VALUE( $i, 'TO:BM' );  },
        ),
        'TO:DR' =>  array(
            'name' => 'Etch corrected external δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external errTh alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:DQ', 'TO:DH', 'TO:DG', 'TO:BN', 'TO:BM' );  },
        ),
        'TO:DS' =>  array(
            'name' => 'Etch corrected user external Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected user external alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:DI' ) * VALUE( $i, 'TO:BO' );  },
        ),
        'TO:DT' =>  array(
            'name' => 'Etch corrected user external δḊα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected user external erralphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:BO' ) == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:DS', 'TO:BP', 'TO:BO', 'TO:DJ', 'TO:DI' );
                }
            },
        ),
        'TO:DU' =>  array(
            'name' => 'Etch corrected internal U Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal U alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){
                if( $i['TI:36'] == 0 ) {
                    return VALUE( $i, 'TO:BQ' );
                } else {
                    return VALUE( $i, 'TO:DK' ) * VALUE( $i, 'TO:BQ' );
                }
            },
        ),
        'TO:DV' =>  array(
            'name' => 'Etch corrected internal δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal errU alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:BQ' ) == 0 ) {
                    return 0;
                } elseif( $i['TI:36'] == 0 ) {
                    return VALUE( $i, 'TO:BR' );
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:DK', 'TO:BR', 'TO:BQ', 'TO:DL', 'TO:DK' );
                }
            },
        ),
        'TO:DW' =>  array(
            'name' => 'Etch corrected internal Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal Th alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){
                if( $i['TI:36'] == 0 ) {
                    return VALUE( $i, 'TO:BS' );
                } else {
                    return VALUE( $i, 'TO:DM' ) * VALUE( $i, 'TO:BS' );
                }
            },
        ),
        'TO:DX' =>  array(
            'name' => 'Etch corrected internal δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal errTh alphadoserate (Gy.ka-1)',
            'description' => $alpha_etch_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:BS' ) == 0 ) {
                    return 0;
                } elseif( $i['TI:36'] == 0 ) {
                    return VALUE( $i, 'TO:BT' );
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:DM', 'TO:BT', 'TO:BS', 'TO:DN', 'TO:DM' );
                }
            },
        ),
        'TO:DY' =>  array(
            'name' => 'U-Beta etch attenuation factor',
            'name_ascii' => 'U-Beta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'U 1-φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:DZ' =>  array(
            'name' => 'U-δBeta etch attenuation factor',
            'name_ascii' => 'U-errBeta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'U 1-φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EA' =>  array(
            'name' => 'Th-Beta etch attenuation factor',
            'name_ascii' => 'Th-Beta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'Th 1-φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:EB' =>  array(
            'name' => 'Th-δBeta etch attenuation factor',
            'name_ascii' => 'Th-errBeta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'Th 1-φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EC' =>  array(
            'name' => 'K-Beta etch attenuation factor',
            'name_ascii' => 'K-Beta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'K 1-φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:ED' =>  array(
            'name' => 'K-δBeta etch attenuation factor',
            'name_ascii' => 'K-errBeta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'K 1-φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EE' =>  array(
            'name' => 'Compiled beta etch attenuation factor',
            'name_ascii' => 'Compiled beta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'Combined 1-φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:EF' =>  array(
            'name' => 'δCompiled beta etch attenuation factor',
            'name_ascii' => 'errCompiled beta etch attenuation factor',
            'description' => $beta_etch_attn,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'Combined 1-φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EG' =>  array(
            'name' => 'U-Beta etch absorption factor',
            'name_ascii' => 'U-Beta etch absorption factor',
            'description' => $beta_etch_abs,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'U φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:EH' =>  array(
            'name' => 'U-δBeta etch absorption factor',
            'name_ascii' => 'U-errBeta etch absorption factor',
            'description' => $beta_etch_abs,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'U φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EI' =>  array(
            'name' => 'Th-Beta etch absorption factor',
            'name_ascii' => 'Th-Beta etch absorption factor',
            'description' => $beta_etch_abs,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'Th φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:EJ' =>  array(
            'name' => 'Th-δBeta etch absorption factor',
            'name_ascii' => 'Th-errBeta etch absorption factor',
            'description' => $beta_etch_abs,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'Th φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EK' =>  array(
            'name' => 'K-Beta etch absorption factor',
            'name_ascii' => 'K-Beta etch absorption factor',
            'description' => $beta_etch_abs,
            'value' => function($i){  return $i['TI:36'] > 0 ? lt4_factor( $i, 'K φ(D)', $i['TI:38'] ) : 1; },
        ),
        'TO:EL' =>  array(
            'name' => 'K-δBeta etch absorption factor',
            'name_ascii' => 'K-errBeta etch absorption factor',
            'description' => $beta_etch_abs,
            'value' => function($i){  return  $i['TI:36'] > 0 ? lt4_factor_d( $i, 'K φ(D)', $i['TI:38'] ) : 0;  },
        ),
        'TO:EM' =>  array(
            'name' => 'Etch corrected external U Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external U betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return VALUE( $i, "TO:DY" ) * VALUE( $i, "TO:CM" );  },
        ),
        'TO:EN' =>  array(
            'name' => 'Etch corrected external δU Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external errU betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){
                if( $i['TI:41'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:EM', 'TO:CN', 'TO:CM', 'TO:DZ', 'TO:DY' );
                }
            },
        ),
        'TO:EO' =>  array(
            'name' => 'Etch corrected external Th Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external Th betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return VALUE( $i, "TO:EA" ) * VALUE( $i, "TO:CO" );  },
        ),
        'TO:EP' =>  array(
            'name' => 'Etch corrected external δTh Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external errTh betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){
                if( $i['TI:41'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:EO', 'TO:CP', 'TO:CO', 'TO:EB', 'TO:EA' );
                }
            },
        ),
        'TO:EQ' =>  array(
            'name' => 'Etch corrected external K Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external K betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return VALUE( $i, "TO:EC" ) * VALUE( $i, "TO:CQ" );  },
        ),
        'TO:ER' =>  array(
            'name' => 'Etch corrected external δK Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected external errK betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){
                if( $i['TI:41'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:EQ', 'TO:CR', 'TO:CQ', 'TO:ED', 'TO:EC' );
                }
            },
        ),
        'TO:ES' =>  array(
            'name' => 'Etch corrected user external Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected user external betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){ return VALUE( $i, "TO:EE" ) * VALUE( $i, "TO:CU" );  },
        ),
        'TO:ET' =>  array(
            'name' => 'Etch corrected user external δḊβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected user external errbetadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:ES', 'TO:CV', 'TO:CU', 'TO:EF', 'TO:EE' );  },
        ),
        'TO:EU' =>  array(
            'name' => 'Etch corrected internal U Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal U betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){ return VALUE( $i, "TO:EG" ) * VALUE( $i, "TO:CW" );  },
        ),
        'TO:EV' =>  array(
            'name' => 'Etch corrected internal δU Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal errU betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:EU', 'TO:CX', 'TO:CW', 'TO:EH', 'TO:EG' );  },
        ),
        'TO:EW' =>  array(
            'name' => 'Etch corrected internal Th Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal Th betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){ return VALUE( $i, "TO:EI" ) * VALUE( $i, "TO:CY" );  },
        ),
        'TO:EX' =>  array(
            'name' => 'Etch corrected internal δTh Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal errTh betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:EW', 'TO:CZ', 'TO:CY', 'TO:EJ', 'TO:EI' );  },
        ),
        'TO:EY' =>  array(
            'name' => 'Etch corrected internal K Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal K betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return VALUE( $i, "TO:EK" ) * VALUE( $i, "TO:DA" );  },
        ),
        'TO:EZ' =>  array(
            'name' => 'Etch corrected internal δK Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Etch corrected internal errK betadoserate (Gy.ka-1)',
            'description' => $beta_etch_corrected,
            'value' => function($i){  return factor_sqrt_sum_sqr_ratio( $i, 'TO:EY', 'TO:DB', 'TO:DA', 'TO:EL', 'TO:EK' );  },
        ),
        'TO:FA' =>  array(
            'name' => 'a-value corrected external U Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected external U alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){  return VALUE( $i, "TI:39" ) * VALUE( $i, "TO:DO" );  },
        ),
        'TO:FB' =>  array(
            'name' => 'a-value corrected external δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected external errU alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){
                if( $i['TI:39'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:FA', 'TO:DP', 'TO:DO', 'TI:40', 'TI:39' );
                }
            },
        ),
        'TO:FC' =>  array(
            'name' => 'a-value corrected external Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected external Th alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){  return VALUE( $i, "TI:39" ) * VALUE( $i, "TO:DQ" );  },
        ),
        'TO:FD' =>  array(
            'name' => 'a-value corrected external δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected external errTh alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){
                if( $i['TI:39'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:FC', 'TO:DR', 'TO:DQ', 'TI:40', 'TI:39' );
                }
            },
        ),
        'TO:FE' =>  array(
            'name' => 'a-value corrected user external Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected user external alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){
                if( $i['TI:39'] == 0 ) {
                    return 0;
                } elseif( VALUE( $i, 'TO:DS' ) > 0 ) {
                    return VALUE( $i, 'TO:DS' ) * $i['TI:39'];
                } else {
                    return 0;
                }
            },
        ),
        'TO:FF' =>  array(
            'name' => 'a-value corrected user external δḊα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected user external erralphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:DS' ) == 0 ) {
                    return 0;
                } elseif( $i['TI:39'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:FE', 'TO:DT', 'TI:23', 'TI:40', 'TI:39' );
                }
            },
        ),
        'TO:FG' =>  array(
            'name' => 'a-value corrected internal U Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected internal U alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){  return VALUE( $i, "TI:39" ) * VALUE( $i, "TO:DU" );  },
        ),
        'TO:FH' =>  array(
            'name' => 'a-value corrected internal δU Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected internal errU alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:DU' ) == 0 ) {
                    return 0;
                } elseif( $i['TI:39'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:FG', 'TO:DV', 'TO:DU', 'TI:40', 'TI:39' );
                }
            },
        ),
        'TO:FI' =>  array(
            'name' => 'a-value corrected internal Th Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected internal Th alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){  return VALUE( $i, "TI:39" ) * VALUE( $i, "TO:DW" );  },
        ),
        'TO:FJ' =>  array(
            'name' => 'a-value corrected internal δTh Ḋα (Gy.ka-1)',
            'name_ascii' => 'a-value corrected internal errTh alphadoserate (Gy.ka-1)',
            'description' => $a_value_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:DW' ) == 0 ) {
                    return 0;
                } elseif( $i['TI:39'] == 0 ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:FI', 'TO:DX', 'TO:DW', 'TI:40', 'TI:39' );
                }
            },
        ),
        'TO:FK' =>  array(
            'name' => 'External Dry Ḋα (Gy.ka-1)',
            'name_ascii' => 'External Dry alphadoserate (Gy.ka-1)',
            'description' => $external_dry,
            'value' => function($i){
                if (VALUE( $i, 'TO:FE') > 0) {
                    return VALUE( $i, 'TO:FE');
                } else {
                    return VALUE( $i, 'TO:FA') + VALUE( $i, 'TO:FC');
                }
            },
        ),
        'TO:FL' =>  array(
            'name' => 'External Dry δḊα (Gy.ka-1)',
            'name_ascii' => 'External Dry erralphadoserate (Gy.ka-1)',
            'description' => $external_dry,
            'value' => function($i){
                if (VALUE( $i, 'TO:FE') > 0) {
                    return VALUE( $i, 'TO:FF' );
                } else {
                    return sqrt_sum_sqrs( VALUE( $i, 'TO:FB' ), VALUE( $i, 'TO:FD' ) );
                }
            },
        ),
        'TO:FM' =>  array(
            'name' => 'External Dry Ḋβ (Gy.ka-1)',
            'name_ascii' => 'External Dry betadoserate (Gy.ka-1)',
            'description' => $external_dry,
            'value' => function($i){
                if( $i['TI:25'] == 0 || valid_blank( $i['TI:25'] ) ) {
                    return VALUE( $i, 'TO:EM' ) + VALUE( $i, 'TO:EO' ) + VALUE( $i, 'TO:EQ' ) + VALUE( $i, 'TO:ES' ) + VALUE( $i, 'TO:CS' );
                } else {
                    return VALUE( $i, 'TO:ES' );
                }
            },
        ),
        'TO:FN' =>  array(
            'name' => 'External Dry δḊβ (Gy.ka-1)',
            'name_ascii' => 'External Dry errbetadoserate (Gy.ka-1)',
            'description' => $external_dry,
            'value' => function($i){
                if( $i['TI:25'] == 0 || valid_blank( $i['TI:25'] ) ) {
                    return sqrt_sum_sqrs( VALUE( $i, 'TO:EN' ), VALUE( $i, 'TO:EP' ), VALUE( $i, 'TO:ER' ), VALUE( $i, 'TO:ET' ), VALUE( $i, 'TO:CT' ) );
                } else {
                    return VALUE( $i, 'TO:ET' );
                }
            },
        ),
        'TO:FO' =>  array(
            'name' => 'External Dry Ḋγ (Gy.ka-1)',
            'name_ascii' => 'External Dry gammadoserate (Gy.ka-1)',
            'description' => $external_dry,
            'value' => function($i){  return VALUE( $i, 'TO:AU' );  },
        ),
        'TO:FP' =>  array(
            'name' => 'External Dry δḊγ (Gy.ka-1)',
            'name_ascii' => 'External Dry errgammadoserate (Gy.ka-1)',
            'description' => $external_dry,
            'value' => function($i){  return VALUE( $i, 'TO:AV' );  },
        ),
        'TO:FQ' =>  array(
            'name' => 'Water corrected Ḋα',
            'name_ascii' => 'Water corrected alphadoserate',
            'description' => $water_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:FK' ) / ( 1 + LT5( 'Alpha' ) * ( $i['TI:41'] / 100.0 ) );  },
        ),
        'TO:FR' =>  array(
            'name' => 'Water corrected δḊα',
            'name_ascii' => 'Water corrected erralphadoserate',
            'description' => $water_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:FQ' ) == 0 ) {
                    return 0;
                } else {
                    return VALUE( $i, 'TO:FQ' ) * sqrt_sum_sqrs(
                        VALUE( $i, 'TO:FL' ) / VALUE( $i, 'TO:FK' ),
                        ( LT5( 'Alpha' ) * $i['TI:42'] / 100.0 ) / ( 1 + LT5( 'Alpha' ) * ( $i['TI:41'] / 100.0 ) )
                    );
                }
           },
        ),
        'TO:FS' =>  array(
            'name' => 'Water corrected Ḋβ',
            'name_ascii' => 'Water corrected betadoserate',
            'description' => $water_corrected,
            'value' => function($i){  return VALUE( $i, 'TO:FM' ) / ( 1 + LT5( 'Beta' ) * ( $i['TI:41'] / 100.0 ) );  },
        ),
        'TO:FT' =>  array(
            'name' => 'Water corrected δḊβ',
            'name_ascii' => 'Water corrected errbetadoserate',
            'description' => $water_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:FS' ) == 0 ) {
                    return 0;
                } else {
                    return VALUE( $i, 'TO:FS' ) * sqrt_sum_sqrs(
                        VALUE( $i, 'TO:FN' ) / VALUE( $i, 'TO:FM' ),
                        ( LT5( 'Beta' ) * $i['TI:42'] / 100.0 ) / ( 1 + LT5( 'Beta' ) * ( $i['TI:41'] / 100.0 ) )
                    );
                }
            },
        ),
        'TO:FU' =>  array(
            'name' => 'Water corrected Ḋγ (Gy.ka-1)',
            'name_ascii' => 'Water corrected gammadoserate (Gy.ka-1)',
            'description' => $water_corrected,
            'value' => function($i){
            // return VALUE( $i, 'TO:FO' ) / ( 1 + LT5( 'Gamma' ) * ( $i['TI:41'] / 100.0 ) );

              if(valid_blank( $i['TI:5'] ) || valid_blank( $i['TI:6'] ) || valid_blank( $i['TI:7'] ) || valid_blank( $i['TI:8'] ) || valid_blank( $i['TI:9'] ) || valid_blank( $i['TI:10'] ) || valid_blank( $i['TI:27'] ) || valid_blank( $i['TI:28']) ) {
                return ( VALUE( $i, 'TO:AI' ) + VALUE( $i, 'TO:AK' ) +  VALUE( $i, 'TO:AM' ) )
                  / ( 1 + LT5( 'Gamma' ) * ( $i['TI:41'] / 100.0 ) );
              } else {
                return ( VALUE( $i, 'TO:AO' ) )
                  / ( 1 + LT5( 'Gamma' ) * ( $i['TI:41'] / 100.0 ) );
              }
            },
        ),
        'TO:FV' =>  array(
            'name' => 'Water corrected δḊγ (Gy.ka-1)',
            'name_ascii' => 'Water corrected errgammadoserate (Gy.ka-1)',
            'description' => $water_corrected,
            'value' => function($i){
                if( VALUE( $i, 'TO:FU' ) == 0 ) {
                    return 0;
                } else {
                    return VALUE( $i, 'TO:FU' ) * sqrt_sum_sqrs(
                        VALUE( $i, 'TO:FP' ) / VALUE( $i, 'TO:FO' ),
                        ( LT5( 'Gamma' ) * $i['TI:42'] / 100.0 ) / ( 1 + LT5( 'Gamma' ) * ( $i['TI:41'] / 100.0 ) )
                    );
                }
            },
        ),
        'TO:FW' =>  array(
            'name' => 'Internal Dry Ḋα (Gy.ka-1)',
            'name_ascii' => 'Internal Dry alphadoserate (Gy.ka-1)',
            'description' => $internal_dry,
            'value' => function($i){  return  VALUE( $i, 'TO:FG' ) + VALUE( $i, 'TO:FI' );  },
        ),
        'TO:FX' =>  array(
            'name' => 'Internal Dry δḊα (Gy.ka-1)',
            'name_ascii' => 'Internal Dry erralphadoserate (Gy.ka-1)',
            'description' => $internal_dry,
            'value' => function($i){  return sqrt_sum_sqrs( VALUE( $i, 'TO:FH' ), VALUE( $i, 'TO:FJ' ) );  },
        ),
        'TO:FY' =>  array(
            'name' => 'Internal Dry Ḋβ (Gy.ka-1)',
            'name_ascii' => 'Internal Dry betadoserate (Gy.ka-1)',
            'description' => $internal_dry,
            'value' => function($i){  return  VALUE( $i, 'TO:EU' ) +  VALUE( $i, 'TO:EW' ) +  VALUE( $i, 'TO:EY' ) + VALUE( $i, 'TO:DC' );  },
        ),
        'TO:FZ' =>  array(
            'name' => 'Internal Dry δḊβ (Gy.ka-1)',
            'name_ascii' => 'D0 (Gy.ka-1)',
            'name_ascii' => 'Internal Dry errbetadoserate (Gy.ka-1)',
            'description' => $internal_dry,
            'value' => function($i){  return sqrt_sum_sqrs( VALUE( $i, 'TO:EV' ), VALUE( $i, 'TO:EX' ), VALUE( $i, 'TO:EZ' ) );  },
        ),
        'TO:GA' =>  array(
            'name' => 'Ḋ0 (Gy.ka-1)',
            'name_ascii' => 'D0 (Gy.ka-1)',
            'description' => 'The cosmic dose rate calculated at the sample depth, 55°N and sea level.',
            'value' => function($i){
                if( valid_blank( $i['TI:43'] ) ) {
                    return 0;
                } else {
                    $a = $i['TI:43'] * $i['TI:45'];
                    if( $a < 1.67 ) {
                        return (0.0321 * pow($a, 4)) - (0.135 * pow($a, 3)) + (0.221 * pow($a, 2)) - (0.207 * pow( $a, 1)) + 0.295;
                    } else {
                        return ( 6072 / ( ( pow( $a + 11.6, 1.68 ) + 75 ) * ($a + 212) ) ) * exp(-0.00055 * $a);
                    }
                }
            },
        ),
        'TO:GB' =>  array(
            'name' => 'δḊ0 (Gy.ka-1)',
            'name_ascii' => 'errD0 (Gy.ka-1)',
            'description' => 'The cosmic dose rate calculated at the sample depth, 55°N and sea level.',
            'value' => function($i){
                if( valid_blank( $i['TI:43'] ) ) {
                    return 0;
                } else {
                    return factor_sqrt_sum_sqr_ratio( $i, 'TO:GA', 'TI:44', 'TI:43', 'TI:46', 'TI:45' );
                }
            },
        ),
        'TO:GC' =>  array(
            'name' => 'Geomagnetic latitude',
            'name_ascii' => 'Geomagnetic latitude',
            'description' => 'The geomagnetic latitude calculated from the sample latitude and longitude and sampling depth.',
            'value' => function($i){
                if( valid_blank( $i['TI:43'] ) || floatval($i['TI:43']) == 0  ) {
                    return 0;
                } else {
                    $p = pi() / 180;
                    return asin(0.203 * cos( $p*$i['TI:47'] ) * cos( $p*$i['TI:48'] - (291*$p) ) + 0.979 * sin( ($p*$i['TI:47']))) / $p;
                }
            },
        ),
        'TO:GD' =>  array(
            'name' => 'F',
            'name_ascii' => 'F',
            'description' => 'The factors required to correct the cosmic dose rate for altitude and geomagnetic latitude (after Prescott and Stefan, 1982).',
            'value' => function($i){
              return  (valid_blank($i['TI:43']) || floatval($i['TI:43']) == 0) ? 0 : LT6( 'F', round( VALUE( $i, 'TO:GC') ) );  },
        ),
        'TO:GE' =>  array(
            'name' => 'H',
            'name_ascii' => 'H',
            'description' => 'The factors required to correct the cosmic dose rate for altitude and geomagnetic latitude (after Prescott and Stefan, 1982).',
            'value' => function($i){
              return (valid_blank($i['TI:43']) || floatval($i['TI:43']) == 0) ? 0 : LT6( 'H', round( VALUE( $i, 'TO:GC') ) );
            },
        ),
        'TO:GF' =>  array(
            'name' => 'J',
            'name_ascii' => 'J',
            'description' => 'The factors required to correct the cosmic dose rate for altitude and geomagnetic latitude (after Prescott and Stefan, 1982).',
            'value' => function($i){
              return (valid_blank($i['TI:43']) || floatval($i['TI:43']) == 0) ? 0 : LT6( 'J', round( VALUE( $i, 'TO:GC') ) );
            },
        ),
        'TO:GG' =>  array(
            'name' => 'Ḋc (Gy.ka-1)',
            'name_ascii' => 'Cosmicdoserate (Gy.ka-1)',
            'description' => 'The calculated or user defined cosmic dose rate used in final environmental dose rate calculation.',
            'value' => function($i){
                if( !valid_blank( $i['TI:50'] ) ) {
                    return $i['TI:50'];
                } else if( VALUE( $i, 'TO:GE') == 0 ) {
                    return 0;
                } else {
                    return VALUE( $i, 'TO:GA') * ( VALUE( $i, 'TO:GD') + VALUE( $i, 'TO:GF') * exp( ($i['TI:49']/1000.0) / VALUE( $i, 'TO:GE')) );
                }
            },
        ),
        'TO:GH' =>  array(
            'name' => 'δḊc (Gy.ka-1)',
            'name_ascii' => 'errCosmicdoserate (Gy.ka-1)',
            'description' => 'The calculated or user defined cosmic dose rate used in final environmental dose rate calculation.',
            'value' => function($i){
                if( !valid_blank( $i['TI:51'] ) ) {
                    return $i['TI:51'];
                } else {
                    return VALUE( $i, 'TO:GG') * 0.1;
                }
            },
        ),
        'TO:GI' =>  array(
            'name' => 'External Ḋr (Gy.ka-1)',
            'name_ascii' => 'External doserate (Gy.ka-1)',
            'description' => $drac_int_ext_dose_rate,
            'value' => function($i){
                return VALUE( $i, 'TO:GG') + VALUE( $i, 'TO:FQ') + VALUE( $i, 'TO:FS') + VALUE( $i, 'TO:FU');
            },
        ),
        'TO:GJ' =>  array(
            'name' => 'External δḊr (Gy.ka-1)',
            'name_ascii' => 'External errdoserate (Gy.ka-1)',
            'description' => $drac_int_ext_dose_rate,
            'value' => function($i){
                return sqrt_sum_sqrs( VALUE( $i, 'TO:GH'), VALUE( $i, 'TO:FR'), VALUE( $i, 'TO:FT'), VALUE( $i, 'TO:FV') );
            },
        ),
        'TO:GK' =>  array(
            'name' => 'Internal Ḋr (Gy.ka-1)',
            'name_ascii' => 'Internal doserate (Gy.ka-1)',
            'description' => $drac_int_ext_dose_rate,
            'value' => function($i){
              if( valid_blank( $i['TI:29'] ) ) {
                return VALUE( $i, 'TO:FW') + VALUE( $i, 'TO:FY');
              } else {
                return $i['TI:29'];
              }
            },
        ),
        'TO:GL' =>  array(
            'name' => 'Internal δḊr (Gy.ka-1)',
            'name_ascii' => 'Internal errdoserate (Gy.ka-1)',
            'description' => $drac_int_ext_dose_rate,
            'value' => function($i){
              if( valid_blank( $i['TI:30'] ) ) {
                return sqrt_sum_sqrs( VALUE( $i, 'TO:FX'), VALUE( $i, 'TO:FZ') );
              } else {
                return $i['TI:30'];
              }
            },
        ),
        'TO:GM' =>  array(
            'name' => 'Environmental Dose Rate (Gy.ka-1)',
            'name_ascii' => 'Environmental Dose Rate (Gy.ka-1)',
            'description' => 'DRAC calculated environmental dose rate.',
            'value' => function($i){  return VALUE( $i, 'TO:GI') + VALUE( $i, 'TO:GK');  },
        ),
        'TO:GN' =>  array(
            'name' => 'δEnvironmental Dose Rate (Gy.ka-1)',
            'name_ascii' => 'errEnvironmental Dose Rate (Gy.ka-1)',
            'description' => 'DRAC calculated environmental dose rate.',
            'value' => function($i){  return sqrt_sum_sqrs( VALUE( $i, 'TO:GJ'), VALUE( $i, 'TO:GL') );  },
        ),
        'TO:GO' =>  array(
            'name' => 'Age (ka)',
            'name_ascii' => 'Age (ka)',
            'description' => 'Age, if De is provided, calculated using the DRAC determined dose rate.',
            'value' => function($i){  return VALUE( $i, 'TI:52') / VALUE( $i, 'TO:GM');  },
        ),
        'TO:GP' =>  array(
            'name' => 'δAge (ka)',
            'name_ascii' => 'errAge (ka)',
            'description' => 'Age, if De is provided, calculated using the DRAC determined dose rate.',
            'value' => function($i){
                return factor_sqrt_sum_sqr_ratio( $i, 'TO:GO', 'TO:GN', 'TO:GM', 'TI:53', 'TI:52' );  },
        ),

    );
}
