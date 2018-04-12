<?php
/**
 * Class file for the Staff_User_Post_List_Admin class.
 *
 * @file
 */

if ( ! class_exists( 'Staff_User_Post_List' ) ) {
	die();
}

/**
 * Create default WordPress admin functionality to configure the plugin.
 */
class Staff_User_Post_List_Admin {

	protected $option_prefix;
	protected $version;
	protected $slug;
	//protected $cache;

	/**
	* Constructor which sets up admin pages
	*
	* @param string $option_prefix
	* @param string $version
	* @param string $slug
	* @param object $cache
	* @throws \Exception
	*/
	public function __construct( $option_prefix, $version, $slug ) {

		$this->option_prefix = $option_prefix;
		$this->version       = $version;
		$this->slug          = $slug;
		//$this->cache         = $cache;

		//$this->mp_mem_transients = $this->cache->mp_mem_transients;

		$this->tabs = $this->get_admin_tabs();

		$this->add_actions();

	}

	/**
	* Create the action hooks to create the admin page(s)
	*
	*/
	public function add_actions() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );
			add_action( 'admin_init', array( $this, 'admin_settings_form' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_and_styles' ) );
			//add_action( 'admin_post_post_member_level', array( $this, 'prepare_member_level_data' ) );
			//add_action( 'admin_post_delete_member_level', array( $this, 'delete_member_level' ) );
		}

	}

	/**
	* Create WordPress admin options page
	*
	*/
	public function create_admin_menu() {
		$capability = 'manage_options';
		add_users_page( 'Staff User/Post List', 'Staff List', $capability, $this->slug, array( $this, 'show_admin_page' ) );
	}


	/**
	* Create WordPress admin options page tabs
	*
	* @return array $tabs
	*
	*/
	private function get_admin_tabs() {
		$tabs = array(
			'staff_list'    => 'Staff List',
			'page_settings' => 'Page Settings',
		); // this creates the tabs for the admin
		return $tabs;
	}

	/**
	* Display the admin settings page
	*
	* @return void
	*/
	public function show_admin_page() {
		$get_data = filter_input_array( INPUT_GET, FILTER_SANITIZE_STRING );
		?>
		<div class="wrap">
			<h1><?php _e( get_admin_page_title() , 'staff-user-post-list' ); ?></h1>

			<?php
			$tabs = $this->tabs;
			$tab  = isset( $get_data['tab'] ) ? sanitize_key( $get_data['tab'] ) : 'staff_list';
			$this->render_tabs( $tabs, $tab );

			switch ( $tab ) {
				case 'staff_list':
					require_once( plugin_dir_path( __FILE__ ) . '/../templates/admin/staff-list.php' );
					break;
				case 'page_settings':
					require_once( plugin_dir_path( __FILE__ ) . '/../templates/admin/settings.php' );
					break;
				default:
					require_once( plugin_dir_path( __FILE__ ) . '/../templates/admin/settings.php' );
					break;
			} // End switch().
			?>
		</div>
		<?php
	}

	/**
	* Render tabs for settings pages in admin
	* @param array $tabs
	* @param string $tab
	*/
	private function render_tabs( $tabs, $tab = '' ) {

		$get_data = filter_input_array( INPUT_GET, FILTER_SANITIZE_STRING );

		$current_tab = $tab;
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $tabs as $tab_key => $tab_caption ) {
			$active = $current_tab === $tab_key ? ' nav-tab-active' : '';
			echo sprintf( '<a class="nav-tab%1$s" href="%2$s">%3$s</a>',
				esc_attr( $active ),
				esc_url( '?page=' . $this->slug . '&tab=' . $tab_key ),
				esc_html( $tab_caption )
			);
		}
		echo '</h2>';

		if ( isset( $get_data['tab'] ) ) {
			$tab = sanitize_key( $get_data['tab'] );
		} else {
			$tab = '';
		}
	}

	/**
	* Register items for the settings api
	* @return void
	*
	*/
	public function admin_settings_form() {

		$get_data = filter_input_array( INPUT_GET, FILTER_SANITIZE_STRING );
		$page     = isset( $get_data['tab'] ) ? sanitize_key( $get_data['tab'] ) : 'staff_list';
		$section  = isset( $get_data['tab'] ) ? sanitize_key( $get_data['tab'] ) : 'staff_list';

		require_once( plugin_dir_path( __FILE__ ) . '/../settings-functions.inc.php' );

		$all_field_callbacks = array(
			'text'       => 'display_input_field',
			'checkboxes' => 'display_checkboxes',
			'select'     => 'display_select',
			'link'       => 'display_link',
		);

		$this->staff_list( 'staff_list', 'staff_list', $all_field_callbacks );
		//$this->page_settings( 'page_settings', 'page_settings', $all_field_callbacks );

	}

	/**
	* Admin styles. Load the CSS and/or JavaScript for the plugin's settings
	*
	* @return void
	*/
	public function admin_scripts_and_styles() {
		wp_enqueue_script( $this->slug . '-admin', plugins_url( '../assets/js/' . $this->slug . '-admin.min.js', __FILE__ ), array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'admin-js' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	/**
	* Fields for the Staff List tab
	* This runs add_settings_section once, as well as add_settings_field and register_setting methods for each option
	*
	* @param string $page
	* @param string $section
	* @param array $callbacks
	*/
	private function staff_list( $page, $section, $callbacks ) {
		$tabs = $this->tabs;
		foreach ( $tabs as $key => $value ) {
			if ( $key === $page ) {
				$title = $value;
			}
		}
		add_settings_section( $page, $title, null, $page );

		$settings = array(
			'staff_user_role'      => array(
				'title'    => __( 'Staff user role', 'staff-user-post-list' ),
				'callback' => $callbacks['select'],
				'page'     => $page,
				'section'  => $section,
				'args'     => array(
					'type'     => 'select',
					'desc'     => '',
					'constant' => '',
					'items'    => $this->get_role_options(),
				),
			),
			'post_type' => array(
				'title'    => __( 'Additional post type', 'staff-user-post-list' ),
				'callback' => $callbacks['select'],
				'page'     => $page,
				'section'  => $section,
				'args'     => array(
					'type'     => 'select',
					'desc'     => '',
					'constant' => '',
					'items'    => $this->get_post_type_options(),
				),
			),
			'post_meta_key'        => array(
				'title'    => __( 'Post meta key', 'staff-user-post-list' ),
				'callback' => $callbacks['text'],
				'page'     => $page,
				'section'  => $section,
				'args'     => array(
					'type'     => 'text',
					'desc'     => '',
					'constant' => '',
				),
			),
			'post_meta_value'      => array(
				'title'    => __( 'Post meta value', 'staff-user-post-list' ),
				'callback' => $callbacks['text'],
				'page'     => $page,
				'section'  => $section,
				'args'     => array(
					'type'     => 'text',
					'desc'     => '',
					'constant' => '',
				),
			),

		);

		foreach ( $settings as $key => $attributes ) {
			$id       = $this->option_prefix . $key;
			$name     = $this->option_prefix . $key;
			$title    = $attributes['title'];
			$callback = $attributes['callback'];
			$page     = $attributes['page'];
			$section  = $attributes['section'];
			$args     = array_merge(
				$attributes['args'],
				array(
					'title'     => $title,
					'id'        => $id,
					'label_for' => $id,
					'name'      => $name,
				)
			);

			// if there is a constant and it is defined, don't run a validate function if there is one
			if ( isset( $attributes['args']['constant'] ) && defined( $attributes['args']['constant'] ) ) {
				$validate = '';
			}

			add_settings_field( $id, $title, $callback, $page, $section, $args );
			register_setting( $section, $id );
		}
	}

	public function get_staff_members() {
		$users = array();

		$role = get_option( $this->option_prefix . 'staff_user_role', '' );
		if ( '' !== $role ) {
			$user_query = get_users(
				array(
					'role' => $role,
				)
			);
			if ( $users ) {
				foreach ( $user_query as $item ) {
					$users[] = array(
						'id'   => $item->data->ID,
						'name' => $item->data->display_name,
					);
				}
			}
		}

		$post_type       = get_option( $this->option_prefix . 'post_type', '' );
		$post_meta_key   = get_option( $this->option_prefix . 'post_meta_key', '' );
		$post_meta_value = get_option( $this->option_prefix . 'post_meta_value', '' );

		if ( '' !== $post_type ) {
			$args['post_type']      = $post_type;
			$args['posts_per_page'] = -1;
			if ( '' !== $post_meta_key && '' !== $post_meta_value ) {
				$args['meta_key']   = $post_meta_key;
				$args['meta_value'] = $post_meta_value;
			}
			$posts = get_posts( $args );
			if ( $posts ) {
				foreach ( $posts as $post ) {
					$users[] = array(
						'id'   => $post->ID,
						'name' => $post->post_title,
					);
				}
			}
		}
		return $users;
	}

	/**
	* WordPress user roles as setting field options
	*
	* @param array $items
	*/
	private function get_role_options() {
		$items = array();
		$roles = get_editable_roles();
		foreach ( $roles as $key => $role ) {
			$items[] = array(
				'value' => $key,
				'text'  => $role['name'],
			);
		}
		return $items;
	}

	/**
	* WordPress post types as setting field options
	*
	* @param array $items
	*/
	private function get_post_type_options() {
		$items = array();
		$types = get_post_types();
		foreach ( $types as $post_type ) {
			$items[] = array(
				'value' => $post_type,
				'text'  => $post_type,
			);
		}
		return $items;
	}

}
