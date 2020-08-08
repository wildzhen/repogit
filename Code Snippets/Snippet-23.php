<?php

/***** EBOUTIK - JAVASCRIPT ENQUEUE *****/

function my_eboutik_scripts() {
    wp_enqueue_script('main.js', get_stylesheet_directory_uri()  . '/js/main.js', array(), date("h:i:s") );

}
add_action('wp_enqueue_scripts', 'my_eboutik_scripts');
