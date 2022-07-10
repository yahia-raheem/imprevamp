<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'our-stats-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'our-stats ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$statsGroup = mb_get_block_field('stat_group');
?>
<section id="<?= $id ?>" class="<?= $class ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="stats">
                    <?php foreach ($statsGroup as $stat) : ?>
                        <div class="stat">
                            <i class="<?php echo $stat['icon']; ?>"></i>
                            <div class="content">
                                <h5 class="number"><?php echo $stat['count']; ?></h5>
                                <p class="desc"><?php echo $stat['suffix']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>