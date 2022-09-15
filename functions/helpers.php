<?php

function imp_customization($wp_customize)
{
    $wp_customize->add_section('social_media_section', array('title' => 'Social Media',));
    $wp_customize->add_setting('facebook', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'facebook_control',
        array(
            'label' => 'Facebook',
            'section' => 'social_media_section',
            'settings' => 'facebook',
        )
    ));
    $wp_customize->add_setting('linked_in', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'linked_in_control',
        array(
            'label' => 'Linked In',
            'section' => 'social_media_section',
            'settings' => 'linked_in',
        )
    ));
    $wp_customize->add_setting('youtube', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'youtube_control',
        array(
            'label' => 'Youtube',
            'section' => 'social_media_section',
            'settings' => 'youtube',
        )
    ));
}
add_action('customize_register', 'imp_customization');

function determine_the_title($echo = true)
{
    $result = '';
    if (is_single()) {
        $post = get_queried_object();
        $postType = get_post_type_object(get_post_type($post));
        if ($postType) {
            $result = esc_html($postType->labels->name);
        } else {
            $result = get_the_title($post);
        }
    } elseif (is_tax()) {
        $postType = get_queried_object();
        $result = esc_html($postType->name);
    } elseif (is_archive()) {
        $postType = get_queried_object();
        $result = esc_html($postType->labels->name);
    } elseif (is_page()) {
        $result = get_the_title();
    }
    if ($echo) {
        echo $result;
    } else {
        return $result;
    }
}

add_action('get_header', 'my_filter_head');

function my_filter_head()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

function my_pagination($max_num_of_pages)
{
    $big = 999999999;
    $pagination = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $max_num_of_pages,
        'show_all' => false,
        'prev_text' => '<i class="fas fa-arrow-left"></i>' . 'Prev',
        'next_text' => 'Next' . '<i class="fas fa-arrow-right"></i>',
		'mid_size'  => 3 // number of page links to display on either side of current page
    ));
    return $pagination;
}

if ( ! function_exists( 'cps_content_nav' ) ) :
function cps_content_nav( $nav_id ) {
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes');

	function posts_link_attributes() {
	    return 'class="primary-bg-hover"';
	}
	global $wp_query, $post;
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous )
			return;
	}
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
	$nav_class = ( is_single() ) ? 'cps-post-navigation clearfix' : 'cps-pagination-nav-wrapper clearfix';
	$homeLink = esc_url( home_url( '/' ) );
	?>

	<div class="<?php echo esc_attr($nav_class); ?>">
	<?php if ( is_single() ) : ?>
		<?php if (  get_next_post_link() ) {
			$empty_class = "next_posts";
		} elseif (  get_previous_post_link() ) {
			$empty_class = "previous_posts";
		}
		?>
		<ul class="cps-post-nav <?php echo esc_attr($empty_class);?>">
			<?php previous_post_link( '<li class="cps-nav-previous previous">%link</li>', '<i class="ti ti-arrow-left"></i><div class="cps-nav-text"><span>'. esc_html__( 'Previous post', 'cps' ) . '</span><h4>%title</h4></div>' ); ?>
			<a href="<?php echo esc_url($homeLink)?>" class="cps-icon-grid"><i class="ti ti-view-grid"></i></a>
			<?php next_post_link( '<li class="cps-nav-next next">%link</li>', '<div class="cps-nav-text"><span>'. esc_html__( 'Next post', 'cps' ) . '</span><h4>%title</h4></div><i class="ti ti-arrow-right"></i>' ); ?>
		</ul>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
		<ul class="cps-pagination-nav">
			<?php if ( get_next_posts_link() ) : ?>
			<li class="cps-posts-nav cps-posts-prev">
				<?php next_posts_link( '<i class="ti ti-arrow-left"></i>'. esc_html__( 'Older posts', 'cps' )); ?>
			</li>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
			<li class="cps-posts-nav cps-posts-next">
				<?php previous_posts_link(esc_html__( 'Newer posts', 'cps' ). '<i class="ti ti-arrow-right"></i>'); ?>
			</li>
			<?php endif; ?>
		</ul>
	<?php endif; ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'cps_post_tag' ) ) :
	function cps_post_tag() {
		if(has_tag()) {
		$posttags = get_the_tags();
		?>
		<span class="tags-title"><?php esc_html_e('Tags', 'cps'); ?></span>
		<ul>
			<?php if ($posttags) {
				$return = '';
				foreach($posttags as $tag) {
					$return .= '<li><a href="'. get_tag_link($tag->term_id).'" title="'. get_tag_link($tag->name).'" class="tag-link">' . $tag->name . '</a></li>';
				}
				echo substr($return, 0, -1);
			} ?>
		</ul>
<?php } } endif;

function cps_get_post_views($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return 0;
	}
	return $count;
}

function cps_set_post_views($postID) {
	if (is_single()) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}

function cps_category_name_color(){
	if (! is_search() ) {
		$categories = get_the_category( get_the_ID() );
		$catname = $categories[0]->name;
		$class = strtolower($catname);
		$class = str_replace(' ', '-', $class);
		$class = sanitize_title($class);

		$categories_category = "";
		$categories_category = get_the_category( get_the_ID() );
		$categories_firstCategory = $categories_category[0]->cat_ID;
?>
<div class="cps-post-cat">
	<a  class="primary-bg cat-id-<?php echo esc_html($categories_firstCategory) ?>" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?> "><?php echo esc_html( $categories[0]->name ) ?></a>
</div>
<?php }	}

if ( ! function_exists( 'cps_post_comments_count' ) ) :
	function cps_post_comments_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			comments_popup_link( esc_html__( '0 COMMENT', 'cps' ), esc_html__( '1 COMMENT', 'cps' ), esc_html__( '% COMMENT', 'cps' ) );
		}
	}
endif;


# function theme_lang_switcher()
# {
#     $languages = icl_get_languages('skip_missing=1');
#     if (1 < count($languages)) {
#         $menu = '<div class="dropdown-menu" aria-labelledby="dropdownLang">';
#         foreach ($languages as $l) {
#             if (!$l['active']) {
#                 $menu .= '<a class="dropdown-item" href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" class="lang-flag flag-desktop" />' . $l['translated_name'] . '</a>';
#             }
#         }
#         $menu .= '</div>';
#         echo $menu;
#     }
# }

# ------------------------------------------------------------------------ api ------------------------------------------------
# add_action('rest_api_init', function () {
#     register_rest_route('generaldata/v1', '/getimage/(?P<id>\d+)', array(
#         'methods' => 'GET',
#         'callback' => 'get_image',
#         'args' => array(
#             'id' => array(
#                 'validate_callback' => function ($param, $request, $key) {
#                     return is_numeric($param);
#                 }
#             ),
#         ),
#         'permission_callback' => '__return_true'
#     ));
# });
# 
# function get_image($data)
# {
#     $imageId = $data['id'];
#     $image = wp_get_attachment_image($imageId, 'full', true);
#     return $image;
# }
