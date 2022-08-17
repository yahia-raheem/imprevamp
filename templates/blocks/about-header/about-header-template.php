<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'about-header-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'about-header ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$image = mb_get_block_field('block_image');
$prefix = mb_get_block_field('prefix');
$title = mb_get_block_field('title');
$description = mb_get_block_field('description');
$bulletPoints = mb_get_block_field('bullet_point');
$button = mb_get_block_field('button');
?>
<section id="<?= $id ?>" class="<?= $class ?> imp-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="img-container">
                    <?php echo wp_get_attachment_image($image['ID'], 'full', false, ['class' => 'bg-image']); ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-center">
                <div class="block-content">
                    <span class="prefix"><?php echo $prefix; ?></span>
                    <h2 class="title"><?php echo $title; ?></h2>
                    <p class="description"><?php echo $description; ?></p>
                    <ul class="bullets">
                        <?php foreach ($bulletPoints as $bullet) : ?>
                            <li>
                                <div class="check">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <?php echo $bullet; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($button) : ?>
                        <a href="<?php if ($button['use_custom_link'] == true) : echo $button['button_custom_link'];
                                    else : echo get_the_permalink($button['button_post']);
                                    endif; ?>" class="btn"><span>
                                <?php echo $button['text']; ?>
                            </span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>