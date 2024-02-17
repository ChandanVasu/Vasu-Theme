<footer>
    <?php
    // Check if the Elementor template with ID 933 exists
    if ( \Elementor\Plugin::instance()->db->is_built_with_elementor( 933 ) ) {
        // Output Elementor template with ID 933
        echo do_shortcode('[elementor-template id="933"]');
    } else {
        // Output custom footer content with site name, "VasuTheme", and current year
        echo '<p>Copyright © ' . get_bloginfo('name') . ' VasuTheme ' . date("Y") . '. All Rights Reserved.</p>';
    }
    
    wp_footer(); // Enqueue Elementor assets
    ?>
</footer>
