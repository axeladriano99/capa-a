$(document).ready(function() {
	var urlTable = $('#table-reports-index').attr('url');
	var dateRange = $('#datefilter').val().replaceAll(' ', '');
	var tableReports;

	function addTable() {
		tableReports = $('#table-reports-index').DataTable({
			"serverSide": true,
			"processing": true,
			"ajax": `${urlTable}?datef=${dateRange}`,
			"columns": [
				{ "data": "code" },
				{ "data": "name" },
				//{ "data": "amount" },
				//{ "data": "city" },
				//{ "data": "request_at" },
				//{ "data": "consigned_at" },
				//{ "data": "status" },
				//{ "data": "actions", "type": "html" },
			],
			language: {
				url: `${url_base}/assets/jsons/dt-${lang}.json`
			}
		});
	}

	function destroyTable() {
		tableReports.destroy();
	}

	$('#datefilter').daterangepicker({
		autoUpdateInput: false,
		locale: {
			cancelLabel: 'Clear'
		}
	});

	$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
		dateRange = $('input[name="datefilter"]').val().replaceAll(' ', '');
		//console.log("dateRange", dateRange);
		destroyTable();
		addTable();
	});

	addTable();
});