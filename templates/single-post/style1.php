<?php
	$id = get_the_ID();
	$user_id = get_the_author_meta( 'ID');
	cps_set_post_views($post->ID);
	$views = cps_get_post_views(get_the_ID());
	$comments = get_comments_number();
	$term_list = wp_get_post_terms($post->ID, 'blog-category');
?>


<section class="main-content cps-single-post cps-single-style-2">
	<div class="cps-site-wrapper">
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<figure class="cps-post-image-overlay" style="background-image: url('<?php echo esc_url($thumb['0']);?>')">
			<div class="cps-post-image-header">
				<div class="cps-display-table">
					<div class="cps-post--header">
						<div class="container">
							<header class="cps-entry-header">
								<div class="cps-post--metabox">
									<div class="cps-post--category">
										<div class="cps-post-cat">
											<?php echo $term_list[0]->name; ?>	
										</div>												
										<div class="cps-post--data"><?php the_time( get_option('date_format') ); ?></div>
									</div>
								</div>
								<div class="cps-post--title">
									<?php the_title('<h1 class="cps-entry-title" itemprop="name headline">', '</h1>'); ?>
								</div><!-- post-title -->
							</header>
							<div class="cps-post--metabox">
								<ul class="cps-post--meta">
									<?php if($comments !== '0') {?>
									<li class="post-data"><i class="far fa-comments"></i><?php cps_post_comments_count(); ?></li>
									<?php } ?>
									<li class="post-data"><i class="far fa-eye"></i><?php echo esc_attr($views); ?> <?php echo esc_html__('Views', 'cps'); ?></li>
									<li class="post-data"><a href="" onClick="window.print()"><i class="ti ti-printer"></i><?php echo esc_html__('Print', 'cps'); ?> </a></li>
									<li class="post-data">
										<a href="mailto:?subject=<?php echo the_title();?>&amp;body=<?php the_permalink() ?>">
											<i class="ti ti-email"></i><?php echo esc_html__('EMail', 'cps'); ?>
										</a>
									</li>
								</ul>
							</div><!-- post-meta -->
						</div>
					</div>
				</div>
			</div>
		</figure>
		<div class="container inner">
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12 offset-md-2">
					<article <?php post_class('cps-post post'); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article" role="article" >
						<div class="cps-post--header">
							<figure class="cps-post--image">
								<?php the_post_thumbnail('cps-post-large-four', array('itemprop'=>'image')); ?>
							</figure>
						</div>
						<div class="cps-post--contect">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cps' ),
									'after'  => '</div>',
								) );
							?>
						</div>
						<div class="cps-post--footer">
							<div class="cps-post-tags">
								<?php cps_post_tag(); ?>
							</div><!-- post-tags -->
							<div class="cps-post-contact">
								<div class="cps-post--social-share">
									<?php IMPCourse::icon_social_share_small(); ?>
									<!-- post-share -->
								</div>
							</div><!-- post-contact -->
							<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
							<!--post-comment-->
						</div>
					</article><!-- post -->
				</div>
				
			</div><!-- row -->
		</div><!-- container -->
		<?php endwhile; else : endif; ?>
	</div>
</section><!-- main -->
