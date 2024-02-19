<?php
// Register the custom Elementor widget
class Single_Post_Content_Widget extends \Elementor\Widget_Base {

    // Widget Name
    public function get_name() {
        return 'single-post-content';
    }

    // Widget Title
    public function get_title() {
        return __( 'Single Post Content', 'vasutheme' );
    }

    // Widget Icon
    public function get_icon() {
        return 'eicon-post-content';
    }

    // Widget Category
    public function get_categories() {
        return [ 'Vasu X' ];
    }

    // Render Widget Output
    protected function render() {
        global $post;

        // Check if it's a single post
        if ( is_singular( 'post' ) ) {
            setup_postdata( $post );
            echo '<div class="el-single-post-content-vasutheme">' . get_the_content() . '</div>';
            wp_reset_postdata();
        } else {
            echo '<h1>This Is Demo Heading</h1>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Vivamus in massa nunc. Morbi bibendum purus sit amet quam venenatis, sit amet faucibus quam fermentum. Fusce ac aliquet metus, sit amet consectetur arcu. Vestibulum sit amet condimentum ligula. In hac habitasse platea dictumst. Nulla suscipit, ex eu aliquam tincidunt, justo libero feugiat lectus, non dapibus risus sapien sit amet est. Vestibulum non ante in odio aliquam ultricies a in lorem. Fusce lobortis lectus quis interdum consectetur. Vestibulum sagittis tristique lorem vitae vehicula. Vestibulum eget felis eros. Fusce ut nisi at eros commodo euismod. Sed hendrerit lacinia eros, vel commodo arcu efficitur in. Ut auctor magna quis nibh cursus, vel finibus lorem consectetur.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Vivamus in massa nunc. Morbi bibendum purus sit amet quam venenatis, sit amet faucibus quam fermentum. Fusce ac aliquet metus, sit amet consectetur arcu. Vestibulum sit amet condimentum ligula. In hac habitasse platea dictumst. Nulla suscipit, ex eu aliquam tincidunt, justo libero feugiat lectus, non dapibus risus sapien sit amet est. Vestibulum non ante in odio aliquam ultricies a in lorem. Fusce lobortis lectus quis interdum consectetur. Vestibulum sagittis tristique lorem vitae vehicula. Vestibulum eget felis eros. Fusce ut nisi at eros commodo euismod. Sed hendrerit lacinia eros, vel commodo arcu efficitur in. Ut auctor magna quis nibh cursus, vel finibus lorem consectetur.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Vivamus in massa nunc. Morbi bibendum purus sit amet quam venenatis, sit amet faucibus quam fermentum. Fusce ac aliquet metus, sit amet consectetur arcu. Vestibulum sit amet condimentum ligula. In hac habitasse platea dictumst. Nulla suscipit, ex eu aliquam tincidunt, justo libero feugiat lectus, non dapibus risus sapien sit amet est. Vestibulum non ante in odio aliquam ultricies a in lorem. Fusce lobortis lectus quis interdum consectetur. Vestibulum sagittis tristique lorem vitae vehicula. Vestibulum eget felis eros. Fusce ut nisi at eros commodo euismod. Sed hendrerit lacinia eros, vel commodo arcu efficitur in. Ut auctor magna quis nibh cursus, vel finibus lorem consectetur.
            </p>
            
            <h2>Demo Heading</h2>
            <p>
            Sed consectetur lobortis orci, non vehicula sem tristique eget. Duis feugiat, ex vitae cursus bibendum, risus est sodales velit, at vestibulum eros metus et justo. Sed eget eros et quam ultricies rhoncus at a ex. Sed euismod, nisi id rhoncus efficitur, odio ligula feugiat dui, a iaculis justo sem ac ex. Integer vitae congue sapien. Ut faucibus, risus nec efficitur consequat, odio lorem commodo ipsum, nec iaculis est velit nec dolor. Maecenas commodo magna ac quam rutrum, quis finibus risus tincidunt. Integer posuere vel mi ac pharetra. Phasellus id tristique leo. Duis maximus est et quam consequat, in tincidunt elit pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Vivamus in massa nunc. Morbi bibendum purus sit amet quam venenatis, sit amet faucibus quam fermentum. Fusce ac aliquet metus, sit amet consectetur arcu. Vestibulum sit amet condimentum ligula. In hac habitasse platea dictumst. Nulla suscipit, ex eu aliquam tincidunt, justo libero feugiat lectus, non dapibus risus sapien sit amet est. Vestibulum non ante in odio aliquam ultricies a in lorem. Fusce lobortis lectus quis interdum consectetur. Vestibulum sagittis tristique lorem vitae vehicula. Vestibulum eget felis eros. Fusce ut nisi at eros commodo euismod. Sed hendrerit lacinia eros, vel commodo arcu efficitur in. Ut auctor magna quis nibh cursus, vel finibus lorem consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Vivamus in massa nunc. Morbi bibendum purus sit amet quam venenatis, sit amet faucibus quam fermentum. Fusce ac aliquet metus, sit amet consectetur arcu. Vestibulum sit amet condimentum ligula. In hac habitasse platea dictumst. Nulla suscipit, ex eu aliquam tincidunt, justo libero feugiat lectus, non dapibus risus sapien sit amet est. Vestibulum non ante in odio aliquam ultricies a in lorem. Fusce lobortis lectus quis interdum consectetur. Vestibulum sagittis tristique lorem vitae vehicula. Vestibulum eget felis eros. Fusce ut nisi at eros commodo euismod. Sed hendrerit lacinia eros, vel commodo arcu efficitur in. Ut auctor magna quis nibh cursus, vel finibus lorem consectetur.
            </p>';
        }
    }

