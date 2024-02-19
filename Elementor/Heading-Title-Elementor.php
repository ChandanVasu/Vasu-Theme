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

    public function get_name() {
        return 'custom-title';
    }

    public function get_title() {
        return __('Custom Title', 'custom-title-widget');
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['Vasu X'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'custom-title-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'custom-title-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Enter your title here', 'custom-title-widget'),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'custom-title-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => __('H1', 'custom-title-widget'),
                    'h2' => __('H2', 'custom-title-widget'),
                    'h3' => __('H3', 'custom-title-widget'),
                    'h4' => __('H4', 'custom-title-widget'),
                    'h5' => __('H5', 'custom-title-widget'),
                    'h6' => __('H6', 'custom-title-widget'),
                    'div' => __('DIV', 'custom-title-widget'),
                    'span' => __('SPAN', 'custom-title-widget'),
                ],
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => __('Title Alignment', 'custom-title-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'custom-title-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'custom-title-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'custom-title-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'title_style',
            [
                'label' => __('Title Style', 'custom-title-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => __('Normal', 'custom-title-widget'),
                    'bold' => __('Bold', 'custom-title-widget'),
                    'italic' => __('Italic', 'custom-title-widget'),
                    'underline' => __('Underline', 'custom-title-widget'),
                    'strikethrough' => __('Strikethrough', 'custom-title-widget'),
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'custom-title-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'title_box_style',
            [
                'label' => __('Title Box Style', 'custom-title-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'custom-title-widget'),
                    'style1' => __('Style 1', 'custom-title-widget'),
                    'style2' => __('Style 2', 'custom-title-widget'),
                    // Add more styles here if needed
                ],
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title_tag = $settings['title_tag'];
        $title_alignment = $settings['title_alignment'];
        $title_style = $settings['title_style'];
        $title_color = $settings['title_color'];
        $title = $settings['title'];

        // Render title style box if selected
        $title_box_style = $settings['title_box_style'];
        $title_box_html = '';
        if ($title_box_style == 'style1') {
            $title_box_html = '<div class="title_box" style="display: inline-flex; align-items: center;">
                <div class="before_title" style="height: 25px; width: 5px; background-color: rgb(219, 17, 17); display: inline-flex; margin-right: 10px; border-radius: 5px;"></div>
                
                <' . $title_tag . ' style="color: ' . $title_color . '; font-weight: ' . ($title_style == 'bold' ? 'bold' : 'normal') . '; font-style: ' . ($title_style == 'italic' ? 'italic' : 'normal') . '; text-decoration: ' . ($title_style == 'underline' ? 'underline' : ($title_style == 'strikethrough' ? 'line-through' : 'none')) . ';">' . $title . '</' . $title_tag . '>
            </div>';
        } elseif ($title_box_style == 'style2') {
            // Add another style here if needed
        } else {
            // Default style without title box
            echo '<' . $title_tag . ' style="text-align: ' . $title_alignment . '; color: ' . $title_color . '; font-weight: ' . ($title_style == 'bold' ? 'bold' : 'normal') . '; font-style: ' . ($title_style == 'italic' ? 'italic' : 'normal') . '; text-decoration: ' . ($title_style == 'underline' ? 'underline' : ($title_style == 'strikethrough' ? 'line-through' : 'none')) . ';">' . $title . '</' . $title_tag . '>';
            return;
        }

        echo $title_box_html;
    }

}