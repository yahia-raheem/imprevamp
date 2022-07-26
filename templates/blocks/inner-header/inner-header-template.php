<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'inner-header-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'inner-header ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$bgImage = mb_get_block_field('background_image');
?>
<section id="<?= $id ?>" class="<?= $class ?>">
    <?php echo wp_get_attachment_image($bgImage['ID'], 'full', false, ['class' => 'bg-image']); ?>
    <div class="vail"></div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-column justify-content-start align-items-center content-col">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <InnerBlocks allowedBlocks="<?= esc_attr(json_encode([
                                                'bcn/breadcrumb-trail',
                                            ])) ?>"/>
                </div>
            </div>
        </div>
    </div>
</section>