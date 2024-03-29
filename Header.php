<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package YourThemeName
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">

    <!-- This Is Icon Cdn -->
    <script src="https://kit.fontawesome.com/34e6d2d9a0.js" crossorigin="anonymous"></script>
    <!-- Icon Cdn -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="header-content-vasutheme">
    <?php
    // Check if the Elementor template with ID 933 exists
    if ( \Elementor\Plugin::instance()->db->is_built_with_elementor( 593 ) ) {
        // Output Elementor template with ID 933
        echo do_shortcode('[Paper_Template id="658"]');
    } else {
        // Output default header content
        get_template_part('Template/Header-Template/header1');
    }
    ?>
</div>