<?php
   get_header(); 

// Start the loop.
while (have_posts()) : the_post();

    // Check if the Elementor template exists.
    if (function_exists('elementor_theme_do_location') && !empty(do_shortcode('[elementor-template id="13445"]'))) {
        // If the Elementor template exists, display it.
        echo do_shortcode('[elementor-template id="13445"]');
    } else {
        // If the Elementor template does not exist or is empty, use the single1.php template.
        get_template_part('Template/single1');
    }
    get_footer();
endwhile;
?>
