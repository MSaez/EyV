function verifica_rut(){
    var rut = $('#empleado-emp_rut').val();
    if($.validateRut(rut) && rut.length >=9) {
        $('#empleado-emp_nombres').prop('disabled', false);
        $('#empleado-emp_paterno').prop('disabled', false);
        $('#empleado-emp_materno').prop('disabled', false);
        }
    else{
        $('#empleado-emp_nombres').prop('disabled', true);
        $('#empleado-emp_paterno').prop('disabled', true);
        $('#empleado-emp_materno').prop('disabled', true);
    }
}


