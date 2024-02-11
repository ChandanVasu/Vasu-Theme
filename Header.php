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

$selected_header_style = get_theme_mod('header_style_setting', 'header1'); // Get the selected header style from Customizer

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&family=Roboto:wght@400;500;700;900&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Swiper Cdn -->
    <!-- <link
     rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- swiper cdn -->

    <!-- This Is Icon Cdn -->
    <script src="https://kit.fontawesome.com/34e6d2d9a0.js" crossorigin="anonymous"></script>
    <!-- Icon Cdn -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('Template/Header-Template/' . $selected_header_style, 'template'); ?>
