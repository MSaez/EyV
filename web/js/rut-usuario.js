function verifica_rut(){
    var rut = $('#usuario-us_rut').val();
    if($.validateRut(rut) && rut.length >=9) {
        $('#usuario-us_username').prop('disabled', false);
        $('#usuario-us_nombres').prop('disabled', false);
        $('#usuario-us_paterno').prop('disabled', false);
        $('#usuario-us_materno').prop('disabled', false);
        $('#usuario-us_email').prop('disabled', false);
        }
    else{
        $('#usuario-us_username').prop('disabled', true);
        $('#usuario-us_nombres').prop('disabled', true);
        $('#usuario-us_paterno').prop('disabled', true);
        $('#usuario-us_materno').prop('disabled', true);
        $('#usuario-us_email').prop('disabled', true);
    }
}

