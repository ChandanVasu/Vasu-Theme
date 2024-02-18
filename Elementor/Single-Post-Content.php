<?php
// Register the custom Elementor widget
class Single_Post_Content_Widget extends \Elementor\Widget_Base {

    // Widget Name
    public function get_name() {
        return 'single-post-content';
    }

    // Widget Title
    public function get_title() {
        return __( 'Single Post Content', 'text-domain' );
    }

    // Widget Icon
    public function get_icon() {
        return 'eicon-post-content';
    }

    // Widget Category
    public function get_categories() {
        return [ 'basic' ];
    }

    // Render Widget Output
    protected function render() {
        global $post;

        // Check if it's a single post
        if ( is_singular( 'post' ) ) {
            setup_postdata( $post );
            echo '<div class="single-post-content">' . get_the_content() . '</div>';
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
}
