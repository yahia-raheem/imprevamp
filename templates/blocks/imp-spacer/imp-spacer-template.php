<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'imp-spacer-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.
$class = 'imp-spacer ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$multiplier = mb_get_block_field('multiplier');

?>
<div id="<?= $id ?>" class="<?= $class ?>" data-multiplier="<?php echo $multiplier; ?>" style="height: <?php echo $multiplier * 8 ?>px">
    
</div>