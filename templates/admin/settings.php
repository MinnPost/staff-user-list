<div id="main">
	<form method="post" action="options.php">
		<?php
		settings_fields( $tab ) . do_settings_sections( $tab );
		?>
		<?php submit_button( __( 'Save settings', 'staff-user-list' ) ); ?>
	</form>
</div>
