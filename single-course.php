<?php get_header();
the_post();
$course = IMPCourse::init_by_id(get_the_ID());
$footerCTA = rwmb_meta('course_price');
$id = get_the_id();
?>

<?php $thumb = wp_get_attachment_image_src(
    get_post_thumbnail_id($post->ID),
    'full'
); ?>
<div id="cps-page-title" class="cps-page-title-wrapper title-wrapper_bg page-title-style1" style="background-image: url('<?php echo esc_url(
    $thumb['0']
); ?>')">
    <div class="title-wrapper-bg-overlay"></div>
        <div class="container">
            <div class="cps-page-title-block">
                <?php the_title(
                    '<h1 class="cps-entry-title" itemprop="name headline">',
                    '</h1>'
                ); ?>
            <?php cps_breadcrumb(); ?>
        </div>
    </div><!-- container -->
</div>


<section class="generic-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <?php the_content(); ?>
            </div>
            <div class="col-md-3">
                <div class="imp-single-course-details">
                    <div class="imp-single-course--action">
                        <div class="cta-row">
                            <a class="btn price-btn payment-open" href="<?php echo esc_url(
                                get_site_url()
                            ); ?>/checkout/?courseID=<?php the_ID(); ?>">
                                <div class="cta-text"><?php _e(
                                    'GET COURES',
                                    'imp'
                                ); ?></div>
                                <?php $course->features->display_price(); ?>
                            </a>
                        </div>
                    </div>
                    <div class="imp-single-course-details--action">
                        <div class="attributes-row">
                            <?php if ($course->features->level): ?>
                                <div class="course-attribute">
                                    <?php
                                    echo esc_html__('Level: ', 'imp');
                                    echo $course->features->level;
                                    ?>
                                    <i class="fa-solid fa-signal"></i>
                                </div>
                            <?php endif; ?>
                            <?php $lecturesCount = $course->get_course_lectures_count(); ?>
                            <?php if ($lecturesCount && $lecturesCount > 0): ?>
                                <div class="course-attribute">
                                    <?php
                                    echo $lecturesCount . ' ';
                                    _e('Lectures', 'imp');
                                    ?>
                                    <i class="fa-solid fa-list"></i>
                                </div>
                            <?php endif; ?>
                            <?php if ($course->features->hours): ?>
                                <div class="course-attribute">
                                    <?php
                                    echo $course->features->hours . ' ';
                                    _e('Hours', 'imp');
                                    ?>
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="smg-related-course">
            <div class="section-title d-flex flex-wrap justify-content-between  align-items-center">
                <div class="main d-flex flex-column justify-content-start align-items-start mb-5">
                    <h2><?php echo esc_html__('Related Courses','imp' )?></h2>
                </div>
            </div>
            <div class="row">
                <?php 
                    $args = [
                        'post_type' => 'course',
                        'orderby' => 'rand',
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,
                        'no_found_rows' => true,
                        'post__not_in' => array($id),
                        'posts_per_page' => 3,
                    ];
                    $postslist = new WP_Query($args);
                    if ( $postslist->have_posts() ) : while ( $postslist->have_posts() ) : $postslist->the_post(); ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <?php get_template_part('templates/parts/course', 'card-rend'); ?> 
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    endif; ?>
            </div>
        </div>
        <div class="smg-course-data"
        data-course-name="<?php the_title(); ?>"
        data-course-price="<?php $course->features->display_priceNumber(); ?>"
        data-course-description=""
        ></div>
        <div class="imp-single-course-details imp-single-course-mobile">
            <div class="imp-single-course--action">
                <div class="cta-row">
                    <a class="btn price-btn payment-open" href="<?php echo esc_url(
                        get_site_url()
                    ); ?>/checkout/?courseID=<?php the_ID(); ?>">
                        <div class="cta-text"><?php _e(
                            'GET COURES',
                            'imp'
                        ); ?></div>
                        <?php $course->features->display_price(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
