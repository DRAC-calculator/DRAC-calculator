<?php  

function drac_menu_html() {
	$current = empty($_GET['show']) ? '' : $_GET['show'];
	$html = '<ul class="drac_nav">';
    $html .= '<li><a href="' . DRAC_URL . '?" class="' . ($current  == "" ? 'current' : '') . '">Home</a></li>';
    $html .= '<li><a href="' . DRAC_URL . '?show=userguide" class="' . ($current == "userguide" ? 'current' : '') . '">User Guide</a></li>';
    $html .= '<li><a href="' . DRAC_URL . '?show=calculator" class="' . ($current == "calculator" ? 'current' : '') . '">Calculator</a></li>';
    $html .= '<li><a href="' . DRAC_URL . '?show=datatables" class="' . ($current  == "datatables" ? 'current' : '') . '">Data Tables</a></li>';
    $html .= '<li><a href="' . DRAC_URL . '?show=whoweare" class="' . ($current  == "whoweare" ? 'current' : '') . '">Who we are</a></li>';
    $html .= '<li><a href="' . DRAC_URL . '?show=references" class="' . ($current  == "references" ? 'current' : '') . '">References</a></li>';
    $html .= '</ul>';
    return $html;
}
      
function drac_field_error_html($error_message) {
	$html = '<div class="drac_field_error">';
	$html .= str_replace("\n", "<br>", $error_message);
	$html .= '</div>';
	return $html;
}
      
function drac_format_table_html($html) {
    $html = str_replace( 'ka-1', 'ka<sup>-1</sup>', $html );
    $html = str_replace( 'cm-3', 'cm<sup>-3</sup>', $html );
    return $html;
}
