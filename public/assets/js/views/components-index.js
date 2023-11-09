$(document).ready(function() {
	$('#li-parameters').addClass('active');
	$('#li-parameters').addClass('pcoded-trigger');
	$('#li-security').addClass('pcoded-trigger');
	$('#li-components').addClass('active');

	var lang = $('html').attr('lang');
	$('#components-table').DataTable({
		ordering: false,
		language: {
            url: `${url_base}/assets/jsons/dt-${lang}.json`
            
        }
	});
});