<?php
$course = IMPCourse::get_current();
if ($course instanceof IMPCourse) :
?>
    <?php if ($course->features->isDiscounted) {
        $discounted = 'discounted';
    } else {
        $discounted = '';
    }?>

    <div class="course-price <?php echo $discounted?>">
        <?php if ($course->features->price): ?>
            <span class="original"><?php echo $course->features->currency . $course->features->price; ?></span>
        <?php endif; ?>
        <?php if ($course->features->isDiscounted) : ?>
            <span class="discount"><?php echo $course->features->currency . $course->features->discountPrice; ?></span>
        <?php endif; ?>
    </div>

<?php
else : return;
endif;
?>