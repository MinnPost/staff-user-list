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
				$output .= '<li class="m-staff-member-info m-staff-member-info-excerpt m-staff-member-info-singular m-staff-member-info-single m-staff-member-info-single-' . $staff_member['id'] . '">' . $staff_member['content'] . '</li>';
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
		$image_size    = get_option( $this->option_prefix . 'image_size', '' );
		$image_size    = apply_filters( 'staff_user_post_list_image_size', $image_size );
		$include_bio   = get_option( $this->option_prefix . 'include_bio', false );
		$bio_field     = get_option( $this->option_prefix . 'bio_field', '' );
		$include_name  = get_option( $this->option_prefix . 'include_name', false );
		$name_field    = get_option( $this->option_prefix . 'name_field', '' );
		$include_title = get_option( $this->option_prefix . 'include_title', false );
		$title_field   = get_option( $this->option_prefix . 'title_field', '' );
		$method        = get_option( $this->option_prefix . 'method', '' );
		$staff_list    = $this->data->get_staff_members();
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
				if ( isset( $bio[0] ) ) {
					$bio = $bio[0];
				}
				$bio = apply_filters( 'the_content', $bio );
			} else {
				$bio = '';
			}
			if ( '' !== $name_field ) {
				$name = isset( $staff_member['meta'][ $name_field ] ) ? $staff_member['meta'][ $name_field ] : '';
				if ( isset( $name[0] ) ) {
					$name = $name[0];
				}
			} else {
				$name = '';
			}
			if ( '' !== $title_field ) {
				$title = isset( $staff_member['meta'][ $title_field ] ) ? $staff_member['meta'][ $title_field ] : '';
				if ( isset( $title[0] ) ) {
					$title = $title[0];
				}
			} else {
				$title = '';
			}
			$staff[] = array(
				'id'      => $staff_member['id'],
				'content' => $this->get_staff_list_item( $staff_member['id'], $image_size, $include_bio, $bio_field, $bio, $include_name, $name_field, $name, $include_title, $title_field, $title, $method ),
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
	* @param bool $include_title
	* @param string $title
	* @param string $method
	* @return string $content
	*
	*/
	private function get_staff_list_item( $id, $image_size = '', $include_bio = false, $bio_field = '', $bio = '', $include_name = false, $name_field = '', $name = '', $include_title = false, $title_field = '', $title = '', $method = '' ) {
		$content       = '';
		$include_bio   = filter_var( $include_bio, FILTER_VALIDATE_BOOLEAN );
		$include_name  = filter_var( $include_name, FILTER_VALIDATE_BOOLEAN );
		$include_title = filter_var( $include_title, FILTER_VALIDATE_BOOLEAN );
		if ( '' === $method ) {
			$content .= '<figure class="a-archive-figure a-author-figure a-author-figure-' . $image_size . '">';
			if ( '' !== $image_size ) {
				$content .= get_the_post_thumbnail( $id, $image_size );
			}
			if ( true === $include_bio && '' !== $bio ) {
				$content .= '<figcaption>';
				if ( true === $include_name && '' !== $name ) {
					$content .= '<h3 class="a-author-title"><a href="' . get_author_posts_url( $id, sanitize_title( $name ) ) . '">' . $name . '</a>';
					if ( true === $include_title && '' !== $title ) {
						$content .= '&nbsp;|&nbsp;<span class="a-entry-author-job-title">' . $title . '</span>';
					}
					$content .= '</h3>';
				}
				$content .= $bio;
				$content .= '</figcaption>';
			}
			$content .= '</figure>';
		} else {
			$content = $method( $id, $image_size, $bio_field, $include_bio, $name_field, $include_name, $title_field, $include_title );
		}
		return $content;
	}
}
