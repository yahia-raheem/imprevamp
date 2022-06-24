<?php
get_header();
?>
<header class="page-header second-level">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="<?php echo home_url('/big-ideas/') ?>">
                    <i class="icon-left-chevron"></i>
                    <span class="prefix">
                        <?php _e('Back to Big Ideas'); ?>
                    </span>
                </a>
                <h1 class="title">
                    <?php echo get_the_title(); ?>
                </h1>
                <div class="date">
                    <?php echo get_the_date('j F, Y'); ?>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="thumbnail-wrapper">
    <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'bg-image']) ?>
</header>

<main class="single-post">
    <?php the_content() ?>
</main>

<?php
get_footer()
?>