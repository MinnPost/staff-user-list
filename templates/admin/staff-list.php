<div id="main">
	<form method="post" action="options.php" class="admin-staff-user-post-list" id="admin-staff-user-post-list">
		<?php
		settings_fields( $tab ) . do_settings_sections( $tab );
		?>
		<?php $staff = $this->data->get_staff_members(); ?>
		<?php if ( ! empty( $staff ) ) : ?>
			<ul class="m-staff-list">
				<?php
				$staff_ordered = get_option( $this->option_prefix . 'staff_ordered', '' );
				if ( '' === $staff_ordered ) {
					$staff_ordered = $staff;
				}
				?>
				<?php foreach ( $staff_ordered as $staff_member ) : ?>
					<?php
					$key = array_search( $staff_member['id'], array_column( $staff, 'id' ), true );
					if ( is_numeric( $key ) ) {
						?>
						<li class="a-staff-member a-staff-member-<?php echo $staff_member['id']; ?> ui-state-default">
							<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
							<?php echo $staff_member['name']; ?>
							<input type="hidden" name="<?php echo $this->option_prefix; ?>staff_ordered[<?php echo $staff_member['id']; ?>][id]" value="<?php echo $staff_member['id']; ?>">
							<input type="hidden" name="<?php echo $this->option_prefix; ?>staff_ordered[<?php echo $staff_member['id']; ?>][name]" value="<?php echo $staff_member['name']; ?>">
						</li>
						<?php
					}
					?>
				<?php endforeach; ?>
				<?php foreach ( $staff as $staff_member ) : ?>
					<?php
					$key = array_search( $staff_member['id'], array_column( $staff_ordered, 'id' ), true );
					if ( empty( $key ) && 0 !== $key ) {
						?>
						<li class="a-staff-member a-staff-member-<?php echo $staff_member['id']; ?> ui-state-default">
							<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
							<?php echo $staff_member['name']; ?> (unsorted)
							<input type="hidden" name="<?php echo $this->option_prefix; ?>staff_ordered[<?php echo $staff_member['id']; ?>][id]" value="<?php echo $staff_member['id']; ?>">
							<input type="hidden" name="<?php echo $this->option_prefix; ?>staff_ordered[<?php echo $staff_member['id']; ?>][name]" value="<?php echo $staff_member['name']; ?>">
						</li>
						<?php
					}
					?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php submit_button( __( 'Save settings', 'staff-user-list' ) ); ?>
	</form>
</div>
