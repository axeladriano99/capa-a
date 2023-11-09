$(document).ready(function() {
    $('#li-parameters').addClass('active pcoded-trigger');
    $('#li-security').addClass('pcoded-trigger');
    $('#li-users').addClass('active');

    $('#password').keyup(function(e) {
        
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{6,}).*", "g");
        if (false == enoughRegex.test($(this).val())) {
            classPass('has-danger', 'form-control-danger');
            $('#passstrength').html('Más caracteres.');
        } else if (strongRegex.test($(this).val())) {
            $('#passstrength').className = 'ok';
            $('#passstrength').html('Fuerte!');
            classPass('has-success', 'form-control-success')
        } else if (mediumRegex.test($(this).val())) {
            $('#passstrength').className = 'alert';
            $('#passstrength').html('Media!');
            classPass('has-warning', 'form-control-warning')
        } else {
            $('#passstrength').className = 'error';
            $('#passstrength').html('Débil!');
            classPass('has-danger', 'form-control-danger')
        }
        return true;
    });

    $('#password_confirmation').keyup(function(e) {
        if ($(this).val() == $('#password').val()) {
            classPassCon('has-success', 'form-control-success');
        }else{
            classPassCon('has-danger', 'form-control-danger')
        }
        return true;
    });




    function classPass(clase1, clase2){
        $('#div-pass').removeClass('has-danger');
        $('#div-pass').removeClass('has-warning');
        $('#div-pass').removeClass('has-success');

        $('#password').removeClass('form-control-danger');
        $('#password').removeClass('form-control-warning');
        $('#password').removeClass('form-control-success');
        

        $('#div-pass').addClass(clase1);
        $('#password').addClass(clase2);

    }

    function classPassCon(clase1, clase2){
        $('#div-pass-con').removeClass('has-danger');
        $('#div-pass-con').removeClass('has-success');

        $('#password_confirmation').removeClass('form-control-danger');
        $('#password_confirmation').removeClass('form-control-success');
        

        $('#div-pass-con').addClass(clase1);
        $('#password_confirmation').addClass(clase2);

    }
});