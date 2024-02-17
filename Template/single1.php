<?php
/**
 * Template Name: Single Post Style 1
 * Template Post Type: post
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>
</head>
<body>

    <main>
        <!-- Single post content -->
        <article>
            <h2><?php the_title(); ?></h2>
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    </main>
    
</body>
</html>
