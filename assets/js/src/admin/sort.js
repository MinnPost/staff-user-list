jQuery( document ).ready( function( $ ) {
	if ( $( '.m-staff-list' ).length > 0 ) {
		$( '.m-staff-list' ).sortable({
			axis: 'y',
			cursor: 'move',
			opacity: 0.6,
			cursor: 'move',
			distance: 5,
			update: function() {}
		});
	}
});
