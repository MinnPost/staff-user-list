<div id="main">
	<form method="post" action="options.php">
		<?php
		settings_fields( $tab ) . do_settings_sections( $tab );
		?>
		<?php submit_button( __( 'Save settings', 'staff-user-list' ) ); ?>
	</form>
	<?php $staff = $this->get_staff_members(); ?>
	<?php if ( ! empty( $staff ) ) : ?>
		<ul class="m-staff-list">
			<?php $staff_ordered = get_option( 'staff_ordered', $staff ); ?>
			<?php foreach ( $staff_ordered as $staff_member ) : ?>
				<li class="a-staff-member a-staff-member-<?php echo $staff_member['id']; ?>">
					<?php echo $staff_member['name']; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
