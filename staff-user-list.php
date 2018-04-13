<?php
/*
Plugin Name: Staff User/Post List
Description: This plugin creates a staff shortcode from selected WordPress users or post types.
Version: 0.0.1
Author: Jonathan Stegall
Author URI: https://code.minnpost.com
Text Domain: staff-user-post-list
License: GPL2+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class Staff_User_Post_List {

	/**
	* @var string
	* The plugin version
	*/
	private $version;

	/**
	* @var string
	* The plugin's slug
	*/
	protected $slug;

	/**
	* @var string
	* The plugin's prefix for saving options
	*/
	protected $option_prefix;

	/**
	* @var object
	* Load and initialize the MinnPost_Membership_Cache class
	*/
	//public $cache;

	/**
	* @var object
	* Load and initialize the MinnPost_Membership_Member_Level class
	*/
	//public $member_levels;

	/**
	* @var object
	* Load and initialize the Staff_User_Post_List_Admin class
	*/
	public $admin;

	/**
	* @var object
	* Load and initialize the MinnPost_Membership_Front_End class
	*/
	//public $front_end;

	/**
	 * @var object
	 * Static property to hold an instance of the class; this seems to make it reusable
	 *
	 */
	static $instance = null;

	/**
	* Load the static $instance property that holds the instance of the class.
	* This instance makes the class reusable by other plugins
	*
	* @return object
	*
	*/
	static public function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Staff_User_Post_List();
		}
		return self::$instance;
	}

	/**
	 * This is our constructor
	 *
	 * @return void
	 */
	public function __construct() {

		$this->version       = '0.0.1';
		$this->slug          = 'staff-user-post-list';
		$this->option_prefix = 'staff_user_post_list_';

		// wp cache settings
		//$this->cache = $this->cache();
		// admin settings
		$this->admin = $this->admin();
		// front end settings
		//$this->front_end = $this->front_end();

		$this->add_actions();

	}

	/**
	* Do actions
	*
	*/
	private function add_actions() {
		add_action( 'plugins_loaded', array( $this, 'textdomain' ) );
		register_activation_hook( __FILE__, array( $this, 'add_roles_capabilities' ) );
	}

	/**
	 * Plugin cache
	 *
	 * @return object $cache
	 */
	public function cache() {
		require_once( plugin_dir_path( __FILE__ ) . 'classes/class-minnpost-membership-cache.php' );
		$cache = new MinnPost_Membership_Cache( $this->option_prefix, $this->version, $this->slug );
		return $cache;
	}

	/**
	 * Plugin admin
	 *
	 * @return object $admin
	 */
	public function admin() {
		require_once( plugin_dir_path( __FILE__ ) . 'classes/class-staff-user-post-list-admin.php' );
		$admin = new Staff_User_Post_List_Admin( $this->option_prefix, $this->version, $this->slug );
		add_filter( 'plugin_action_links', array( $this, 'plugin_action_links' ), 10, 2 );
		return $admin;
	}

	/**
	 * Plugin front end
	 *
	 * @return object $front_end
	 */
	public function front_end() {
		require_once( plugin_dir_path( __FILE__ ) . 'classes/class-minnpost-membership-front-end.php' );
		$front_end = new MinnPost_Membership_Front_End( $this->option_prefix, $this->version, $this->slug, $this->member_levels, $this->cache );
		return $front_end;
	}

	/**
	 * Load textdomain
	 *
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( 'staff-user-post-list', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	* Add roles and capabilities
	* This adds the manage_staff capability to the admin role
	*
	* It also allows other plugins to add the capability to other roles
	*
	*/
	public function add_roles_capabilities() {

		// by default, only administrators can configure the plugin
		$role = get_role( 'administrator' );
		$role->add_cap( 'manage_staff' );

		// hook that allows other roles to configure the plugin as well
		$roles = apply_filters( $this->option_prefix . '_manage_staff', null );

		// for each role that we have, give it the configure salesforce capability
		if ( null !== $roles ) {
			foreach ( $roles as $role ) {
				$role = get_role( $role );
				$role->add_cap( 'manage_staff' );
			}
		}

	}

	/**
	* Display a Settings link on the main Plugins page
	*
	* @param array $links
	* @param string $file
	* @return array $links
	* These are the links that go with this plugin's entry
	*/
	public function plugin_action_links( $links, $file ) {
		if ( plugin_basename( __FILE__ ) === $file ) {
			$settings = '<a href="' . get_admin_url() . 'users.php?page=' . $this->slug . '">' . __( 'Settings', 'staff-user-post-list' ) . '</a>';
			array_unshift( $links, $settings );
		}
		return $links;
	}

}

// Instantiate our class
$staff_user_post_list = Staff_User_Post_List::get_instance();
