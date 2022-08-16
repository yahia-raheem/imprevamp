<?php get_header(); ?>
    <div class="imp-site-wrapper">
        <?php while (have_posts()) :
            the_post();
            the_content();
        endwhile; ?>
    </div><!--- imp-site-wrapper -->
<?php get_footer(); ?>