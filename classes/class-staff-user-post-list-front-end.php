<?php
/**
 * Class file for the Staff_User_Post_List_Front_End class.
 *
 * @file
 */

if ( ! class_exists( 'Staff_User_Post_List' ) ) {
	die();
}

/**
 * Create default WordPress front end functionality
 */
class Staff_User_Post_List_Front_End {

	protected $option_prefix;
	protected $version;
	protected $slug;
	protected $data;
	//protected $cache;

	/**
	* Constructor which sets up front end
	*
	* @param string $option_prefix
	* @param string $version
	* @param string $slug
	* @param object $data
	* @throws \Exception
	*/
	public function __construct( $option_prefix, $version, $slug, $data ) {

		$this->option_prefix = $option_prefix;
		$this->version       = $version;
		$this->slug          = $slug;
		$this->data          = $data;
		//$this->cache         = $cache;

		//$this->mp_mem_transients = $this->cache->mp_mem_transients;

		$this->add_actions();

	}

	/**
	* Create the action hooks
	*
	*/
	public function add_actions() {
		if ( ! is_admin() ) {
			add_shortcode( 'mp_staff', array( $this, 'mp_staff' ) );
		}
	}

	private function display_staff_list( $sorted = true ) {
		$staff_list = $this->data->get_staff_members();
		if ( true === $sorted ) {
			$staff_list = get_option( $this->option_prefix . 'staff_ordered', $staff_list );
			$staff      = array();
			foreach ( $staff_list as $staff_member ) {
				$staff[] = array(
					'id'      => $staff_member['id'],
					'content' => minnpost_get_author_figure( $staff_member['id'], 'thumbnail', true, true ),
				);
			}
		}

		return $staff;
	}

	/**
	* Staff list
	* This is for the staff list shortcode
	*
	* @param array $atts
	* @param string $content
	* @return string $output
	*
	*/
	public function mp_staff( $atts, $content ) {
		$output = '';
		$args   = shortcode_atts(
			array(),
			$atts
		);
		$staff  = $this->display_staff_list( true );
		if ( ! empty( $staff ) ) {
			$output .= '<ul class="m-staff-list m-staff-list-bios">';
			foreach ( $staff as $staff_member ) {
				$output .= '<li class="m-staff-member m-staff-member-' . $staff_member['id'] . '">' . $staff_member['content'] . '</li>';
			}
			$output .= '</ul>';
		}
		return $output;
	}
}
