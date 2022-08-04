<?php get_header(); ?>

<?php
the_post();
$course = IMPCourse::init_by_id(get_the_ID());
?>
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