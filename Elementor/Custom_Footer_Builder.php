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
            'name'                  => _x( 'Footers', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Footer', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Footers', 'text_domain' ),
            'name_admin_bar'        => __( 'Footer', 'text_domain' ),
            'archives'              => __( 'Footer Archives', 'text_domain' ),
            'attributes'            => __( 'Footer Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Footer:', 'text_domain' ),
            'all_items'             => __( 'All Footers', 'text_domain' ),
            'add_new_item'          => __( 'Add New Footer', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Footer', 'text_domain' ),
            'edit_item'             => __( 'Edit Footer', 'text_domain' ),
            'update_item'           => __( 'Update Footer', 'text_domain' ),
            'view_item'             => __( 'View Footer', 'text_domain' ),
            'view_items'            => __( 'View Footers', 'text_domain' ),
            'search_items'          => __( 'Search Footer', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into footer', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this footer', 'text_domain' ),
            'items_list'            => __( 'Footers list', 'text_domain' ),
            'items_list_navigation' => __( 'Footers list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter footers list', 'text_domain' ),
        );

        $args = array(
            'label'                 => __( 'Footer', 'text_domain' ),
            'description'           => __( 'Footers Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
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
            echo '[vasu_theme_footer_block id="' . $post_id . '"]';
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

    
    
}

// Initialize the class
Custom_Footer_Builder::get_instance();


