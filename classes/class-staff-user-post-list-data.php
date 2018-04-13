<?php
/**
 * Class file for the Staff_User_Post_List_Data class.
 *
 * @file
 */

if ( ! class_exists( 'Staff_User_Post_List' ) ) {
	die();
}

/**
 * Load data
 */
class Staff_User_Post_List_Data {

	protected $option_prefix;
	protected $version;
	protected $slug;
	//protected $cache;

	/**
	* Constructor which sets up front end
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

		$this->add_actions();

	}

	/**
	* Create the action hooks
	*
	*/
	public function add_actions() {

	}

	public function get_staff_members( $ids = array() ) {
		$users = array();

		$role = get_option( $this->option_prefix . 'staff_user_role', '' );
		if ( '' !== $role ) {
			$args = array(
				'role' => $role,
			);

			if ( ! empty( $ids ) ) {
				$args['include'] = $ids;
				$args['orderby'] = 'include';
			}

			$users = get_users( $args );

			if ( $users ) {
				foreach ( $users as $item ) {
					$users[] = array(
						'id'   => $item->data->ID,
						'name' => $item->data->display_name,
						'type' => 'user',
						'meta' => get_user_meta( $item->data->ID ),
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
			if ( ! empty( $ids ) ) {
				$args['include'] = $ids;
				$args['orderby'] = 'post__in';
			}
			$posts = get_posts( $args );
			if ( $posts ) {
				foreach ( $posts as $post ) {
					$users[] = array(
						'id'   => $post->ID,
						'name' => $post->post_title,
						'type' => 'post',
						'meta' => get_post_meta( $post->ID ),
					);
				}
			}
		}
		return $users;
	}
}
