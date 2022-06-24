<?php
get_header();

$post_client = rwmb_meta('post_ki2pztgz4g');
$post_service = rwmb_meta('work_service');
$post_industries = wp_get_object_terms(get_the_ID(), 'industry', array('fields' => 'names'));

?>
<header class="page-header second-level single-work">
    <div class="container">
        <a href="<?php echo home_url('/work/') ?>">
            <i class="icon-left-chevron"></i>
            <span class="prefix">
                <?php _e('Back to Work'); ?>
            </span>
        </a>

        <div class="row title-wrapper">
            <div class="col-lg-10">
                <h1 class="title">
                    <?php echo get_the_title(); ?>
                </h1>
            </div>

            <div class="col-lg-2">
                <div class="client-logo">
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($post_client), 'thumbnail', false); ?>
                </div>
            </div>
        </div>

        <div class="categories-wrapper">
            <div class="categories">
                <span><?php echo get_the_title($post_service); ?></span>
                <?php foreach ($post_industries as $industry) : ?>
                    <span class="industry tag"><?php echo $industry; ?></span>
                <?php endforeach; ?>
            </div>
            <div class="client-logo">
                <?php echo wp_get_attachment_image(get_post_thumbnail_id($post_client), 'thumbnail', false); ?>
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