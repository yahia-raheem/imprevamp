<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'home-slider-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'home-slider ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$courses = mb_get_block_field('hs_course');
?>
<section id="<?= $id ?>" class="<?= $class ?> has-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="splide course-slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($courses as $course) : ?>
                                <?php
                                $course = IMPCourse::init_by_id($course);
                                ?>
                                <li class="splide__slide">
                                    <div class="course-slide">
                                        <div class="img-container">
                                            <?php echo wp_get_attachment_image($course->thumbnailId, 'large', false, ['class' => 'bg-image']); ?>
                                        </div>
                                        <div class="data-container">
                                            <div class="specs-row">
                                                <div>
                                                    <div class="course-spec instructor">
                                                        <?php if ($course->instructor) : ?>
                                                            <div class="avatar img-container">
                                                                <?php echo wp_get_attachment_image($course->instructor->thumbnailId); ?>
                                                            </div>
                                                            <div class="content">
                                                                <span><?php _e('Teacher', 'imp'); ?></span>
                                                                <p><?php echo $course->instructor->instructorName; ?></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php
                                                    $courseCategories = $course->get_course_categories();
                                                    foreach ($courseCategories as $category) :
                                                    ?>
                                                        <div class="course-spec category">
                                                            <div class="avatar img-container">
                                                                <i class="fa-solid fa-bookmark"></i>
                                                            </div>
                                                            <div class="content">
                                                                <span><?php _e('Category', 'imp'); ?></span>
                                                                <p><?php echo $category->name; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div>

                                                </div>
                                            </div>
                                            <h3 class="title"><?php echo $course->title; ?></h3>
                                            <div class="attributes-row">
                                                <?php if ($course->features->level) : ?>
                                                    <div class="course-attribute">
                                                        <i class="fa-solid fa-signal"></i>
                                                        <?php echo $course->features->level; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                $lecturesCount = $course->get_course_lectures_count();
                                                ?>
                                                <?php if ($lecturesCount && $lecturesCount > 0) : ?>
                                                    <div class="course-attribute">
                                                        <i class="fa-solid fa-list"></i>
                                                        <?php echo $lecturesCount; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($course->features->hours) : ?>
                                                    <div class="course-attribute">
                                                        <i class="fa-solid fa-clock"></i>
                                                        <?php echo $course->features->hours; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="cta-row">
                                                <a class="btn btn-primary" href="<?php echo get_post_permalink($course->courseId); ?>">
                                                    <span class="cta-text"><?php _e('GET COURES', 'imp'); ?></span>
                                                    <span class="price"><?php echo $coures->features->price; ?></span>
                                                </a>
                                            </div>
                                        </div>
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