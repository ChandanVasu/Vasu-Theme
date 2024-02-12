<?php
// Define the custom Elementor widget class
class List_Post_1 extends \Elementor\Widget_Base
{
    // Define widget name and title
    public function get_name()
    {
        return 'List_Post_1';
    }

    public function get_title()
    {
        return __('List Post 1 Vasu Theme', 'vasutheme');
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
            <div class="el-l-1-list-container">
                <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                    <div class="el-l-1-custom-post-item-vasutheme">
                        <?php if ($settings['show_image']) : ?>
                            <div class="el-l-1-post-thumbnail-vasutheme">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("full"); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['show_category']) : ?>
                            <span class="el-l-1-category-meta-vasutheme"><?php the_category(', '); ?></span>
                        <?php endif; ?>
                        <?php if ($settings['show_title']) : ?>
                            <h2 class="el-l-1-post-title-vasutheme"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['title_length'], '...'); ?></a></h2>
                        <?php endif; ?>
    
                        <?php if ($settings['show_content']) : ?>
                            <div class="el-l-1-post-content-vasutheme">
                                <?php echo wp_trim_words(get_the_content(), $settings['content_length'], '...'); ?>
                            </div>
    
                            <div class="el-l-1-post-meta-vasutheme">
                                <?php
                                $author_id = get_the_author_meta('ID');
                                $author_avatar = get_avatar_url($author_id, ['size' => 32]);
                                ?>
                                <img class="el-l-1-author-avatar-vasutheme" src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr(get_the_author()); ?>" >
                                <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php the_author(); ?></a> ||
                                <span class="el-l-1-date-meta-vasutheme"><?php echo get_the_date(); ?></span>
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
            'show_title',
            [
                'label'   => __('Show Title', 'vasutheme'),
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
                    '{{WRAPPER}} .el-l-1-post-thumbnail-vasutheme img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label'     => __('Author Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                //'default'   => '#000', // Default color value
                'selectors' => [
                    '{{WRAPPER}} .el-l-1-post-meta-vasutheme a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                //'default'   => '#000', // Default color value
                'selectors' => [
                    '{{WRAPPER}} .el-l-1-post-title-vasutheme a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __('Background Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
               // 'default'   => '#000', // Default color value
                'selectors' => [
                    '{{WRAPPER}} .el-l-1-custom-post-item-vasutheme' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Content Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                //'default'   => '#333', // Default color value
                'selectors' => [
                    '{{WRAPPER}} .el-l-1-post-content-vasutheme' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => __('Content Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-l-1-post-content-vasutheme',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-l-1-post-title-vasutheme a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'author_typography',
                'label'    => __('Author Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-l-1-post-meta-vasutheme a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'label'    => __('Date Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-l-1-date-meta-vasutheme',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'category_typography',
                'label'    => __('Category Typography', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-l-1-category-meta-vasutheme',
            ]
        );


        $this->add_control(
            'category_text_color',
            [
                'label'     => __('Category Text Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-l-1-category-meta-vasutheme a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_bg_color',
            [
                'label'     => __('Category Background Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-l-1-category-meta-vasutheme a' => 'background-color: {{VALUE}};',
                ],
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
