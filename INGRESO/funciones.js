addEventListener('load',inicializarEventos,false);

function inicializarEventos()
{
	// capturo la referencia al formulario
	var ref=document.getElementById('formulario');
	// inicializo el evento submit, la funcion enviarDatos se ejecutara cuando lo presione
	// tener en cuenta q tengo 2 submit
	ref.addEventListener('submit',enviarDatos,false);

}

function enviarDatos(e)
{	
	// evita el evento por defecto del hipervinculo
	e.preventDefault();

	var datosValidos=validarDatos();
	
	if(datosValidos){
		enviarFormulario();	
	}
	
}

function retornarDatos()
{
	var cad='';
	// armo el string con los datos
	var serie=document.getElementById('nro_serie').value;
	var tipoBien=document.getElementById('tipoBien').value;
	var estadoRep=document.getElementById('estadoRep').value;
	var estadoBien=document.getElementById('estadoBien').value;
	var bateria=document.getElementById('bateria').value;
	var Remitente=document.getElementById('Remitente').value;
	var comentarios=document.getElementById('comentarios').value;
	var otroRemitente=document.getElementById('oremitente').value;

	cad='&nro_serie='+encodeURIComponent(serie)+'&tipoBien='+encodeURIComponent(tipoBien)+'&estadoRep='+encodeURIComponent(estadoRep)
	+'&estadoBien='+encodeURIComponent(estadoBien)+'&bateria='+encodeURIComponent(bateria)+'&Remitente='+encodeURIComponent(Remitente)
	+'&comentarios='+encodeURIComponent(comentarios)+'&oremitente='+encodeURIComponent(otroRemitente);

	return cad;
}

var conexion1;
function enviarFormulario()
{	// este objeto nos permite comunicarnos con el servidor de forma asincrónica
	conexion1=new XMLHttpRequest();

	// La propiedad onreadystatechange se inicializa con la referencia de una función que será la encargada de procesar los datos enviados por el servidor
	conexion1.onreadystatechange = procesarEventos;

	// método de envío de datos (GET o POST), pagina que procesara los datos, se procesarán los datos de forma asíncrona (true) o síncrona (false)
	conexion1.open('POST','ingresarBienes.php',true);

	conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

	conexion1.send(retornarDatos());
}

function procesarEventos()
{
	var resultados = document.getElementById("resultados");

	/* valores de conexion1:0 No inicializado, 1 Cargando, 2 Cargado, 3 Interactivo, 4 Completado */
	if(conexion1.readyState == 4)
	{	//con responseText recuperamos la información enviada por el servidor
		if(conexion1.status==200)
			resultados.innerHTML = conexion1.responseText;
		else
			alert(conexion1.statusText);
	}
	else // si tiene otro valor mostramos dentro del div el mensaje 'cargando...'.
	{
		resultados.innerHTML= '<img src="cargando.gif">';
	}
}

function validarDatos()
{
	// armo el string con los datos
	var serie=document.getElementById('nro_serie').value;
	var tipoBien=document.getElementById('tipoBien').value;
	var estadoRep=document.getElementById('estadoRep').value;
	var estadoBien=document.getElementById('estadoBien').value;
	var bateria=document.getElementById('bateria').value;
	var Remitente=document.getElementById('Remitente').value;
	var comentarios=document.getElementById('comentarios').value;
	var otroRemitente=document.getElementById('oremitente').value;

	/* validacion netbook-ups-caps-servidor */
	if(tipoBien !=''){
		if(tipoBien=='1' || tipoBien=='2' || tipoBien=='3' || tipoBien=='4'){
			/* valida espacios */
			var noValido = /\s/;
			if(noValido.test(serie)){ // chequea que el string no tenga espacio
     			alert ("El serie no puede contener espacios en blanco"); 
    			return false;
			} else if (serie=='' || estadoBien=='' || Remitente=='' || (Remitente=='Otro' && otroRemitente=='')) {
			/* valida campos estado del bien, remitente, otro remitente*/
     		 	alert("verifique campos necesarios vacios");
     		 	return false;
			}
		} else {
			/* repuestos */
		}	
	} else {

		alert("Debe seleccionar un tipo de bien");
		return false;
	}

	/* 	
	si tipo es repuesto
		estadorep --> no seleccione
		cantidad --> no vacio
		estadobien --> no seleccione
		remitente --> no seleccione
			if otro
				oremitente no vacio

	serie --> puede
	estadorep --> puede
	bateria --> puede
	remitente --> puede
	comentarios --> puede
	otroremitente --> puede	
	*/
	return true;
}