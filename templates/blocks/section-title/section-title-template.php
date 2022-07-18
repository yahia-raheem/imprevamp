<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'section-title-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'section-title ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$title = mb_get_block_field('section_title');
$subtitle = mb_get_block_field('section_subtitle');
$buttonLink = mb_get_block_field('call_to_action');
$hasPadding = mb_get_block_field('has_padding');
?>
<section id="<?= $id ?>" class="<?= $class ?> <?php if ($hasPadding): ?> has-padding <?php endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title d-flex flex-wrap <?php if ($buttonLink): ?>justify-content-between <?php else: ?>justify-content-center <?php endif; ?> align-items-center">
                    <div class="main d-flex flex-column justify-content-start <?php if ($buttonLink): ?>align-items-start <?php else: ?>align-items-center <?php endif; ?>">
                        <h2><?php echo $title; ?></h2>
                        <p><?php echo $subtitle; ?></p>
                    </div>
                    <?php if ($buttonLink) : ?>
                        <div class="cta">
                            <a href="<?php echo get_the_permalink($buttonLink); ?>" class="btn"><span><?php _e('Explore more', 'imp'); ?></span></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <InnerBlocks allowedBlocks="<?= esc_attr(json_encode([
                                                'meta-box/categories-overview-block',
                                                'meta-box/courses-list-block'
                                            ])) ?>"/>
</section>