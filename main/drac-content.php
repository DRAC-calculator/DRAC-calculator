<?php
    $pages = array( 'userguide', 'calculator', 'datatables', 'news', 'whoweare', 'references' );
    $current = empty($_GET['show']) ? '' : $_GET['show'];

	echo '<div class="drac_content">';

    if( in_array( $current, $pages ) ) {
        require_once __DIR__ . '/../pages/' . $current . '.php';
    } else {
        require_once __DIR__ . '/../pages/home.php';
    }

	echo '</div>';
