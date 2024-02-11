<?php
// Define the custom Elementor widget class
class Grid_Post_1 extends \Elementor\Widget_Base {

    // Define widget name and title
    public function get_name() {
        return 'Grid_Post_1';
    }

    public function get_title() {
        return __( 'Grid Post 1 Vasu Theme', 'vasutheme' );
    }

    // Define widget icon
    public function get_icon() {
        return 'eicon-post-list';
    }

    // Define widget categories
    public function get_categories() {
        return [ 'VASU-X' ];
    }

    // Define content to be displayed in the widget
    protected function render() {
        $settings = $this->get_settings();

        // Query posts
        $query_args = [
            'post_type' => 'post',
            'posts_per_page' => isset($settings['posts_per_page']) ? $settings['posts_per_page'] : 5, // Number of posts to display
            'offset' => isset($settings['offset']) ? $settings['offset'] : 0, // Post offset
        ];

        $posts_query = new WP_Query( $query_args );

        // Display posts
        if ( $posts_query->have_posts() ) :
            while ( $posts_query->have_posts() ) : $posts_query->the_post();
                ?>
                <div class="el-g-1-custom-post-item-vasutheme">
                    <?php if ($settings['show_image']) : ?>
                        <div class="el-g-1-post-thumbnail-vasutheme">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="el-g-1_post-meta-vasutheme">
                        <?php if ($settings['show_category']) : ?>
                            <span class="el-g-1-category-meta-vasutheme"><?php the_category(', '); ?></span>
                        <?php endif; ?>
                        <span class="el-g-1_author-meta-vasutheme">By <?php the_author(); ?></span>
                        <span class="el-g-1-date-meta-vasutheme">Posted on <?php echo get_the_date(); ?></span>
                    </div>
                    <?php if ($settings['show_title']) : ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php endif; ?>
                    <?php if ($settings['show_content']) : ?>
                        <div class="el-g-1-post-content-vasutheme">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata(); // Reset post data
        else :
            echo __( 'No posts found', 'vasutheme' );
        endif;
    }

    // Define widget settings fields
    protected function _register_controls() {
        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'vasutheme' ),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts Per Page', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5, // Default number of posts to display
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __( 'Post Offset', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0, // Default offset value
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'vasutheme' ),
                // 'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label' => __( 'Show Image', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => __( 'Show Category', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => __( 'Show Title', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_content',
            [
                'label' => __( 'Show Content', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Post Style Subsection
        $this->start_controls_section(
            'section_post_style',
            [
                'label' => __( 'Post Style', 'vasutheme' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Image Border Radius', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .el-g-1-post-thumbnail-vasutheme img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => __( 'Author Color', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000', // Default color value
                'selectors' => [
                    '{{WRAPPER}} .el-g-1-author-meta-vasutheme' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Content Color', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333', // Default color value
                'selectors' => [
                    '{{WRAPPER}} .el-g-1-post-content-vasutheme' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Content Typography', 'vasutheme' ),
                'selector' => '{{WRAPPER}} .el-g-1-post-content-vasutheme',
            ]
        );

        $this->end_controls_section();
    }
}
?>
