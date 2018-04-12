<div id="main">
	<form method="post" action="options.php" class="admin-staff-user-post-list" id="admin-staff-user-post-list">
		<?php
		settings_fields( $tab ) . do_settings_sections( $tab );
		?>
		<?php $staff = $this->get_staff_members(); ?>
		<?php if ( ! empty( $staff ) ) : ?>
			<ul class="m-staff-list">
				<?php $staff_ordered = get_option( $this->option_prefix . 'staff_ordered', $staff ); ?>
				<?php foreach ( $staff_ordered as $staff_member ) : ?>
					<li class="a-staff-member a-staff-member-<?php echo $staff_member['id']; ?>">
						<?php echo $staff_member['name']; ?>
						<input type="hidden" name="<?php echo $this->option_prefix; ?>staff_ordered[<?php echo $staff_member['id']; ?>][id]" value="<?php echo $staff_member['id']; ?>">
						<input type="hidden" name="<?php echo $this->option_prefix; ?>staff_ordered[<?php echo $staff_member['id']; ?>][name]" value="<?php echo $staff_member['name']; ?>">
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php submit_button( __( 'Save settings', 'staff-user-list' ) ); ?>
	</form>
</div>
