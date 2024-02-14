<?php

class Custom_Footer_Builder {

    private static $instance;

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new Custom_Footer_Builder();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', array($this, 'register_footer_blocks'));
        add_shortcode('footer_block', array($this, 'display_footer_block'));
    }

    public function register_footer_blocks() {
        $labels = array(
            'name'               => _x('Footer Blocks', 'post type general name', 'text-domain'),
            'singular_name'      => _x('Footer Block', 'post type singular name', 'text-domain'),
            'add_new'            => __('Add New', 'text-domain'),
            'add_new_item'       => __('Add New Footer Block', 'text-domain'),
            'edit_item'          => __('Edit Footer Block', 'text-domain'),
            'new_item'           => __('New Footer Block', 'text-domain'),
            'all_items'          => __('All Footer Blocks', 'text-domain'),
            'view_item'          => __('View Footer Block', 'text-domain'),
            'search_items'       => __('Search Footer Blocks', 'text-domain'),
            'not_found'          => __('No footer blocks found', 'text-domain'),
            'not_found_in_trash' => __('No footer blocks found in Trash', 'text-domain'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Footer Blocks', 'text-domain'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'footer-block'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
        'supports'              => array( 'title', 'editor', 'elementor' ), // Add 'elementor' support
        );

        register_post_type('footer-block', $args);

        // Add shortcode column to the admin list view
        add_filter('manage_footer-block_posts_columns', array($this, 'add_shortcode_column'));
        add_action('manage_footer-block_posts_custom_column', array($this, 'render_shortcode_column'), 10, 2);
    }

    public function add_shortcode_column($columns) {
        $columns['shortcode'] = __('Shortcode', 'text-domain');
        return $columns;
    }

    public function render_shortcode_column($column, $post_id) {
        if ($column === 'shortcode') {
            echo '[footer_block id="' . $post_id . '"]';
        }
    }

    public function display_footer_block($atts) {
        $atts = shortcode_atts(array(
            'id' => '',
        ), $atts);

        if (empty($atts['id'])) {
            return; // No ID provided, return early
        }

        $footer_block = get_post($atts['id']);

        if (!$footer_block || $footer_block->post_type != 'footer-block') {
            return; // Post not found or not of type 'footer-block', return early
        }

        $content = apply_filters('the_content', $footer_block->post_content);

        return $content;
    }

    public function enqueue_scripts() {

        if ( class_exists( '\Elementor\Plugin' ) ) {
            $elementor = \Elementor\Plugin::instance();
            $elementor->frontend->enqueue_styles();
        }

        if ( class_exists( '\ElementorPro\Plugin' ) ) {
            $elementor_pro = \ElementorPro\Plugin::instance();
            $elementor_pro->enqueue_styles();
        }

        if ( penci_can_render_footer() ) {
            $footer_id = penci_footer_builder_content_id();
            $css_file  = '';
            if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new \Elementor\Core\Files\CSS\Post( $footer_id );
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( $footer_id );
            }

            if ( $css_file ) {
                $css_file->enqueue();
            }
        }
        
    }
    
}

// Initialize the class
Custom_Footer_Builder::get_instance();

