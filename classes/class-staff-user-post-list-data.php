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

			$user_objects = get_users( $args );

			if ( $user_objects ) {
				foreach ( $user_objects as $key => $item ) {
					$users[ $key ] = array(
						'id'           => $item->data->ID,
						'slug'         => sanitize_title( preg_replace( '/(\s\s+|\t|\n)/', ' ', $item->data->display_name ) ),
						'display_name' => $item->data->display_name,
						'type'         => 'user',
						'first_name'   => get_user_meta( $item->data->ID, 'first_name', true ),
						'last_name'    => get_user_meta( $item->data->ID, 'last_name', true ),
					);

					$args['post_type']      = 'guest-author';
					$args['posts_per_page'] = 1;
					$args['meta_key']       = 'cap-linked_account';
					$args['meta_value']     = $item->data->user_email;
					$posts                  = get_posts( $args );

					if ( $posts ) {
						foreach ( $posts as $post ) {
							$users[ $key ]['id'] = $post->ID;

							$first_name = get_post_meta( $post->ID, 'cap-first_name', true );
							if ( '' !== $first_name ) {
								$users[ $key ]['first_name'] = $first_name;
							}
							$last_name = get_post_meta( $post->ID, 'cap-last_name', true );
							if ( '' !== $last_name ) {
								$users[ $key ]['last_name'] = $last_name;
							}

							$users[ $key ]['meta'] = get_post_meta( $post->ID );
						}
					}
				}
			}
		}

		$columns = array_column( $users, 'last_name' );
		array_multisort( $columns, SORT_ASC, $users );

		return $users;
	}
}
