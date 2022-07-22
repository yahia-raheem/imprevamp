<?php
$postId = $args['post_id'];
?>
<div class="news-card">
    <div class="news-image img-container">
        <a href="<?php echo get_the_permalink($postId); ?>" class="clickable-space"></a>
        <?php echo wp_get_attachment_image(get_post_thumbnail_id($postId), 'large', false, ['class' => 'bg-image']); ?>
    </div>
    <div class="content">
        <div class="meta">
            <div class="date">
                <i class="fa-solid fa-calendar"></i>
                <?php echo get_the_date('F j,Y', $postId); ?>
            </div>
            <div class="sep">/</div>
            <div class="category">
                <i class="fa-solid fa-tag"></i>
                <?php echo get_the_category($postId)[0]->name; ?>
            </div>
        </div>

        <h3 class="title"><?php echo get_the_title($postId); ?></h3>
        <p class="excerpt"><?php echo get_the_excerpt($postId); ?></p>
        <a href="<?php echo get_the_permalink($postId); ?>" class="read-more"><?php _e('Read More', 'imp'); ?></a>
    </div>
</div>