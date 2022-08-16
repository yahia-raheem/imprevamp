<?php
//Page title style 1
$title_wrapper_style			       = IMPOptions::get('title_wrapper_layout');
$title_wrapper_bg			           = IMPOptions::get('title_wrapper_bg');
$title_wrapper_bg_overlay				 = IMPOptions::get('title_wrapper_bg_overlay');
$title_wrapper_parallax				   = IMPOptions::get('title_wrapper_parallax');
$title_wrapper_text_align			   = IMPOptions::get('title_wrapper_text_align');
$title_wrapper_breadcrumb			   = IMPOptions::get('title_wrapper_breadcrumb');
$title_wrapper_full_height			 = IMPOptions::get('title_wrapper_full_height');
$title_wrapper_color_scheme			 = IMPOptions::get('title_wrapper_color_scheme');

//Parallax Class
if ($title_wrapper_parallax == '1') { $parallax_class = "parallax";
} else { $parallax_class = ""; }
//Full Height Class
if ($title_wrapper_full_height == '1') { $full_height_class = "full_height";
} else { $full_height_class = ""; }

// Title and subtitle

$subtitle_text = IMPOptions::get('title_wrapper_subtitle');

if ( is_home() ) {
		$title_text = esc_html__( 'Blog', 'cps' );
		$subtitle_text = esc_html__( 'Our recent posts', 'cps' );
} else if ( is_category() ) {
		$title_text = single_cat_title( '', false );
		$subtitle_text = esc_html__( 'Category', 'cps' );
} elseif ( is_tag() ) {
		$title_text = single_tag_title( '', false );
		$subtitle_text = esc_html__( 'Tag', 'cps' );
} elseif ( is_search() ) {
		$title_text =  '' . get_search_query() . '';
		$subtitle_text = esc_html__( 'Search Results ', 'cps' );
} elseif ( is_day() ) {
		$title_text = get_the_time( 'F' ) . ' ' . get_the_time( 'd' ) . ', ' . get_the_time( 'Y' );
		$subtitle_text = 'Posts by date';
} elseif ( is_month() ) {
		$title_text = get_the_time( 'F' ) . ' ' . get_the_time( 'Y' );
		$subtitle_text = false;
} elseif ( is_year() ) {
		$title_text = get_the_time( 'Y' );
		$subtitle_text = false;
} elseif ( is_single() ) {
} elseif ( is_tax( 'course' ) ) {
	$post_type = get_post_type_object(get_post_type());
	$title_text = $post_type->labels->singular_name;
	print_r($post_type);
	$subtitle_text = esc_html__( 'Product category', 'cps' );
} elseif ( is_author() ) {
		$author = get_the_author();
		$title_text = ( $author ) ? $author : esc_html__( 'Undefined', 'cps' );
		$subtitle_text = esc_html__( 'Author', 'cps' );
} elseif ( is_tax( 'portfolio', 'portfolio_categories' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$title_text = $cat->name;
		$subtitle_text = esc_html__( 'Product category', 'cps' );
} elseif ( class_exists('woocommerce') && is_shop() ) {
		$title_text = get_the_title( $post->ID );
} elseif ( class_exists('woocommerce') && is_product() ) {
		$subtitle_text = wp_kses( get( 'woocommerce_header_subtitle', 'global' ), 'default' );
} elseif ( class_exists('woocommerce') && is_product_tag() ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$title_text = $cat->name;
		$subtitle_text = esc_html__( 'Product tag', 'cps' );
} elseif ( is_page() ) {
    $title_text   = get_the_title();
		$subtitle_text  = IMPOptions::get( 'title_wrapper_subtitle' );
} elseif ( is_404() ) {
		$title_text = esc_html__( 'Page not found!', 'cps' );
}

?>
<div id="cps-page-title" class="cps-page-title-wrapper title-wrapper_bg page-title-style1 <?php echo esc_attr($title_wrapper_color_scheme);?> <?php echo esc_attr($title_wrapper_text_align);?> <?php echo esc_attr($parallax_class);?> <?php echo esc_attr($full_height_class);?>">
  <?php if(!empty($title_wrapper_bg['background-image'])) { ?>
    <div class="title-wrapper-bg-overlay" style="background-color:<?php echo empty($title_wrapper_bg_overlay['rgba']) ? '' : esc_attr($title_wrapper_bg_overlay['rgba']);?>;"></div>
  <?php } ?>
  <div class="container">
    <div class="cps-page-title-block">
			<?php if (! empty ( $subtitle_text ) ) { ?>
      	<p class="cps-page-title-subtitle"><?php echo esc_attr($subtitle_text); ?></p>
			<?php } ?>
			<?php if (! empty ( $title_text ) ) { ?>
      	<h1 class="cps-page-title-text"><?php echo esc_attr($title_text); ?></h1>
			<?php } ?>
      <?php if ($title_wrapper_breadcrumb == '1') { cps_breadcrumb(); }; ?>
    </div>
  </div><!-- container -->
</div>
