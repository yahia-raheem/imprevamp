<?php get_header();
the_post();
$course = IMPCourse::init_by_id(get_the_ID());
$footerCTA = rwmb_meta('course_price');
?>

<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
<div id="cps-page-title" class="cps-page-title-wrapper title-wrapper_bg page-title-style1" style="background-image: url('<?php echo esc_url($thumb['0']);?>')">
    <div class="title-wrapper-bg-overlay"></div>
        <div class="container">
            <div class="cps-page-title-block">
                <?php the_title('<h1 class="cps-entry-title" itemprop="name headline">', '</h1>'); ?>
            <?php cps_breadcrumb(); ?>
        </div>
    </div><!-- container -->
</div>


<section class="generic-page">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <?php the_content(); ?>
            </div>
            <div class="col-md-3">
                <div class="imp-single-course-details">
                    <div class="imp-single-course--action">
                        <div class="cta-row">
                            <a class="btn price-btn" href="<?php echo get_post_permalink($course->courseId); ?>">
                                <div class="cta-text"><?php _e('GET COURES', 'imp'); ?></div>
                                <?php $course->features->display_price(); ?>
                            </a>
                        </div>
                    </div>
                    <div class="imp-single-course-details--action">
                        <div class="attributes-row">
                            <?php if ($course->features->level) : ?>
                                <div class="course-attribute">
                                    <?php echo $course->features->level; ?>
                                    <i class="fa-solid fa-signal"></i>
                                </div>
                            <?php endif; ?>
                            <?php
                            $lecturesCount = $course->get_course_lectures_count();
                            ?>
                            <?php if ($lecturesCount && $lecturesCount > 0) : ?>
                                <div class="course-attribute">
                                    <?php echo $lecturesCount . ' '; _e('Lectures', 'imp'); ?>
                                    <i class="fa-solid fa-list"></i>
                                </div>
                            <?php endif; ?>
                            <?php if ($course->features->hours) : ?>
                                <div class="course-attribute">
                                    <?php echo $course->features->hours . ' '; _e('Hours', 'imp'); ?>
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>