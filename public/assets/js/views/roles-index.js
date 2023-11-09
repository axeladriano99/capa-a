$(document).ready(function() {
	$('#li-parameters').addClass('active');
	$('#li-parameters').addClass('pcoded-trigger');
	$('#li-security').addClass('pcoded-trigger');
	$('#li-roles').addClass('active');
	console.log('roles-table');


	var lang = $('html').attr('lang');
	console.log(lang);
	$('#roles-table').DataTable({
		language: {
            url: `${url_base}/assets/jsons/dt-${lang}.json`
        }
	});
});