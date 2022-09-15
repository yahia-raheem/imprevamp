<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cps
 */
?>

<div class="col-sm-12 col-xs-12">
	<section class="no-results not-found">
		<div class="page-content">

			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p class="empty-first-post"><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cps' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>
			
			<h3><?php echo esc_html__( 'Nothing Found', 'cps' ); ?></h3>
			<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cps' ); ?></p>
			<?php get_search_form(); ?>

			<?php else : ?>

			<h3><?php echo esc_html__( 'Nothing Found', 'cps' ); ?></h3>
			<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cps' ); ?></p>
			<?php get_search_form(); ?>

			<?php endif; ?>
			
		</div><!-- .page-content -->
	</section><!-- no-results -->
</div>