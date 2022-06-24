<?php
get_header();
?>
<header class="page-header second-level" id="main-title">
    <div class="container">
        <div class="row">

            <a class="back-btn" href="<?php echo home_url('/services/') ?>">
                <i class="icon-left-chevron"></i>
                <span class="prefix">
                    <?php _e('Back to Services'); ?>
                </span>
            </a>

            <div class="title-wrapper">
                <h1 class="title">
                    <?php echo get_the_title(); ?>
                </h1>

                <a class="btn btn-secondary" href="<?php echo home_url('/contact-us/') ?>">Let's Talk</a>
            </div>

            <!-- categries -->
            <?php
            $terms = get_the_terms(get_the_ID(), 'service-type'); // <--- change cpt with the custom post type
            if (!empty($terms)) :
            ?>
                <ul>
                    <?php
                    foreach ($terms as $term) :
                    ?>
                        <li><?php echo $term->name ?></li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            <?php
            endif;
            ?>
        </div>
    </div>
</header>

<div class="sticky-header" id="sticky-header">
    <div class="container">
        <div class="title-wrapper">
            <h1 class="title">
                <?php echo get_the_title(); ?>
            </h1>

            <a class="btn btn-secondary" href="<?php echo home_url('/contact-us/') ?>">Let's Talk</a>
        </div>
    </div>
</div>

<?php
if (wp_get_attachment_image(get_post_thumbnail_id())) :
?>
    <header class="thumbnail-wrapper">
        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'bg-image']) ?>
    </header>
<?php
endif;
?>

<main class="single-service-post">
    <?php the_content() ?>
</main>

<?php
get_footer()
?>