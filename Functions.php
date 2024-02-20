<?php
// Theme Setup
function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'your-theme-textdomain'),
    ));
    register_nav_menus(array(
        'hearder-menu' => __('Header Menu', 'your-theme-textdomain'),
    ));
}
add_action('after_setup_theme', 'theme_setup');


include_once get_template_directory() . '/Includes/shortcode.php';
include_once get_template_directory() . '/Includes/bootstrap.php';
include_once get_template_directory() . '/Includes/meta-box.php';




include_once get_template_directory() . '/Includes/Css-And-Js-File.php';
include_once get_template_directory() . '/Includes/post-type.php';

// Custom_Footer_Builder::get_instance();


function your_theme_register_header_style_customizer($wp_customize) {
    // Add section for header style
    $wp_customize->add_section('header_section', array(
        'title' => __('Header Style', 'your-theme'),
        'priority' => 30,
    ));

    // Header style setting
    $wp_customize->add_setting('header_style_setting', array(
        'default' => 'header1', // Set Header Style 1 as default
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Header style control
    $wp_customize->add_control('header_style_control', array(
        'label' => __('Select Header Style', 'your-theme'),
        'section' => 'header_section',
        'settings' => 'header_style_setting',
        'type' => 'select',
        'choices' => array(
            'header1' => __('Header Style 1', 'your-theme'),
            'header2' => __('Header Style 2', 'your-theme'),
            'header3' => __('Header Style 3', 'your-theme'),
            'header4' => __('Header Style 4', 'your-theme'),
        ),
    ));

    // Add control for sticky header

    // Add control for header background color
    $wp_customize->add_setting('header_background_color_setting', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background_color_control', array(
        'label' => __('Header Background Color', 'your-theme'),
        'section' => 'header_section',
        'settings' => 'header_background_color_setting',
    )));
}

add_action('customize_register', 'your_theme_register_header_style_customizer');


function register_hello_world_widget( $widgets_manager ) {

	require_once( __DIR__ . '/Elementor/hello-world-widget-1.php' );
	require_once( __DIR__ . '/Elementor/Grid-Post-1.php' );
    require_once(__DIR__ . '/Elementor/List-Post-1.php');
    require_once(__DIR__ . '/Elementor/List-Post-2.php');
    require_once(__DIR__ . '/Elementor/Grid-Post-2.php');
    require_once(__DIR__ . '/Elementor/Heading-Title-Elementor.php');
    require_once(__DIR__ . '/Elementor/Single-Post-Content.php');



	$widgets_manager->register( new \Elementor_Hello_World_Widget_1() );
    $widgets_manager->register( new \List_Post_1());
    $widgets_manager->register( new \List_Post_2());
	$widgets_manager->register( new \Grid_Post_1() );
    $widgets_manager->register( new \Grid_Post_2() );
    $widgets_manager->register( new \Custom_Title_Widget() );
    $widgets_manager->register( new \Single_Post_Content_Widget() );



}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );




function add_elementor_widget_categories( $elements_manager ) {

	$categories = [];
	$categories['Vasu X'] =
		[
			'title' => 'Vasu X',
			'icon'  => 'fa fa-plug'
		];

	$old_categories = $elements_manager->get_categories();
	$categories = array_merge($categories, $old_categories);

	$set_categories = function ( $categories ) {
		$this->categories = $categories;
	};

	$set_categories->call( $elements_manager, $categories );

}

add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');


add_filter( 'elementor/theme/post_types/default_template_type', function( $post_type ) {
    return 'full_width'; // Set the default template to "Full Width"
});


