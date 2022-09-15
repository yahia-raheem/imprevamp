<?php
// ==========================================================================================
// Codepages Search Results Teamplate
// @package CPS
// @author Codepages - Codepages
// @link http://themeforest.net/user/codepages/portfolio
// ==========================================================================================


get_header();
?>

<div class="cps-site-wrapper">
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
	<div id="cps-page-title" class="cps-page-title-wrapper title-wrapper_bg page-title-style1" style="background-image: url('<?php echo esc_url($thumb['0']);?>')">
		<div class="title-wrapper-bg-overlay"></div>
			<div class="container">
				<div class="cps-page-title-block">
					<h1 class="cps-entry-title"><?php echo get_search_query(); ?></h1>
					<?php cps_breadcrumb(); ?>
				</div>
			</div><!-- container -->
		</div>
	</div>
			
	<div class="cps-main-content">
		<div class="container inner">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="cps-content-wrapper">
						<div class="row <?php echo esc_attr($masonry_class)?>">
							<?php if ( have_posts() ) : ?>
								<?php // Start the loop.
								while ( have_posts() ) : the_post(); ?>
									<div class="col-lg-4 col-md-6 col-12">
										<?php 
										get_template_part( 'templates/parts/search-card' );
										// End the loop.
										?>
									</div>
								<?php endwhile; ?>
							</div>
							<?php
							// If no content, include the "No posts found" template.
							else :
							get_template_part( 'templates/parts/content-none' );
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--- cps-site-wrapper -->

<?php get_footer(); ?>
