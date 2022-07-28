<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'imp-banner-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'imp-banner ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$bannerText = mb_get_block_field('banner_text');
$bannerButton = mb_get_block_field('banner_button');
?>
<section id="<?= $id ?>" class="<?= $class ?> imp-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 d-flex justify-content-start align-items-center">
                <h3 class="banner-text"><?php echo $bannerText; ?></h3>
            </div>
            <div class="col-lg-4 d-flex justify-content-start justify-content-lg-end align-items-center">
                <a href="<?php if ($bannerButton['custom_link']) : echo get_the_permalink($bannerButton['button_post']);
                            else : echo $bannerButton['custom_url'];
                            endif; ?>" class="banner-btn">
                    <span>
                        <?php echo $bannerButton['button_text']; ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>