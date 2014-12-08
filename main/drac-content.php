<?php
    $pages = array( 'userguide', 'calculator', 'datatables', 'whoweare', 'references' );
    $current = empty($_GET['show']) ? '' : $_GET['show'];

	echo '<div class="drac_content">';

    if( in_array( $current, $pages ) ) {
        require_once(DRAC_ROOT . '/pages/' . $current . '.php');
    } else {
        require_once(DRAC_ROOT . '/pages/home.php');
    }

	echo '</div>';
