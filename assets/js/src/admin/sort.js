jQuery( document ).ready( function( $ ) {
	if ( 0 < $( '.m-staff-list' ).length ) {
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
