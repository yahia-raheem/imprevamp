<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'imp-content-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'imp-content ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$paddingTop = mb_get_block_field('padding_top');
$paddingBottom = mb_get_block_field('padding_bottom');
$bgColor = mb_get_block_field('background_color');
?>
<section id="<?= $id ?>" class="<?= $class ?>"
    style="padding-top: <?php echo $paddingTop; ?>px; padding-bottom: <?php echo $paddingBottom; ?>px; background-color: <?php echo $bgColor; ?>;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <InnerBlocks />
            </div>
        </div>
    </div>
</section>