<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'accordion-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

$accordions     = mb_get_block_field('accordions');

// Custom CSS class name.
$class = 'accordion ' . ($attributes['className'] ?? '');
?>

<section id="<?= $id ?>" class="<?= $class ?> imp-accordion-wrapper pt-5">
    <div class="container">
        <div class="row">
            <div class="imp-accordion-section col-md-10 offset-md-1">
                <?php foreach ($accordions as $index => $accordion) : ?>
                    <div class="imp-accordion-list">
                        <div class="accordion"><?php echo do_shortcode(wpautop($accordion['title'])); ?></div>
                        <div class="panel">
                            <?php echo do_shortcode(wpautop($accordion['description'])); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>