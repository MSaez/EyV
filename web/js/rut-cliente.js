function verifica_rut(){
    var rut = $('#cliente-cli_rut').val();
    if($.validateRut(rut) && rut.length >=9) {
        $('#cliente-cli_nombres').prop('disabled', false);
        $('#cliente-cli_paterno').prop('disabled', false);
        $('#cliente-cli_materno').prop('disabled', false);
        $('#cliente-cli_telefono').prop('disabled', false);
        $('#cliente-cli_direccion').prop('disabled', false);
        }
        else{
            $('#cliente-cli_nombres').prop('disabled', true);
            $('#cliente-cli_paterno').prop('disabled', true);
            $('#cliente-cli_materno').prop('disabled', true);
            $('#cliente-cli_telefono').prop('disabled', true);
            $('#cliente-cli_direccion').prop('disabled', true);
        }
}


