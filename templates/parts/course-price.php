<?php
$course = IMPCourse::get_current();
if ($course instanceof IMPCourse) :
?>

    <div class="course-price<?php if ($course->features->isDiscounted): ?> discounted" <?php endif; ?>>
        <span class="original"><?php echo $course->features->currency . $course->features->price; ?></span>
        <?php if ($course->features->isDiscounted) : ?>
            <span class="discount"><?php echo $course->features->currency . $course->features->discountPrice; ?></span>
        <?php endif; ?>
    </div>

<?php
else : return;
endif;
?>