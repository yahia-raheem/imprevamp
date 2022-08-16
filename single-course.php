<?php get_header();
$theme_title_wrapper			= IMPOptions::get('title_wrapper');
the_post();
$course = IMPCourse::init_by_id(get_the_ID());
if ($theme_title_wrapper == '1'):
    //Header Page Title
    get_template_part( 'templates/page-title/pagetitle-template' );
endif ?>
<section class="generic-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>