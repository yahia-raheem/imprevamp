<?php
// ==========================================================================================
// IMP Posts Widget
// ==========================================================================================

add_action( 'widgets_init', 'cps_widget_category_posts' );
function cps_widget_category_posts() {
	register_widget( 'cps_category_posts_widget' );
}
class cps_category_posts_widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'cps-widget-category-posts',
			'description' => esc_html_x( 'Displays the posts with more stylish way', 'Category Posts widget description', 'cps' )
		);
		parent::__construct( 'cps-category-posts', sprintf( esc_html_x( '.: %s - Posts', 'Posts widget name', 'cps' ), 'IMP' ), $widget_ops );
		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget( $args, $instance ) {
		$cps_cache = array();
		if ( ! $this->is_preview() ) {
			$cps_cache = wp_cache_get( 'cps-category-posts', 'widget' );
		}
		if ( ! is_array( $cps_cache ) ) {
			$cps_cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		if ( isset( $cps_cache[ $args['widget_id'] ] ) ) {
			echo wp_kses_post( $cps_cache[ $args['widget_id'] ] );
			return;
		}
		ob_start();

		$cps_params = array(
			'no_found_rows'         => true,
			'post_status'           => 'publish',
			'ignore_sticky_posts'   => true
		);

		if ( empty( $instance['number'] ) || ! $cps_params['posts_per_page'] = absint( $instance['number'] ) ) {
			$cps_params['posts_per_page'] = 5;
		}

		if ( ! empty( $instance['category'] ) ) {
			$cps_params['cat'] = $instance['category'];
		}

		$layout = empty($instance['layout']) ? 'style1' : $instance['layout'];

		switch ( $instance['orderby'] ) {
			case 'views':
				$cps_params['orderby'] = 'meta_value_num';
				$cps_params['meta_key'] = 'post_views_count';
				break;
			case 'comments':
				$cps_params['orderby'] = 'comment_count';
				break;
			case 'random':
				$cps_params['orderby'] = 'rand';
				break;
			case 'posts':
				$cps_params['orderby'] = 'post__in';
				break;
			default:
				$cps_params['orderby'] = 'date';
		}

		$cps_params['order'] = ( $instance['order'] != 'asc' ) ? 'DESC' : 'ASC';

		$cps_query = new WP_Query( $cps_params );

		if ( $cps_query->have_posts() ):
			echo wp_kses_post( $args['before_widget'] );
			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
		}?>

		<div class="cps-posts-wrapper cps-posts-widget cps-posts-widgets-<?php echo $layout;?>">
			<?php while ( $cps_query->have_posts() ) : $cps_query->the_post(); ?>
			<div class="cps-posts-block">
				<?php if($layout == 'style1'): ?>
				<div class="post-image">
					<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('thumbnail', array()); ?>
					</a>
					<?php } ?>
				</div>
				<?php endif ?>
				<div class="post-details">
					<div class="post-title">
						<?php the_title('<h5 class="entry-title"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h5>'); ?>
					</div>
					<ul class="post-meta">
						<li class="post-meta-data"><?php the_time( get_option('date_format') ); ?></li>
					</ul>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<?php
		echo wp_kses_post( $args['after_widget'] );
		wp_reset_postdata();
		endif;

		if ( ! $this->is_preview() ) {
			$cps_cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'cps-category-posts', $cps_cache, 'widget' );
		} else {
			ob_end_flush();
		}

	}

	public function flush_widget_cache() {
		wp_cache_delete( 'cps-category-posts', 'widget' );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['number']         = absint( $new_instance['number'] );
		$instance['category']       = $new_instance['category'];
		$instance['orderby']        = sanitize_key( $new_instance['orderby'] );
		$instance['order']          = sanitize_key( $new_instance['order'] );
		$instance['layout']         = strip_tags( $new_instance['layout'] );

		$this->flush_widget_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['cps-category-posts'] ) ) {
			delete_option( 'cps-category-posts' );
		}
		return $instance;
	}

	public function form( $instance ) {
		$cps_title        = isset( $instance['title'] ) ? $instance['title'] : '';
		$cps_number       = isset( $instance['number'] ) ? $instance['number'] : 5;
		$cps_category     = isset( $instance['category'] ) ? intval( $instance['category'] ) : '';
		$cps_orderby      = isset( $instance['orderby'] ) ? sanitize_key( $instance['orderby'] ) : 'date';
		$cps_order        = isset( $instance['order'] ) ? sanitize_key( $instance['order'] ) : 'desc';
		$cps_order        = isset( $instance['layout'] ) ? ( $instance['layout'] ) : 'style1';
		$cps_categories = get_categories();
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Post Style :', 'cps' ) ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
				<option value="style1"<?php echo ( $cps_order == 'style1' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Style 1', 'cps' ) ?></option>
				<option value="style2"<?php echo ( $cps_order == 'style2' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Style 2', 'cps' ) ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Choose category:', 'cps' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
				<option value=""><?php esc_html_e( '- All -', 'cps' ); ?></option>
				<?php foreach ( $cps_categories as $cps_cat ): ?>
				<option value="<?php echo intval( $cps_cat->term_id ); ?>"<?php echo ( $cps_category == $cps_cat->term_id ) ? ' selected' : ''; ?>><?php echo esc_html( $cps_cat->name ) .' ('. intval( $cps_cat->count ) .')'; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo absint( $cps_number ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order Posts by :', 'cps' ) ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" class="cps-select-post-orderby">
				<option value="date"<?php echo ( $cps_orderby == 'date' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Date', 'cps' ) ?></option>
				<option value="views"<?php echo ( $cps_orderby == 'views' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Views', 'cps' ) ?></option>
				<option value="comments"<?php echo ( $cps_orderby == 'comments' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Comments', 'cps' ) ?></option>
				<option value="random"<?php echo ( $cps_orderby == 'random' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Random', 'cps' ) ?></option>
				<option value="posts"<?php echo ( $cps_orderby == 'posts' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Manual Post IDs', 'cps' ) ?></option>
			</select>
		</p>

		<p class="cps-post-order-type"<?php echo ( $cps_orderby == 'random' ) ? ' style="display: none;' : ''; ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order Type :', 'cps' ) ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="desc"<?php echo ( $cps_order == 'desc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Descending', 'cps' ) ?></option>
				<option value="asc"<?php echo ( $cps_order == 'asc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Ascending', 'cps' ) ?></option>
			</select>
		</p>
		<?php

	}

}
