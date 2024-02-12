<?php
// Define the custom Elementor widget class
class Grid_Post_2 extends \Elementor\Widget_Base
{
    // Define widget name and title
    public function get_name()
    {
        return 'Grid_Post_2';
    }

    public function get_title()
    {
        return __('Grid Post 2 Vasu Theme', 'vasutheme');
    }

    // Define widget icon
    public function get_icon()
    {
        return 'eicon-post-list';
    }

    // Define widget categories
    public function get_categories()
    {
        return ['VASU-X'];
    }

    // Define content to be displayed in the widget
    protected function render()
    {
        $settings = $this->get_settings();

        // Query posts
        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => isset($settings['posts_per_page']) ? $settings['posts_per_page'] : 5, // Number of posts to display
            'category__in' => isset($settings['category']) ? $settings['category'] : [],
            'offset'         => isset($settings['offset']) ? $settings['offset'] : 0, // Post offset
        ];

        $posts_query = new WP_Query($query_args);

        // Display posts
        if ($posts_query->have_posts()) :
            ?>
            <div class="el-g-2-grid-container">
                <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                    <div class="el-g-2-custom-post-item-vasutheme">
                        <?php if ($settings['show_image']) : ?>
                            <div class="el-g-2-post-thumbnail-vasutheme">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['show_category']) : ?>
                            <span class="el-g-2-category-meta-vasutheme"><?php the_category(', '); ?></span>
                        <?php endif; ?>
                        <?php if ($settings['show_title']) : ?>
                            <h2 class="el-g-2-post-title-vasutheme"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['title_length'], '...'); ?></a></h2>
                        <?php endif; ?>
    
                        <?php if ($settings['show_content']) : ?>
                            <div class="el-g-2-post-content-vasutheme">
                                <?php echo wp_trim_words(get_the_content(), $settings['content_length'], '...'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['show_meta']) : ?>
                            <div class="el-g-2-post-meta-vasutheme">
                                <?php
                                $author_id = get_the_author_meta('ID');
                                $author_avatar = get_avatar_url($author_id, ['size' => 32]);
                                ?>
                                <?php if ($settings['author_image']) : ?>
                                    <img class="el-g-2-author-avatar-vasutheme" src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr(get_the_author()); ?>" >
                                <?php endif; ?>
                                <a  class="el-g-2-name-meta-vasutheme" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php the_author(); ?></a>
                                <span class="el-g-2-date-meta-vasutheme"><?php echo get_the_date(); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); // Reset post data
        else :
            echo __('No posts found', 'vasutheme');
        endif;
    }


    // Define widget settings fields
    protected function _register_controls()
    {
        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'vasutheme'),
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => __('Select Category', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_all_categories_options(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __('Posts Per Page', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 8, // Default number of posts to display
            ]
        );

        $this->add_control(
            'offset',
            [
                'label'   => __('Post Offset', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 0, // Default offset value
            ]
        );

        $this->add_control(
            'title_length',
            [
                'label'   => __('Title Length', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 10, // Default number of words to display in title
            ]
        );

        $this->add_control(
            'content_length',
            [
                'label'   => __('Content Length', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 20, // Default number of words to display in content
            ]
        );

        $this->add_responsive_control(
            'items_per_row_desktop',
            [
                'label'     => __('Items Per Row (Desktop)', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 4, // Default number of items per row on desktop
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-grid-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'vasutheme'),
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label'   => __('Show Image', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label'   => __('Show Category', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_meta',
            [
                'label'   => __('Show Meta', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'   => __('Show Title', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'author_image',
            [
                'label'   => __('Author Image', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_content',
            [
                'label'   => __('Show Content', 'vasutheme'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Post Style Subsection
        $this->start_controls_section(
            'section_post_style',
            [
                'label' => __('Post Style', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'     => __('Image Border Radius', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-post-thumbnail-vasutheme img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'transform_hover',
            [
                'label' => __('Hover Transform', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    'px' => [
                        'min' => 0.5,
                        'max' => 2,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'unit' => '',
                    'size' => 1.03,
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme:hover' => 'transform: scale({{SIZE}});',
                ],
            ]
        );
        

        $this->end_controls_section();

        // Title Style Section
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-post-title-vasutheme a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_text_decoration',
            [
                'label' => __('Title Text Decoration (Hover)', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'vasutheme'),
                    'underline' => __('Underline', 'vasutheme'),
                    'overline' => __('Overline', 'vasutheme'),
                    'line-through' => __('Line Through', 'vasutheme'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-post-title-vasutheme:hover ' => 'text-decoration: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_text_color',
            [
                'label' => __('Title Text Color (Hover)', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-post-title-vasutheme:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-g-2-post-title-vasutheme a',
            ]
        );

        $this->end_controls_section();

        // Category Style Section
        $this->start_controls_section(
            'section_category_style',
            [
                'label' => __('Category', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_text_color',
            [
                'label'     => __('Category Text Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-category-meta-vasutheme a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_bg_color',
            [
                'label'     => __('Category Background Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-category-meta-vasutheme a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'category_typography',
                'label'    => __('Category Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-g-2-category-meta-vasutheme',
            ]
        );

        $this->end_controls_section();

        // Author Style Section
        $this->start_controls_section(
            'section_author_style',
            [
                'label' => __('Author', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label'     => __('Author Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-post-meta-vasutheme a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'author_typography',
                'label'    => __('Author Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-g-2-post-meta-vasutheme a',
            ]
        );

        $this->end_controls_section();

        // Date Style Section
        $this->start_controls_section(
            'section_date_style',
            [
                'label' => __('Date', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'label'    => __('Date Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-g-2-date-meta-vasutheme',
            ]
        );

        $this->end_controls_section();

        // Content Style Section
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Content Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-post-content-vasutheme' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => __('Content Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-g-2-post-content-vasutheme',
            ]
        );

        $this->end_controls_section();

        // Container Style Section
        $this->start_controls_section(
            'section_container_style',
            [
                'label' => __('Container', 'vasutheme'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __('Border Color', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __('Border Width', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_style',
            [
                'label' => __('Border Style', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'solid' => __('Solid', 'vasutheme'),
                    'dotted' => __('Dotted', 'vasutheme'),
                    'dashed' => __('Dashed', 'vasutheme'),
                    'double' => __('Double', 'vasutheme'),
                    'groove' => __('Groove', 'vasutheme'),
                    'ridge' => __('Ridge', 'vasutheme'),
                    'inset' => __('Inset', 'vasutheme'),
                    'outset' => __('Outset', 'vasutheme'),
                    'none' => __('None', 'vasutheme'),
                    'hidden' => __('Hidden', 'vasutheme'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __('Background Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme',
            ]
        );

        $this->end_controls_section();

    }

    private function get_all_categories_options()
    {
        $categories = get_categories();
        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
        return $options;
    }
}
