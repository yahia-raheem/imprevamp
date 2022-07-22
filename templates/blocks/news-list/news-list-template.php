<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'news-list-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'news-list ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$filter = mb_get_block_field('filter_shown_news');
$categories = mb_get_block_field('taxonomy_advanced_z1yrusenrkn');
$customNews = mb_get_block_field('news');
$liveRecorded = mb_get_block_field('live_recorded_filter');
$numOfPosts = mb_get_block_field('number_of_posts');



$args = [
    'post_type' => 'post',
];
if (($numOfPosts != -1 || $filter == 'all') && $filter != 'custom') {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args['posts_per_page'] = $filter != 'all' ? $numOfPosts : get_option('posts_per_page');
    $args['paged'] = $paged;
}
if ($filter == 'category' && count($categories) != 0) {
    $args['tax_query'] = array(
        'relation' => 'OR',
    );
    foreach ($categories as $category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'terms'    => $category->term_id
        );
    }
} else if ($filter == 'custom') {
    $args['post__in'] = $customNews;
}

$postslist = new WP_Query($args);
?>
<div id="<?= $id ?>" class="<?= $class ?>">
    <div class="container">
        <div class="row">
            <?php
            if ($postslist->have_posts()) :
                while ($postslist->have_posts()) : $postslist->the_post();
            ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <?php
                            get_template_part('templates/parts/news', 'card', [
                                'post_id' => get_the_ID()
                            ]);    
                        ?>
                    </div>
                <?php endwhile; ?>

        </div>
        <?php if (($numOfPosts != -1 || $filter == 'all') && $filter != 'custom') :  ?>
            <div class="row">
                <div class="col-12">
                    <?php echo my_pagination($postslist->max_num_pages); ?>
                </div>
            </div>
    <?php
                endif;
                wp_reset_postdata();
            endif;
    ?>
    </div>
</div>