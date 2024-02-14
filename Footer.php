<?php  wp_footer();
 $footer_block = get_post(809); // Replace 765 with the actual ID of your footer block post
 if ($footer_block && $footer_block->post_type == 'footer-block') {
     echo $footer_block->post_content;
 }
?>

       
        
