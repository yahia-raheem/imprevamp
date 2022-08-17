<?php
$course = IMPCourse::get_current();
if ($course instanceof IMPCourse) :
?>
    <div class="course-card">
        <div class="course-image img-container">
            <a href="<?php echo get_the_permalink($course->courseId); ?>" class="clickable-space"></a>
            <?php echo wp_get_attachment_image($course->thumbnailId, 'large', false, ['class' => 'bg-image']); ?>
            <?php if ($course->features->recorded) : ?>
                <?php if ($course->features->recorded == 1) : ?>
                    <div class="live"><?php _e('Recorded', 'imp'); ?></div>
                <?php else : ?>
                    <div class="live"><?php _e('Live', 'imp'); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="content">
            <div class="attributes">
                <div class="categories">
                    <?php
                    $categories = $course->get_course_categories();
                    foreach ($categories as $category) :
                    ?>
                        <div class="category">
                            <?php echo $category->name; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php $course->features->display_price(); ?>
            </div>
            <a href="<?php echo get_the_permalink($course->courseId); ?>">
                <h3 class="title"><?php echo $course->title; ?></h3>
            </a>
            <div class="data">
                <div class="datum hours">
                    <i class="fa-solid fa-clock"></i>
                    <?php echo $course->features->hours . ' ';
                    _e('hours', 'imp'); ?>
                </div>
                <div class="datum lectures">
                    <i class="fa-solid fa-video"></i>
                    <?php echo $course->get_course_lectures_count() . ' ';
                    _e('Lectures', 'imp'); ?>
                </div>
            </div>
            <div class="sep"></div>
            <div class="instructor-row">
                <div class="instructor">
                    <?php $instructor = $course->instructor; ?>
                    <div class="image">
                        <?php echo wp_get_attachment_image($instructor->thumbnailId, 'thumbnail', false, ['class' => 'bg-image']); ?>
                    </div>
                    <div class="name"><?php echo $instructor->instructorName; ?></div>
                </div>
            </div>
        </div>
    </div>


<?php
else : return;
endif;
?>