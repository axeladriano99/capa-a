$(document).ready(function() {
	console.log('Hola');
	


	var lang = $('html').attr('lang');
	var urlTable = $('#payments-table').attr('url');
	
	
	$('#payments-table').DataTable({
		"ordering": false,
		"serverSide": true,
		"ajax": urlTable,
		"processing": true,
		"columns": [
			{ "data": "id" },
			{ "data": "from" },
			{ "data": "to" },
			{ "data": "campaign" },
			{ "data": "amount" },
			{ "data": "type", "type": "html", "orderable": false },
			{ "data": "status" },
			{ "data": "date" },
		],
		language: {
			url: `${url_base}/assets/jsons/dt-${lang}.json`
		}
	});
});