$(document).ready(function() {
	var urlGetCities = $('#dp_id').attr('url-get-cities');

	//Llenar datos departamento y ciudad de expedicion
	var dpExpID = $('#dp_id').val();
	var cityExpId = $('#city_expedition_document_id').attr('sele');
	if(dpExpID != ''){
		getCitiesByStateId(dpExpID, '#city_expedition_document_id', cityExpId);
	}
	$('#dp_id').change(function(event) {
		var dpID = $(this).val();
		if(dpID != ''){
			getCitiesByStateId(dpID, '#city_expedition_document_id', cityExpId);
		}
	});
	// FIN Llenar datos departamento y ciudad de expedicion


	//Llenar datos departamento y ciudad de nacimiento
	var dpNacID = $('#dpn_id').val();
	var cityNacID = $('#city_birthplace_id').attr('sele');
	if(dpNacID != ''){
		getCitiesByStateId(dpNacID, '#city_birthplace_id', cityNacID);
	}


	$('#dpn_id').change(function(event) {
		var dpID = $(this).val();
		if(dpID != ''){
			getCitiesByStateId(dpID, '#city_birthplace_id', cityNacID);
		}
	});
	//FIN Llenar datos departamento y ciudad de nacimiento


	//Llenar datos departamento y ciudad de residencia
	var dpRecID = $('#state_residence_id').val();
	var cityRecID = $('#city_residence_id').attr('sele');
	if(dpRecID != ''){
		getCitiesByStateId(dpRecID, '#city_residence_id', cityRecID);
	}


	$('#state_residence_id').change(function(event) {
		var dpID = $(this).val();
		if(dpID != ''){
			getCitiesByStateId(dpID, '#city_residence_id', cityRecID);
		}
	});
	//FIN Llenar datos departamento y ciudad de nacimiento




	





	function getCitiesByStateId(dpID, selectCityID, selected) {
		$(selectCityID).html('<option value="">---- Ciudad ----</option>');
		$.ajax({
			url: `${urlGetCities}/${dpID}`,
			dataType: 'json',
		})
		.done(function(resp) {
			$.each(resp, function(index, val) {
				if(val.id == selected){
					$(selectCityID).append(`<option value="${val.id}" selected>${val.name}</option>`);
				}else{
					$(selectCityID).append(`<option value="${val.id}">${val.name}</option>`);
				}
			});
		});
	}
});