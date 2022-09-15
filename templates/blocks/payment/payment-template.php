<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'payment-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}
// Custom CSS class name.
$class = 'payment ' . ($attributes['className'] ?? '');
$id = $_GET['courseID'];

if(!empty ($id)) {
    $course = IMPCourse::init_by_id($id);
} else {
    $course = '';
}

?>

<section id="<?= $id ?>" class="<?= $class ?> imp-payment-wrapper pt-5">
    <div class="container">
        <div class="row">
        <div class="smg-course-data"
        data-course-name="<?php echo $course->title?>"
        <?php if($course) { ?>
        data-course-price="<?php $course->features->display_priceNumber();?>"
        <?php } ?>
        data-course-date=<?php echo htmlspecialchars(json_encode($course->features->dates)); ?>
        ></div>
        <div class="imp-payment-iframe">
            <div id="accepting-container"></div>
        </div>
        </div>
    </div>
</section>