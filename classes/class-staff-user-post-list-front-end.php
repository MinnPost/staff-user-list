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
		$staff  = $this->get_staff_member( true );
		if ( ! empty( $staff ) ) {
			$output .= '<ul class="m-staff-list m-staff-list-bios">';
			foreach ( $staff as $staff_member ) {
				$output .= '<li class="m-staff-member m-staff-member-' . $staff_member['id'] . '">' . $staff_member['content'] . '</li>';
			}
			$output .= '</ul>';
		}
		return $output;
	}

	/**
	* Get each staff member
	*
	* @param bool $sorted
	* @return array $staff
	*
	*/
	private function get_staff_member( $sorted = true ) {
		$image_size   = get_option( $this->option_prefix . 'image_size', '' );
		$include_bio  = get_option( $this->option_prefix . 'include_bio', false );
		$include_name = get_option( $this->option_prefix . 'include_name', false );
		$bio_field    = get_option( $this->option_prefix . 'bio_field', '' );
		$name_field   = get_option( $this->option_prefix . 'name_field', '' );
		$method       = get_option( $this->option_prefix . 'method', '' );
		$staff_list   = $this->data->get_staff_members();
		if ( true === $sorted ) {
			$staff_list = get_option( $this->option_prefix . 'staff_ordered', $staff_list );
			if ( '' === $method ) {
				$staff_list_ids = array_column( $staff_list, 'id' );
				$staff_list     = $this->data->get_staff_members( $staff_list_ids );
			}
		}

		$staff = array();
		foreach ( $staff_list as $staff_member ) {
			if ( '' !== $bio_field ) {
				$bio = isset( $staff_member['meta'][ $bio_field ] ) ? $staff_member['meta'][ $bio_field ] : '';
			} else {
				$bio = '';
			}
			if ( '' !== $name_field ) {
				$name = isset( $staff_member['meta'][ $name_field ] ) ? $staff_member['meta'][ $name_field ] : '';
			} else {
				$name = '';
			}
			$staff[] = array(
				'id'      => $staff_member['id'],
				'content' => $this->get_staff_list_item( $staff_member['id'], $image_size, $include_bio, $bio, $include_name, $name, $method ),
			);
		}

		return $staff;
	}

	/**
	* List item for each staff member
	*
	* @param int $id
	* @param string $image_size
	* @param bool $include_bio
	* @param string $bio
	* @param bool $include_name
	* @param string $name
	* @param string $method
	* @return string $content
	*
	*/
	private function get_staff_list_item( $id, $image_size = '', $include_bio = false, $bio = '', $include_name = false, $name = '', $method = '' ) {
		$content      = '';
		$include_bio  = filter_var( $include_bio, FILTER_VALIDATE_BOOLEAN );
		$include_name = filter_var( $include_name, FILTER_VALIDATE_BOOLEAN );
		if ( '' === $method ) {
			$content .= '<figure class="a-archive-figure a-author-figure a-author-figure-' . $image_size . '">';
			if ( '' !== $image_size ) {
				$content .= get_the_post_thumbnail( $id, $image_size );
			}
			if ( true === $include_bio && '' !== $bio ) {
				$content .= '<figcaption>';
				if ( true === $include_name && '' !== $name ) {
					$content .= '<h3><a href="' . get_author_posts_url( $id, sanitize_title( $name[0] ) ) . '">' . $name[0] . '</a></h3>';
				}
				$content .= $bio[0];
				$content .= '</figcaption>';
			}
			$content .= '</figure>';
		} else {
			$content = $method( $id, $image_size, $include_bio, $include_name );
		}
		return $content;
	}
}
