<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'clients-slider-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'clients-slider ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$blockTitle = mb_get_block_field('block_title');
$clients = mb_get_block_field('clients');
?>
<section id="<?= $id ?>" class="<?= $class ?>">
    <div class="container">
        <div class="row title-row">
            <div class="col-12">
                <?php 
                echo do_shortcode( wpautop( $blockTitle ) );
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="splide clients-slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($clients as $client) : ?>
                                <li class="splide__slide">
                                    <div class="img-container">
                                        <?php echo wp_get_attachment_image($client['ID'], 'large', false, ['class' => 'bg-image']); ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>