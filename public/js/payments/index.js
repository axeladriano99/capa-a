$(document).ready(function() {
	
	var lang = $('html').attr('lang');
	var urlTable = $('#users-table').attr('url');
	
	
	$('#payments-received-table').DataTable({
		"processing": true,
		"ordering": false,
		language: {
			url: `${url_base}/assets/jsons/dt-${lang}.json`
		}
	});
});