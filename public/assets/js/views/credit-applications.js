$(document).ready(function() {
	var status = $('#status-act').attr('status-act');
	var dateRange = $('input[name="datefilter"]').val().replaceAll(' ', '');
	$('#li-credit-applications').addClass('active pcoded-trigger');
	$('#li-credit-applications-in-force').addClass('active');

	$('input[name="datefilter"]').daterangepicker({
		autoUpdateInput: false,
		locale: {
			cancelLabel: 'Clear'
		}
	});

	$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
		dateRange = $('input[name="datefilter"]').val().replaceAll(' ', '');
		urlFilter();
	});

	$('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});

	$('.filter-status').click(function(event) {
		event.preventDefault();
		status = $(this).attr('status');
		urlFilter();
	});

	$('.filter-date').click(function(event) {
		event.preventDefault();
		dateRange = $(this).attr('date');
		if(dateRange == ""){
			dateRange = $('input[name="datefilter"]').val().replaceAll(' ', '');
		}
		urlFilter();
	});

	function urlFilter() {
		var r = url_base+"/credit-applications?"
		


		r += "datefilter=" + dateRange;
		if(status != ""){
			r += "&status=" + status;
		}
		//console.log("r", r);
		window.location.href = r;
	}

	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	$('.c-state').click(function(event) {
		/* Act on the event */
		var sId = $(this).attr('s-id');
		$('#modal-change-status').modal('show');
		$('#ca_id').val(sId)
		console.log("sId", sId);
	});
});