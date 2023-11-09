$(document).ready(function() {
	//$('#li-parameters').addClass('active pcoded-trigger');
	//$('#li-security').addClass('pcoded-trigger');
	//$('#li-users').addClass('active');


	var lang = $('html').attr('lang');
	
	
	
	$('#inv-table').DataTable({
		"processing": true,
		language: {
			url: `${url_base}/assets/jsons/dt-${lang}.json`
		}
	});

	$('.del-inv').click(function(event) {
		event.preventDefault();
		var urlDel = $(this).attr('href');
		if(confirm('¿Seguro quiere eliminar esta invitación?')){
			$('#form-del-inv').attr('action', urlDel);
			$('#form-del-inv').submit();
		}
	});

	$('#form-campaing-ref').submit(function(event) {
		//event.preventDefault();
		$('#btn-send').attr('disabled', true);
		$('#btn-text').addClass('d-none');
		$('.preloader3').removeClass('d-none');
	});
});