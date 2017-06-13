function sumar_total_desabolladura(){
	id = 0;
	suma = 0;
	existe = true;
	while(existe){
		var idFull = "actividaddesabolladura-"+id+"-des_precio";
                var estadoFull = "actividaddesabolladura-"+id+"-des_estado";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!="" && document.getElementById(estadoFull).value!= "Cancelado"){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_tdesabolladura").value=suma;
}
function sumar_total_pintura(){
	id = 0;
	suma = 0;
	existe = true;
	while(existe){
		var idFull = "actividadpintura-"+id+"-pin_precio";
                var estadoFull = "actividadpintura-"+id+"-pin_estado";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!="" && document.getElementById(estadoFull).value!= "Cancelado"){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_tpintura").value=suma;
}
function sumar_total_insumos(){
	id = 0;
	suma = 0;
	suma_r = 0;
	ptotal = 0;
	rtotal = 0;
	existe = true;
	while(existe){
		var idPrecio = "insumo-"+id+"-ins_precio_unitario";
		var idCantidad = "insumo-"+id+"-ins_cantidad";
		var idTotal = "insumo-"+id+"-ins_total";
		var idReutilizado = "insumo-"+id+"-ins_reutilizado";
		try{campo = document.getElementById(idPrecio);
			if(document.getElementById(idPrecio).value!="" && document.getElementById(idCantidad).value!="" && document.getElementById(idReutilizado).value!="1"){
				ptotal = parseInt(document.getElementById(idPrecio).value) * parseInt(document.getElementById(idCantidad).value)
				document.getElementById(idTotal).value=ptotal;
				suma = suma + ptotal;
			}
			else if (document.getElementById(idPrecio).value!="" && document.getElementById(idCantidad).value!="" && document.getElementById(idReutilizado).value=="1"){
				rtotal = parseInt(document.getElementById(idPrecio).value) * parseInt(document.getElementById(idCantidad).value)
				document.getElementById(idTotal).value=rtotal;
				suma_r = suma_r + rtotal;	
			}
		id = id+1;
    	
                }catch(e){
                    existe = false;
                }  
	
	}
    
        console.log(rtotal);
	document.getElementById("ot-ot_tinsumo").value=suma;
        document.getElementById("ot-ot_treutilizado").value=suma_r;
}
function sumar_total_servicio(){
	id = 0;
	suma = 0;
	existe = true;
	while(existe){
		var idFull = "otrosservicios-"+id+"-os_precio";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!=""){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	document.getElementById("ot-ot_texterno").value=suma;
}
function sumar_total_horas_desabolladura(){
	id = 0;
	suma = 0;
	existe = true;
	while(existe){
		var idFull = "actividaddesabolladura-"+id+"-des_horas";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!=""){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	return suma;
}
function sumar_total_horas_pintura(){
	id = 0;
	suma = 0;
	existe = true;
	while(existe){
		var idFull = "actividadpintura-"+id+"-pin_horas";
		try{campo = document.getElementById(idFull);
			if(document.getElementById(idFull).value!=""){
				suma = suma + parseInt(document.getElementById(idFull).value);
			}
		id = id+1;
    	}catch(e){
       		existe = false;
    	}  
	}
        console.log(suma);
	return suma;
}
function total_horas(){
                    total = 0;
                    total = sumar_total_horas_desabolladura() + sumar_total_horas_pintura();
                    document.getElementById("ot-ot_total_horas").value=total;
}
function calcular_subtotal(){
                    subtotal = 0;
                    subtotal = parseInt(document.getElementById("ot-ot_tdesabolladura").value) + parseInt(document.getElementById("ot-ot_tpintura").value) + parseInt(document.getElementById("ot-ot_tinsumo").value) + parseInt(document.getElementById("ot-ot_texterno").value) + parseInt(document.getElementById("ot-ot_treutilizado").value);
                    document.getElementById("ot-ot_subtotal").value=subtotal;
}
    
        
        
       
function calcular_iva(){
                iva = 0;
                iva = Math.round(parseInt(document.getElementById("ot-ot_subtotal").value) * 0.19);
                document.getElementById("ot-ot_iva").value=iva;
}
function calcular_total(){
                total = 0;
                total = parseInt(document.getElementById("ot-ot_subtotal").value) + parseInt(document.getElementById("ot-ot_iva").value=iva);
                console.log(total);
                document.getElementById("ot-ot_total").value=total;
}