$(document).ready(function() {
	var botonClick;
	function validatef(data) {
		$('#alert-errors').addClass('d-none');
		$('#ul-errors').html('');

		$.ajax({
			url: url_base+'/register/validate',
			type: 'POST',
			dataType: 'json',
			data: data,
		}).done(function(resp) {
			console.log("success", resp);
			if(resp.status == 'ok'){
				current_step = $(data.fs_id);
				next_step = current_step.next();
				next_step.show();
				current_step.hide('400');
			}

			if(resp.status == 'valid'){
				console.log("Enviar");
				$('#register_form').submit();
			}
			
		}).fail(function(e) {
			//console.log("e.responseJSON", e.responseJSON);
			//console.log("e.responseJSON.errors", e.responseJSON.errors);
			$.each(e.responseJSON.errors, function(index, val) {
				 $('#ul-errors').append(`<li>${val[0]}</li>`);
			});
			
			$('#alert-errors').removeClass('d-none');
		})
		.always(function() {
			console.log("complete");
			botonClick.attr('disabled', false);
		});
		
	}
	let form = $('#register_form');
	let fieldsets = form.find('fieldset');
	for (i = 1; i < fieldsets.length; i++) {
		$(fieldsets[i]).hide();
	}
	$(".next").click(function() {
		botonClick = $(this);
		botonClick.attr('disabled', true);
		var fs_id = $(this).attr('fs-id');
		var canNext = true;


		switch (fs_id) {
			case '#fs-0':
				var email = $('#email').val();
				console.log("email", email);
				var password = $('#password').val();
				validatef({fs_id, email, password, terms: $('#terms').is(':checked')});
			break;
			case '#fs-1':
				validatef({
					fs_id,
					name: $('#name').val(),
					last_name: $('#last_name').val(),
					phone: $('#phone').val(),
					document_type: $('#document_type').val(),
					document_number: $('#document_number').val(),
					document_expedition_date: $('#document_expedition_date').val(),
					city_expedition_document_id: $('#city_expedition_document_id').val(),
					address: $('#address').val(),
					birthdate: $('#birthdate').val(),
					city_birthplace_id: $('#city_birthplace_id').val(),
					occupation: $('#occupation').val(),
					academic_level: $('#academic_level').val(),
					dependents: $('#dependents').val(),
				});
			break;

			case '#fs-2':
				validatef({
					fs_id,
					bank_id: $('#bank_id').val(),
					account_type: $('#account_type').val(),
					account_number: $('#account_number').val(),
					state_residence_id: $('#state_residence_id').val(),
					city_residence_id: $('#city_residence_id').val(),
					residence_address: $('#residence_address').val(),
					monthly_income: $('#monthly_income').val(),
					monthly_expenses: $('#monthly_expenses').val(),
					email: $('#email').val()
				});
			break;


			case '#fs-3':
				var code = $('#n1').val() + $('#n2').val() + $('#n3').val() + $('#n4').val() + $('#n5').val() + $('#n6').val();
				console.log("code", code);
				validatef({
					fs_id,
					code,
					email: $('#email').val()
				});
			break;
			default:
			console.log('Lo lamentamos, por el momento no disponemos de ' + fs_id + '.');
			
		}
	});
	$(".previous").click(function() {
		var fs_id = $(this).attr('fs-id');
		current_step = $(fs_id);
		prev_step = $(this).parent().prev();
		prev_step.show();
		current_step.hide();
	});

	$('#dp_id').change(function(event) {
		var dp_id = $(this).val();
		$('#city_expedition_document_id').html('<option value="">---- Ciudad ----</option>');
		if(dp_id != ''){
			$.ajax({
				url: url_base+'/register/get-cities/'+dp_id,
				dataType: 'json',
			})
			.done(function(resp) {

				$.each(resp, function(index, val) {
					 $('#city_expedition_document_id').append(`<option value="${val.id}">${val.name}</option>`);
				});
			});
			
		}
	});

	$('#dpn_id').change(function(event) {
		var dp_id = $(this).val();
		$('#city_birthplace_id').html('<option value="">---- Ciudad ----</option>');
		if(dp_id != ''){
			$.ajax({
				url: url_base+'/register/get-cities/'+dp_id,
				dataType: 'json',
			})
			.done(function(resp) {
				$.each(resp, function(index, val) {
					 $('#city_birthplace_id').append(`<option value="${val.id}">${val.name}</option>`);
				});
			});
			
		}
	});

	$('#state_residence_id').change(function(event) {
		var dp_id = $(this).val();
		$('#city_residence_id').html('<option value="">---- Ciudad ----</option>');
		if(dp_id != ''){
			$.ajax({
				url: url_base+'/register/get-cities/'+dp_id,
				dataType: 'json',
			})
			.done(function(resp) {
				$.each(resp, function(index, val) {
					 $('#city_residence_id').append(`<option value="${val.id}">${val.name}</option>`);
				});
			});
			
		}
	});

	$('#resend').click(function(event) {
		$(this).addClass('d-none');
		event.preventDefault();
		data = {email:$('#email').val()}
		$.ajax({
			url: url_base+'/resend-code-email',
			type: 'POST',
			dataType: 'json',
			data: data,
		}).done(function(resp) {
			console.log("success", resp);
			if(resp.status == 'ok'){
				alert('Código reenviado');
			}
		}).fail(function(e) {
			console.log("e.responseJSON", e.responseJSON);
			
		})
		.always(function() {
			console.log("complete");
			$('#resend').removeClass('d-none');
		});
	});
});