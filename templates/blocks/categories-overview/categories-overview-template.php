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
?>
<div id="<?= $id ?>" class="<?= $class ?>">
    <div class="container">
        <div class="row">
            <?php foreach ($categories as $category) : ?>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-12">
                    <div class="icon-card light has-shadow p-lg">
                        <div class="icon">
                            <?php
                            $icon = get_term_meta($category->term_id, 'font_awesome_classes', true);
                            ?>
                            <i class="<?php echo $icon; ?>"></i>
                        </div>
                        <div class="content">
                            <a href="<?php echo get_term_link($category, 'course-category'); ?>">
                                <h3 class="name">
                                    <?php echo $category->name; ?>
                                </h3>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>