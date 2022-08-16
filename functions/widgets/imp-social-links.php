<?php

// ==========================================================================================
// Codepages Social Widget
// ==========================================================================================

add_action( 'widgets_init', 'widget_social_widget' );
function widget_social_widget() {
	register_widget( 'Widget_social_links' );
}
class Widget_social_links extends WP_Widget {
	public function __construct() {
			$widget_ops = array(
				'classname'   => 'widget_social_widget',
				'description' => esc_html_x( 'A short description about you.', 'Tag Cloud widget description', 'cps' )
			);
			$control_ops = array( 'id_base' => 'widget_social_widget' );
			parent::__construct( 'widget_social_widget', sprintf( esc_html_x( ':. %s - Social Links', 'Social Links widget name', 'cps' ), 'IMP' ), $widget_ops, $control_ops );
	 }

	public function widget( $args, $instance ) {
		extract( $args );
		$title     = apply_filters('widget_title', $instance['title'] );
		$layout		 = empty($instance['layout']) ? 'style1' : $instance['layout'];
		$facebook       = esc_attr( $instance['facebook'] );
		$twitter        = esc_attr( $instance['twitter'] );
		$youtube        = esc_attr( $instance['youtube'] );
		$instagram      = esc_attr( $instance['instagram'] );
		$linkedin       = esc_attr( $instance['linkedin'] );
		$google_plus    = esc_attr( $instance['google-plus'] );
		$behance        = esc_attr( $instance['behance'] );
		$vimeo          = esc_attr( $instance['vimeo'] );
		$dribbble       = esc_attr( $instance['dribbble'] );
		$pinterest      = esc_attr( $instance['pinterest'] );
		$rss         		= esc_attr( $instance['rss'] );
		$skype          = esc_attr( $instance['skype'] );
		$whatsapp       = esc_attr( $instance['whatsapp'] );

		echo wp_kses_post( $args['before_widget'] );
		if ( $title )
		echo $before_title.esc_attr($title).$after_title; ?>

		<!-- Start widget social -->
		<div class="cps_widget_content">
			<div class="cps-widget-social-icons">
				<ul class="cps-social-icons <?php echo $layout; ?>">
					<?php if ( $facebook != '' ) : ?>
					<li><a href="<?php echo esc_url ($facebook) ?>"><i class="fab fa-facebook-f"></i></a></li>
					<?php endif; ?>
					<?php if ( $twitter != '' ) : ?>
					<li><a href="<?php echo esc_url ($twitter) ?>"><i class="fab fa-twitter"></i></a></li>
					<?php endif; ?>
					<?php if ( $instagram != '' ) : ?>
					<li><a href="<?php echo esc_url ($instagram) ?>"><i class="fab fa-instagram"></i></a></li>
					<?php endif; ?>
					<?php if ( $google_plus != '' ) : ?>
					<li><a href="<?php echo esc_url ($google_plus) ?>"><i class="fab fa-google-plus-g"></i></a></li>
					<?php endif; ?>
					<?php if ( $youtube != '' ) : ?>
					<li><a href="<?php echo esc_url ($youtube) ?>"><i class="fab fa-youtube"></i></a></li>
					<?php endif; ?>
					<?php if ( $linkedin != '' ) : ?>
					<li><a href="<?php echo esc_url ($linkedin) ?>"><i class="fab fa-linkedin-in"></i></a></li>
					<?php endif; ?>
					<?php if ( $skype != '' ) : ?>
					<li><a href="<?php echo esc_url ($skype) ?>"><i class="fab fa-skype"></i></a></li>
					<?php endif; ?>
					<?php if ( $whatsapp != '' ) : ?>
					<li><a href="<?php echo esc_url ($whatsapp) ?>"><i class="fab fa-whatsapp"></i></a></li>
					<?php endif; ?>
					<?php if ( $vimeo != '' ) : ?>
					<li><a href="<?php echo esc_url ($vimeo) ?>"><i class="fab fa-vimeo-v"></i></a></li>
					<?php endif; ?>
					<?php if ( $pinterest != '' ) : ?>
					<li><a href="<?php echo esc_url ($pinterest) ?>"><i class="fab fa-pinterest"></i></a></li>
					<?php endif; ?>
					<?php if ( $dribbble != '' ) : ?>
					<li><a href="<?php echo esc_url ($dribbble) ?>"><i class="fab fa-dribbble"></i></a></li>
					<?php endif; ?>
					<?php if ( $behance != '' ) : ?>
					<li><a href="<?php echo esc_url ($behance) ?>"><i class="fab fa-behance"></i></a></li>
					<?php endif; ?>
					<?php if ( $rss != '' ) : ?>
					<li><a href="<?php echo esc_url ($rss) ?>"><i class="fa fa-rss"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<!-- End widget social -->

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                	 	= $old_instance;
		$instance['title']       	 	= strip_tags( $new_instance['title'] );
		$instance['layout']         = strip_tags( $new_instance['layout'] );
		$instance['facebook']       = $new_instance['facebook'];
		$instance['twitter']        = $new_instance['twitter'];
		$instance['youtube']        = $new_instance['youtube'];
		$instance['instagram']      = $new_instance['instagram'];
		$instance['linkedin']       = $new_instance['linkedin'];
		$instance['google-plus']    = $new_instance['google-plus'];
		$instance['behance']        = $new_instance['behance'];
		$instance['vimeo']          = $new_instance['vimeo'];
		$instance['dribbble']       = $new_instance['dribbble'];
		$instance['pinterest']      = $new_instance['pinterest'];
		$instance['rss']         		= $new_instance['rss'];
		$instance['skype']          = $new_instance['skype'];
		$instance['whatsapp']       = $new_instance['whatsapp'];
		return $instance;
	}

	public function form( $instance ) {
		$defaults = array( 'title' => 'Subscribe & Follow' );
		$cps_style        = isset( $instance['layout'] ) ? ( $instance['layout'] ) : 'style1';
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'cps' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout Post :', 'cps' ) ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
				<option value="style1"<?php echo ( $cps_style == 'style1' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Style 1', 'cps' ) ?></option>
				<option value="style2"<?php echo ( $cps_style == 'style2' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Style 2', 'cps' ) ?></option>
			</select>
		</p>
		<p> <?php esc_html_e( 'Social Icons', 'cps' ); ?></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['facebook']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['twitter']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['instagram']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Youtube:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['youtube']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['linkedin']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'google-plus' ) ); ?>"><?php esc_html_e( 'Google Plus:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google-plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google-plus' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['google-plus']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>"><?php esc_html_e( 'Behance:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['behance']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e( 'Vimeo:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['vimeo']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e( 'Dribbble:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['dribbble']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['pinterest']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php esc_html_e( 'RSS:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['rss']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'skype' ) ); ?>"><?php esc_html_e( 'Skype:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'skype' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skype' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['skype']):""); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'whatsapp' ) ); ?>"><?php esc_html_e( 'Whatsapp:', 'cps' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'whatsapp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'whatsapp' ) ); ?>" type="text" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['whatsapp']):""); ?>" />
		</p>
	<?php
	}

 }
