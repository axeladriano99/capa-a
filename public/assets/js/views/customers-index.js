$(document).ready(function() {
	$('#table-customers').DataTable({
		language: {
			url: `${url_base}/assets/jsons/dt-${lang}.json`
		}
	});
});