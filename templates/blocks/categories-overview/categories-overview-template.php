<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'categories-overview-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'categories-overview ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$categories = mb_get_block_field('course_category');
$title = mb_get_block_field('block_title');
$subtitle = mb_get_block_field('block_subtitle');
?>
<section id="<?= $id ?>" class="<?= $class ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <div class="main">
                        <h2><?php echo $title; ?></h2>
                        <p><?php echo $subtitle; ?></p>
                    </div>
                    <div class="cta">
                        <a href="#" class="btn"><span><?php _e('Explore more', 'imp'); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="category-container">
                    <?php foreach ($categories as $category) : ?>
                        <div class="category-block">
                            <div class="icon">
                                <?php 
                                $icon = get_term_meta($category->term_id, 'font_awesome_classes', true);
                                ?>
                                <i class="<?php echo $icon; ?>"></i>
                            </div>
                            <a href="<?php echo get_term_link($category, 'course-category'); ?>"></a>
                            <h3 class="name">
                                <?php echo $category->name; ?>
                            </h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>