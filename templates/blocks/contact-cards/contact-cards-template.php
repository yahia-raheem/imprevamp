<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'contact-cards-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'contact-cards ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$contactCards = mb_get_block_field('contact_card');
?>
<div id="<?= $id ?>" class="<?= $class ?> imp-section">
    <div class="container">
        <div class="row">
            <?php foreach ($contactCards as $contact) : ?>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-12">
                    <div class="icon-card dark rounded">
                        <div class="icon">
                            <?php if ($contact['type'] === 'phone') : ?>
                                <i class="fa-solid fa-phone"></i>
                            <?php endif;
                            if ($contact['type'] === 'email') : ?>
                                <i class="fa-solid fa-envelope"></i>
                            <?php endif;
                            if ($contact['type'] === 'location') : ?>
                                <i class="fa-solid fa-location-dot"></i>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <h3 class="name">
                                <?php echo $contact['title']; ?>
                            </h3>
                            <ul>
                                <?php foreach ($contact['info'] as $info) : ?>
                                    <li><?php echo $info; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>