<?php

/**
 * Template Name: Inner Page (With Footer Form)
 *
 */
get_header();
$pageTitle = rwmb_meta('page_title');
global $post;
$post_slug = $post->post_name;
?>
<header class="page-header first-level <?php echo $post_slug; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="prefix">
                    <?php echo get_the_title(); ?>
                </span>
                <h1 class="title">
                    <?php echo $pageTitle; ?>
                </h1>
            </div>
        </div>
    </div>
</header>
<?php
the_content();
get_footer();
?>