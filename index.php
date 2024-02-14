<?php get_header(); ?>

<div id="content">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_title('<h2>', '</h2>');
            the_content();
        endwhile;
    endif;
    ?>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
    </style>
</div>

<?php get_footer(); ?>