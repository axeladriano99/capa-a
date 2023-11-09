$(document).ready(function() {
	//$('#li-parameters').addClass('active pcoded-trigger');
	//$('#li-security').addClass('pcoded-trigger');
	//$('#li-users').addClass('active');


	var lang = $('html').attr('lang');
	var urlTable = $('#users-table').attr('url');
	
	
	$('#users-table').DataTable({
		
		"serverSide": true,
		"ajax": urlTable,
		"processing": true,
		"columns": [
			{ "data": "id" },
			{ "data": "name" },
			{ "data": "email" },
			{ "data": "phone" },
			{ "data": "role", "orderable": false },
			{ "data": "actions", "type": "html", "orderable": false },
		],
		language: {
			url: `${url_base}/assets/jsons/dt-${lang}.json`
		}
	});
});