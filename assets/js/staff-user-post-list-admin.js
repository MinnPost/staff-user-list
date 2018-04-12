'use strict';

jQuery(document).ready(function ($) {

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
	$('.a-staff-member').mouseover(function () {
		$(this).find('.sort-arrows').stop(true, true).show();
	});
	$('.a-staff-member').mouseout(function () {
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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNvcnQuanMiXSwibmFtZXMiOlsialF1ZXJ5IiwiZG9jdW1lbnQiLCJyZWFkeSIsIiQiLCJtb3VzZW92ZXIiLCJmaW5kIiwic3RvcCIsInNob3ciLCJtb3VzZW91dCIsImhpZGUiLCJzb3J0YWJsZSIsImF4aXMiLCJjdXJvc3IiXSwibWFwcGluZ3MiOiI7O0FBQUFBLE9BQU9DLFFBQVAsRUFBaUJDLEtBQWpCLENBQXVCLFVBQVNDLENBQVQsRUFBVzs7QUFFakM7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBaUJBO0FBQ0E7QUFDQTtBQUNBQSxHQUFFLGlCQUFGLEVBQXFCQyxTQUFyQixDQUErQixZQUFXO0FBQ3pDRCxJQUFFLElBQUYsRUFBUUUsSUFBUixDQUFhLGNBQWIsRUFBNkJDLElBQTdCLENBQWtDLElBQWxDLEVBQXdDLElBQXhDLEVBQThDQyxJQUE5QztBQUNBLEVBRkQ7QUFHQUosR0FBRSxpQkFBRixFQUFxQkssUUFBckIsQ0FBOEIsWUFBVztBQUN4Q0wsSUFBRSxJQUFGLEVBQVFFLElBQVIsQ0FBYSxjQUFiLEVBQTZCQyxJQUE3QixDQUFrQyxJQUFsQyxFQUF3QyxJQUF4QyxFQUE4Q0csSUFBOUM7QUFDQSxFQUZEOztBQUlBTixHQUFFRixRQUFGLEVBQVlDLEtBQVosQ0FBa0IsWUFBWTtBQUM3QkMsSUFBRSxlQUFGLEVBQW1CTyxRQUFuQixDQUE0QjtBQUMzQkMsU0FBTSxHQURxQjtBQUUzQkMsV0FBUTtBQUZtQixHQUE1QjtBQUlBLEVBTEQ7O0FBT0FULEdBQUVGLFFBQUYsRUFBWUMsS0FBWixDQUFrQixZQUFZO0FBQzdCQyxJQUFFLDZCQUFGLEVBQWlDTyxRQUFqQyxDQUEwQztBQUN6Q0MsU0FBTSxHQURtQztBQUV6Q0MsV0FBUTtBQUZpQyxHQUExQztBQUlBLEVBTEQ7O0FBT0FULEdBQUVGLFFBQUYsRUFBWUMsS0FBWixDQUFrQixZQUFZO0FBQzdCQyxJQUFFLDBCQUFGLEVBQThCTyxRQUE5QixDQUF1QztBQUN0Q0MsU0FBTSxHQURnQztBQUV0Q0MsV0FBUTtBQUY4QixHQUF2QztBQUlBLEVBTEQ7QUFPQSxDQXJERCIsImZpbGUiOiJzdGFmZi11c2VyLXBvc3QtbGlzdC1hZG1pbi5qcyIsInNvdXJjZXNDb250ZW50IjpbImpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCl7XG5cblx0LyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqL1xuXHQvKiBBSkFYIFNBVkUgRk9STSAqL1xuXHQvKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiovXG5cdC8qJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG5cdCAgICQoJyNhZG1pbi1zdGFmZi11c2VyLXBvc3QtbGlzdCcpLnN1Ym1pdChmdW5jdGlvbigpIHtcblx0ICAgICAgJCh0aGlzKS5hamF4U3VibWl0KHtcblx0ICAgICAgXHQgb25Mb2FkaW5nOiAkKCcubG9hZGVyJykuc2hvdygpLFxuXHQgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbigpe1xuXHQgICAgICAgICBcdCQoJy5sb2FkZXInKS5oaWRlKCk7XG5cdCAgICAgICAgICAgICQoJyNzYXZlLXJlc3VsdCcpLmZhZGVJbigpO1xuXHQgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuXHRcdFx0XHQgICAgJCgnI3NhdmUtcmVzdWx0JykuZmFkZU91dCgnZmFzdCcpO1xuXHRcdFx0XHR9LCAyMDAwKTtcblx0ICAgICAgICAgfSxcblx0ICAgICAgICAgdGltZW91dDogNTAwMFxuXHQgICAgICB9KTtcblx0ICAgICAgcmV0dXJuIGZhbHNlO1xuXHQgICB9KTtcblx0fSk7Ki9cblxuXHQvKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiovXG5cdC8qIFNPUlRBQkxFIEZJTFRFUiBGSUVMRFMgKi9cblx0LyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqL1xuXHQkKCcuYS1zdGFmZi1tZW1iZXInKS5tb3VzZW92ZXIoZnVuY3Rpb24oKSB7XG5cdFx0JCh0aGlzKS5maW5kKCcuc29ydC1hcnJvd3MnKS5zdG9wKHRydWUsIHRydWUpLnNob3coKTtcblx0fSk7XG5cdCQoJy5hLXN0YWZmLW1lbWJlcicpLm1vdXNlb3V0KGZ1bmN0aW9uKCkge1xuXHRcdCQodGhpcykuZmluZCgnLnNvcnQtYXJyb3dzJykuc3RvcCh0cnVlLCB0cnVlKS5oaWRlKCk7XG5cdH0pO1xuXG5cdCQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcblx0XHQkKCcubS1zdGFmZi1saXN0Jykuc29ydGFibGUoe1xuXHRcdFx0YXhpczogJ3knLFxuXHRcdFx0Y3Vyb3NyOiAnbW92ZSdcblx0XHR9KTtcblx0fSk7XG5cblx0JChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuXHRcdCQoJy5wcm9wZXJ0eS1kZXRhaWwtaXRlbXMtbGlzdCcpLnNvcnRhYmxlKHtcblx0XHRcdGF4aXM6ICd5Jyxcblx0XHRcdGN1cm9zcjogJ21vdmUnXG5cdFx0fSk7XG5cdH0pO1xuXG5cdCQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcblx0XHQkKCcuYWdlbnQtZGV0YWlsLWl0ZW1zLWxpc3QnKS5zb3J0YWJsZSh7XG5cdFx0XHRheGlzOiAneScsXG5cdFx0XHRjdXJvc3I6ICdtb3ZlJ1xuXHRcdH0pO1xuXHR9KTtcblxufSk7XG4iXX0=
