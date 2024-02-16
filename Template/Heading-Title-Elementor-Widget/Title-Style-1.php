<?php
/**
 * Plugin Name: Custom Title Widget
 * Description: Adds a custom Elementor widget for titles with various styling options.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Custom_Title_Widget extends \Elementor\Widget_Base {

    // Widget class code here...

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title_tag = $settings['title_tag'];
        $title_alignment = $settings['title_alignment'];
        $title_style = $settings['title_style'];
        $title_color = $settings['title_color'];
        $title = $settings['title'];
        ?>
        <div class="title_box style1" style="display: inline-flex; align-items: center;">
            <div class="before_title" style="height: 25px; width: 5px; background-color: rgb(219, 17, 17); display: inline-flex; margin-right: 10px; border-radius: 5px;"></div>
            <<?php echo $title_tag; ?> style="color: <?php echo $title_color; ?>; text-align: <?php echo $title_alignment; ?>; font-weight: <?php echo ($title_style == 'bold' ? 'bold' : 'normal'); ?>; font-style: <?php echo ($title_style == 'italic' ? 'italic' : 'normal'); ?>; text-decoration: <?php echo ($title_style == 'underline' ? 'underline' : ($title_style == 'strikethrough' ? 'line-through' : 'none')); ?>;">
                <?php echo $title; ?>
            </<?php echo $title_tag; ?>>
        </div>
        <?php
    }
}

// Register widget and enqueue styles here...

