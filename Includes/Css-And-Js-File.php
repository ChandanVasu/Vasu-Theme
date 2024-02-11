<?php

function enqueue_styles_and_scripts() {
    // Enqueue CSS file
    wp_enqueue_style('Grid-Post-1', get_template_directory_uri() . '/Assets/Styles/Elementor/Grid-Post-1.css');
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');