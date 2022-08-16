<?php
/**
 * Adds custom items to Menus edit screen (nav-menus.php)
 *
 * @package codepages
 */

new impMenu();

class impMenu {

    /**
	 * Construct
	 */
    public function __construct() {

    add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_menu_items'), 10, 3 );
    add_filter( 'wp_edit_nav_menu_walker', array( $this, 'nav_menu_edit_walker'), 10, 2 );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'read_custom_menu_items' ) );

    } // end constructor

	/**
	 * Read custom menu itesm
	 * @param object $menu_item
	 * @return type
	 */
    function read_custom_menu_items( $menu_item ) {
        $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
        $menu_item->new_attribute = get_post_meta( $menu_item->ID, '_menu_item_new_attribute', true );
        $menu_item->open_left = get_post_meta( $menu_item->ID, '_menu_item_open_left', true );
        $menu_item->remove_link = get_post_meta( $menu_item->ID, '_menu_item_remove_link', true );
        $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
        return $menu_item;
    }

	/**
	 * Save custom menu items
	 * @param int $menu_id
	 * @param int $menu_item_db_id
	 * @param array $args
	 */
    function save_custom_menu_items( $menu_id, $menu_item_db_id, $args ) {

		//megamenu
		if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
        }
        $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );

		//new_attribute
		if (!isset($_REQUEST['edit-menu-item-new_attribute'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-new_attribute'][$menu_item_db_id] = '';
        }
        $new_attribute_enabled_value = $_REQUEST['edit-menu-item-new_attribute'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_new_attribute', $new_attribute_enabled_value );

		//open_left
		if (!isset($_REQUEST['edit-menu-item-open_left'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-open_left'][$menu_item_db_id] = '';
        }
        $open_left_enabled_value = $_REQUEST['edit-menu-item-open_left'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_open_left', $open_left_enabled_value );

		//remove_link
		if (!isset($_REQUEST['edit-menu-item-remove_link'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-remove_link'][$menu_item_db_id] = '';
        }
        $remove_link_enabled_value = $_REQUEST['edit-menu-item-remove_link'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_remove_link', $remove_link_enabled_value );

		//icon
		if (!isset($_REQUEST['edit-menu-item-icon'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-icon'][$menu_item_db_id] = '';
        }
        $icon_value = $_REQUEST['edit-menu-item-icon'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
    }

    /**
	 * Return walker name
	 * @return string
	 */
    function nav_menu_edit_walker() {
        return 'impMenuEdit';
    }
}



/**
 * This is a copy of Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class impMenuEdit extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)','imp' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)','imp'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr(implode(' ', $classes )); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo (0 == $depth ? 'style="display: none;"' : ''); ?>><?php esc_html_e( 'sub item', 'imp'); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','imp'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','imp'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item','imp'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? esc_url( admin_url( 'nav-menus.php' ) ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item','imp' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'URL','imp'); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Navigation Label','imp' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Title Attribute','imp' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab','imp' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'CSS Classes (optional)','imp' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)','imp' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Description','imp' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','imp'); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move','imp' ); ?></span>
						<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one','imp' ); ?></a>
						<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one','imp' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top','imp' ); ?></a>
					</label>
				</p>

				<!-- Menu Icon item -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_icon', true);
				?>
				<p>
				<div class="clearboth"></div>
          <div class="icon-menu-container">
          <?php
          $title_font_awesome   = 'Icon(EX: fa fa-coffee)';
          $title_themify_icons  = 'Icon(EX: ti ti-home)';
          ?>
          <p class="description description-wide">
          <label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
          <?php echo esc_html( $title_font_awesome ); ?> <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome</a><br />
          <?php echo esc_html( $title_themify_icons ); ?> <a href="http://themify.me/themify-icons" target="_blank">Themify Icons</a><br />
          <input type="text" value="<?php echo esc_attr( $value ); ?>" id="edit-menu-item-icon_<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr($item_id); ?>" name="edit-menu-item-icon[<?php echo esc_attr($item_id); ?>]" />
          </label>
          </p>
				</div>
				</p>
				<!-- /Menu Icon item -->

				<!-- Mega Menu item -->
				<?php

				$value = get_post_meta( $item->ID, '_menu_item_megamenu', true);
				?>
				<div class="clearboth"></div>
				<div class="mega-menu-container">
					<p class="field-link-mega">
						<label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
							<?php esc_html_e( 'Create Mega Menu for this item', 'imp' ); ?>
						</label>
					</p>
				</div>

				<!-- /Mega Menu item -->

				<!-- New attribute -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_new_attribute', true);
				?>
				<div class="clearboth"></div>
          <div class="new-attribute-container">
					<p class="field-link-new-attribute">
						<label for="edit-menu-item-new_attribute-<?php echo esc_attr($item_id); ?>">
							<input type="text" value="<?php echo esc_attr( $value ); ?>" class="mega-menu-chk" id="edit-menu-item-new_attribute-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-new_attribute[<?php echo esc_attr($item_id); ?>]" />
							<?php esc_html_e( 'New', 'imp' ); ?>
						</label>
					</p>
				</div>
				<!-- /New attribute -->

				<!-- Open Left -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_open_left', true);
				?>
				<div class="clearboth"></div>
          <div class="open-left-container">
					<p class="field-link-open-left">
						<label for="edit-menu-item-open_left-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-open_left-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-open_left[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
							<?php esc_html_e( 'Open Sub Menu On The Left', 'imp' ); ?>
						</label>
					</p>
				</div>
				<!-- /New attribute -->

				<!-- Remove Link -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_remove_link', true);
				?>
				<div class="clearboth"></div>
                <div class="remove-link-container">
					<p class="field-link-remove-link">
						<label for="edit-menu-item-remove_link-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="remove-link-chk" id="edit-menu-item-remove_link-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-remove_link[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
							<?php esc_html_e( 'Remove Link', 'imp' ); ?>
						</label>
					</p>
				</div>
				<!-- /Hide Navigation Label -->

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s','imp'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php esc_html_e( 'Remove','imp'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel','imp'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}

/**
 * codepages Menu Widget Walker
 */
class imp_walker_nav_menu extends Walker_Nav_Menu {

	/**
	 * Current item
	 * @var object
	 */
	private $show_icons;

	/**
	 * Current item
	 * @var object
	 */
	private $current_item;

	/**
	 * If multicolumn is activated
	 * @var boolean
	 */
	private $is_multi_columns = false;

	/**
	 * If li element was started (used with is_multi_columns)
	 * @var boolean
	 */
	private $li_started = false;

	public function __construct($show_icons = false) {

		$this -> show_icons = $show_icons;
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$class = '';

    if ($this -> is_multi_columns && $depth >= 1) {
			$class = 'imp-sub-fullwidth';
		} elseif ($depth == 0) {
      $class = 'dropdown-menu sub-nav-group';
    } else {
			$class = 'dropdown-menu sub-sub-nav';
		}

		$output .= "\n$indent<ul class=\"".$class."\">\n";

		if ($this -> is_multi_columns && $depth == 0) {
			$output .= '<li>';
		}

    if ($this -> is_multi_columns === true && $depth == 0) {
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
    }

	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {

    if ($this -> is_multi_columns === true && $depth == 0) {
      $output .= "</div>\n";
			$output .= "</div>\n";
		}

		if ($this -> is_multi_columns && $depth == 0) {
			$output .= '</li>';
		}

		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		//set curret item to use in start_lvl
		$this -> current_item = $item;

		//set if multi columns menu is enabled
		if ($item -> megamenu == 'enabled' && $depth == 0) {
			$this -> is_multi_columns = true;
			$this -> columns = 3;
			switch ($item -> childrenItems) {
				case 1: $this -> columns = 12; break;
				case 2: $this -> columns = 6; break;
				case 3: $this -> columns = 4; break;
				case 4: $this -> columns = 3; break;
				case 5: $this -> columns = 2; break;
				case 6: $this -> columns = 2; break;
				default: $this -> columns = 1; break;
			}

		} else if ($depth == 0) {
			$this -> is_multi_columns = false;
		}

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		if ($this -> is_multi_columns === true && $depth == 0) {
			$classes[] = 'imp-fullwidth';
			$classes[] = 'imp-dropdown';

		} else if ($this -> is_multi_columns !== true && $item -> hasChildren) {
			$classes[] = 'parent-list';
			if ($depth > 0) {
				$classes[] = 'dropdown-submenu';
				if ($item -> open_left) {
					$classes[] = 'open-left';
				}

			} else {
				$classes[] = 'dropdown imp-submenu-dropdown';
			}
		}

		if ($this -> is_multi_columns === true && $depth == 1) {
			$classes[] = 'col-md-'.$this -> columns;
		}

		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="mega-menu-content ' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		if ($this -> is_multi_columns === true && $depth == 1) {
			$output .= $indent . '<div' . $id . $class_names .'>';
		} else {
			$output .= $indent . '<li' . $id . $class_names .'>';
		}



		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['class']	= ' ';

		if ($item -> remove_link != 'enabled') {
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		}


		if ($item -> hasChildren && $depth == 0) {
			$atts['class'] .= 'dropdown-toggle js-activated ';
		}

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		if ($this -> is_multi_columns === true && $depth == 1) {
			$item_output .= '<h5>';
		}

		if ($item -> remove_link != 'enabled') {
			$item_output .= '<a'. $attributes .'>';
		}

    if (!empty($item -> icon)) {
      if ($item -> icon || $depth != 0) {
        $item_output .= '<i class="'.esc_attr($item -> icon).'"></i>';
      }
    }


		/** This filter is documented in wp-includes/post-template.php */
		$navigation_label = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output .= $args->link_before . $navigation_label . $args->link_after;

    	// if ($depth == 1 && $item -> hasChildren && $this -> is_multi_columns !== true) {
		// 	$item_output .= '<i class="fa fa-angle-right"></i>';
		// }

		if ($item -> new_attribute) {
			$item_output .= '<span class="new-button primary-bg">'.$item -> new_attribute.'</span>';
		}

		if ($item -> remove_link != 'enabled') {
			$item_output .= '</a>';
		}

		if ($this -> is_multi_columns === true && $depth == 1) {
			$item_output .= '</h5>';
		}

		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ($this -> is_multi_columns === true && $depth == 1) {
			$output .= "</div>\n";
		} else {
			$output .= "</li>\n";
		}
	}

	/**
	 * Display element
	 * @param type $element
	 * @param type $children_elements
	 * @param type $max_depth
	 * @param type $depth
	 * @param type $args
	 * @param type $output
	 * @return type
	 */
	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
		// check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
		$element->childrenItems = isset($children_elements[$element->ID]) && is_array($children_elements[$element->ID]) ? count($children_elements[$element->ID]) : 0;

		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
