$(document).ready(function() {

	const formato = (number) => {
		const exp = /(\d)(?=(\d{3})+(?!\d))/g;
		const rep = '$1,';
		let arr = number.toString().split('.');
		arr[0] = arr[0].replace(exp,rep);
		return arr[1] ? arr.join('.'): arr[0];
	}
	$('#ex7').change(function(event) {
		calculator();
	});

	$('#ex21').change(function(event) {
		calculator();
	});


	function calculator() {
		var amount = parseInt($('#ex7').val());
		console.log("amount", amount);

		var days = parseInt($('#ex21').val());
		if (days == 1) {
			days = 15;
		}else{
			days = 30;
		}
		console.log("days", days);

		$('#amount-request').text(formato(amount));


		console.log("creditDef.interest_rate", creditDef.interest_rate);
		var interest = (((amount * creditDef.interest_rate) / 100)/360) * days;
		$('#interest').text(formato(interest.toFixed(2)));
		console.log("interest", interest);

		$('#c-endorsement').text(formato(creditDef.endorsement));
		console.log("creditDef.endorsement", creditDef.endorsement);


		var technological_contribution = (amount * creditDef.technological_contribution) / 100;
		$('#c-technological-contribution').text(formato(technological_contribution.toFixed(2)));

		var discount = (amount * 4) / 100;
		$('#c-discount').text(formato(discount.toFixed(2)));

		var total_technological_contribution = technological_contribution - discount;
		$('#c-total-technological-contribution').text(formato(total_technological_contribution.toFixed(2)));

		console.log("creditDef.sure", creditDef.sure);
		$('#c-sure').text(formato(creditDef.sure));

		var vat = 0;
		if(creditDef.vat > 0){
			vat = (amount * creditDef.vat) / 100;
		}

		$('#c-vat').text(formato(vat.toFixed(2)));

		var ttl = amount + interest + parseFloat(creditDef.endorsement) + total_technological_contribution + parseFloat(creditDef.sure) + vat;
		console.log("ttl", ttl);
		$('#c-ttl').text(formato(ttl.toFixed(2)));
	}
});