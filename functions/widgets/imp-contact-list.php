<?php
// ==========================================================================================
// Codepages Posts Widget
// ==========================================================================================

add_action( 'widgets_init', 'cps_widget_contact_list' );
function cps_widget_contact_list() {
	register_widget( 'cps_category_contact_list_widget' );
}
class cps_category_contact_list_widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'cps-widget-contact-list',
			'description' => esc_html_x( 'Displays the posts with more stylish way', 'Category Posts widget description', 'ipm' )
		);
		parent::__construct( 'cps-contact-list', sprintf( esc_html_x( '.: %s - Contact List', 'Contact List widget name', 'ipm' ), 'IMP' ), $widget_ops );
		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget( $args, $instance ) {
		$title    			= empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$addressfirst		= empty( $instance['addressfirst']) ? '' : $instance['addressfirst'];
		$phone				= empty( $instance['phone']) ? '' : $instance['phone'];
		$phoneNumber		= empty( $instance['phoneNumber']) ? '' : $instance['phoneNumber'];
		$email				= empty( $instance['email']) ? '' : $instance['email'];
		$address			= empty( $instance['address']) ? '' : $instance['address'];
		$addressLink		= empty( $instance['addressLink']) ? '' : $instance['addressLink'];


		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title'];
		};
		?>

		<div class="cps-contact-list-widget">
			<ul class="contact-list-wrapper">
				<li><a href="<?php echo esc_attr($addressLink)?>" target="_blank"><span><?php echo $addressfirst;?></span></a></li>
				<li><span><?php echo $address ; ?></span></a></li>
				<li><a href="tel:<?php echo esc_attr($phoneNumber)?>" target="_blank"><span><?php echo $phone;?></span></a></li>
				<li><span><?php echo $email ; ?></span></li>
			</ul>
		</div>

		<?php
		echo $args['after_widget'];
	}


	public function flush_widget_cache() {
		wp_cache_delete( 'cps-contact-list', 'widget' );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']          		= strip_tags( $new_instance['title'] );
		$instance['addressfirst']          	= $new_instance['addressfirst'];
		$instance['phone']          		= $new_instance['phone'];
		$instance['phoneNumber']         	= $new_instance['phoneNumber'];
		$instance['email']          		= $new_instance['email'];
		$instance['address']        		= $new_instance['address'];
		$instance['addressLink']        	= $new_instance['addressLink'];

		$this->flush_widget_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['cps-contact-list'] ) ) {
			delete_option( 'cps-contact-list' );
		}
		return $instance;
	}

	public function form( $instance ) {
		$cps_title        		= isset( $instance['title'] ) ? $instance['title'] : '';
		$cps_addressfirst       = isset( $instance['addressfirst'] ) ? $instance['addressfirst'] : '';
		$cps_phone        		= isset( $instance['phone'] ) ? $instance['phone'] : '';
		$cps_phoneNumber        = isset( $instance['phoneNumber'] ) ? $instance['phoneNumber'] : '';
		$cps_email        		= isset( $instance['email'] ) ? $instance['email'] : '';
		$cps_address      		= isset( $instance['address'] ) ? $instance['address'] : '';
		$cps_addressLink      	= isset( $instance['addressLink'] ) ? $instance['addressLink'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'addressfirst' ) ); ?>"><?php esc_html_e( 'Address:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'addressfirst' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'addressfirst' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_addressfirst ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'addressLink' ) ); ?>"><?php esc_html_e( 'Address Link:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'addressLink' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'addressLink' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_addressLink ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_phone ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phoneNumber' ) ); ?>"><?php esc_html_e( 'phoneNumber:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phoneNumber' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phoneNumber' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_phoneNumber ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_email ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Fax:', 'ipm' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo esc_attr( $cps_address ); ?>" />
		</p>
		<?php

	}

}
