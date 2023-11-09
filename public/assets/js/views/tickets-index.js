$(document).ready(function() {
	$('#table-tickets').DataTable({
		language: {
			url: `${url_base}/assets/jsons/dt-${lang}.json`
		}
	});
}).on('click', '.change-status', function(event) {
	var id = $(this).attr('tk-id');
	$('#cs-ticket-id').val(id);
	console.log("id", id);
});