    // Register Widget Controls
    protected function _register_controls() {

         // Typography Style Section
         $this->start_controls_section(
            'typography_style_section',
            [
                'label' => __( 'Typography Style', 'vasutheme' ),
                // 'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} h1',
            ]
        );

        // Heading 2 Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'h2_typography',
                'label'    => __( 'Heading 2 Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} h2',
            ]
        );

        // Heading 3 Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'h3_typography',
                'label'    => __( 'Heading 3 Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} h3',
            ]
        );

        // Heading 4 Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'h4_typography',
                'label'    => __( 'Heading 4 Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} h4',
            ]
        );

        // Heading 5 Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'h5_typography',
                'label'    => __( 'Heading 5 Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} h5',
            ]
        );

        // Paragraph Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'paragraph_typography',
                'label'    => __( 'Paragraph Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} p',
            ]
        );

        // Link Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'link_typography',
                'label'    => __( 'Link Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} a',
            ]
        );

        $this->end_controls_section();

        // Content Style Section
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => __( 'Content Style', 'vasutheme' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Heading Color Control
        $this->add_control(
            'heading_color_h1',
            [
                'label'     => __( 'H1 Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h1' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_h2',
            [
                'label'     => __( 'H2 Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_h3',
            [
                'label'     => __( 'H3 Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_h4',
            [
                'label'     => __( 'H4 Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_h5',
            [
                'label'     => __( 'H5 Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color_h6',
            [
                'label'     => __( 'H6 Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Paragraph Color Control
        $this->add_control(
            'paragraph_color',
            [
                'label'     => __( 'Paragraph Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Link Color Control
        $this->add_control(
            'link_color',
            [
                'label'     => __( 'Link Color', 'vasutheme' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

       
        // Margin Style Section
        $this->start_controls_section(
            'margin_style_section',
            [
                'label' => __( 'Margin Style', 'vasutheme' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Heading 1 Margin Control
        $this->add_control(
            'h1_margin',
            [
                'label' => __( 'Heading 1 Margin', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} h1' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        // Heading 2 Margin Control
        $this->add_control(
            'h2_margin',
            [
                'label' => __( 'Heading 2 Margin', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} h2' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        // Heading 3 Margin Control
        $this->add_control(
            'h3_margin',
            [
                'label' => __( 'Heading 3 Margin', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} h3' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        // Paragraph Margin Control
        $this->add_control(
            'paragraph_margin',
            [
                'label' => __( 'Paragraph Margin', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} p' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __( 'Image Style', 'vasutheme' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Image Margin Control
        $this->add_control(
            'image_margin',
            [
                'label' => __( 'Image Margin', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} img' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Image Width', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ], // Add devices option
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'separator' => 'before', // Add separator option
            ]
        );
        
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Image Height', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ], // Add devices option
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'separator' => 'before', // Add separator option
            ]
        );
        
    // Image Border Radius Control
    $this->add_control(
        'image_border_radius',
        [
            'label' => __( 'Image Border Radius', 'vasutheme' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} img' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );


        $this->end_controls_section();
    }

}

