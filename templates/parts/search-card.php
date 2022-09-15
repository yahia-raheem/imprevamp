<?php
$postId = $args['post_id'];
$term_list = wp_get_post_terms($postId, 'blog-category');
?>
<div class="news-card">
    <div class="content">
        <div class="meta">
            <div class="date">
                <i class="fa-solid fa-calendar"></i>
                <?php echo get_the_date('F j,Y', $postId); ?>
            </div>
            <div class="sep">/</div>
        </div>

        <h3 class="title"><?php echo get_the_title($postId); ?></h3>
        <p class="excerpt">
        <?php echo imp_string_limit_words(get_the_excerpt(), 25);?> &hellip;</p>
        <a href="<?php echo get_the_permalink($postId); ?>" class="read-more"><?php _e('Read More', 'imp'); ?></a>
    </div>
</div>