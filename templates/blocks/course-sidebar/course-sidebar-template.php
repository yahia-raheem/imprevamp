<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'course-sidebar-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'course-sidebar ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$detectFromPost = mb_get_block_field('detect_from_post');
$customPostId = mb_get_block_field('course');

if ($detectFromPost == true) {
    $course = IMPCourse::get_current();
} else if ($customPostId) {
    $course = IMPCourse::local_init_by_id($customPostId);
}
?>
<div id="<?= $id ?>" class="<?= $class ?>">
    <?php if (!$course) : ?>
        <p>Can't detect any courses .. Please either select a course or contact support</p>
    <?php endif; ?>
</div>