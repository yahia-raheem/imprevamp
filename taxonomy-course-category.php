<?php get_header();
the_post();
$course = IMPCourse::init_by_id(get_the_ID());
$footerCTA = rwmb_meta('course_price');
?>

<div class="cps-main-content">
		<div class="container inner">
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="cps-content-wrapper">
						<div class="row">
							<?php if ( have_posts() ) : ?>
								<?php
								// Start the loop.
								while ( have_posts() ) : the_post(); ?>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <?php
                                        IMPCourse::init_by_id(get_the_ID());
                                        get_template_part('templates/parts/course', 'card');    
                                    ?>
                                </div>
                                <?php
								// End the loop.
								endwhile;
								?>
							</div>
							<div class="row">

							</div>
							<?php
							// If no content, include the "No posts found" template.
							else :
							get_template_part( 'templates/parts/content', 'none' );
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php get_footer(); ?>