jQuery(document).ready(function($){

	/********************************************/
	/* AJAX SAVE FORM */
	/********************************************/
	/*$(document).ready(function() {
	   $('#admin-staff-user-post-list').submit(function() {
	      $(this).ajaxSubmit({
	      	 onLoading: $('.loader').show(),
	         success: function(){
	         	$('.loader').hide();
	            $('#save-result').fadeIn();
	            setTimeout(function() {
				    $('#save-result').fadeOut('fast');
				}, 2000);
	         },
	         timeout: 5000
	      });
	      return false;
	   });
	});*/

	/********************************************/
	/* SORTABLE FILTER FIELDS */
	/********************************************/
	$('.a-staff-member').mouseover(function() {
		$(this).find('.sort-arrows').stop(true, true).show();
	});
	$('.a-staff-member').mouseout(function() {
		$(this).find('.sort-arrows').stop(true, true).hide();
	});

	$(document).ready(function () {
		$('.m-staff-list').sortable({
			axis: 'y',
			curosr: 'move'
		});
	});

	$(document).ready(function () {
		$('.property-detail-items-list').sortable({
			axis: 'y',
			curosr: 'move'
		});
	});

	$(document).ready(function () {
		$('.agent-detail-items-list').sortable({
			axis: 'y',
			curosr: 'move'
		});
	});

});
