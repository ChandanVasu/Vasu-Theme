<?php


get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Check if Elementor is active
        if (class_exists("\\Elementor\\Plugin")) {
            $post_ID = get_the_ID(); // Get the current page ID
            $pluginElementor = \Elementor\Plugin::instance();
            $contentElementor = $pluginElementor->frontend->get_builder_content($post_ID);

            echo $contentElementor;
        } else {
            // Elementor is not active, fallback to regular content
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
