addEventListener('load',inicializarEventos,false);

function inicializarEventos()
{	
	// Asigna referencia a los botones
	var btnIngresar=document.getElementById('btn_ingresar');
	var btnTerminar=document.getElementById('btn_terminar');

	// asigna funciones a evento
	btnIngresar.addEventListener('click',enviarDatos,false);
	btnTerminar.addEventListener('click',cerrarPallet,false);

}

function cerrarPallet(e){

	e.preventDefault();
	
	var pallet=document.getElementById('pallet').value;
	var noValido = /\s/;

	/* validacion campos vacios */
	if(pallet=='' || noValido.test(pallet)){
		/* valida espacios */
     	alert ("campo Pallet vacio o con espacios"); 
    	return false;	
	} else {
		// este objeto nos permite comunicarnos con el servidor de forma asincrónica
		conexion1=new XMLHttpRequest();

		// La propiedad onreadystatechange se inicializa con la referencia de una función que será la encargada de procesar los datos enviados por el servidor
		// (cuando el servidor proceso la peticion)
		conexion1.onreadystatechange = procesarEventos;

		// método de envío de datos (GET o POST), pagina que procesara los datos, se procesarán los datos de forma asíncrona (true) o síncrona (false)
		conexion1.open('POST','cerrarPallet.php',true);

		conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

		conexion1.send(retornarDatos());
	}
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
	// captura valores de los inputs
	var serie=document.getElementById('nro_serie').value;
	var pallet=document.getElementById('pallet').value;
	var bateria=document.getElementById('bateria').value;

	// retorna string concatenado
	cad='&nro_serie='+encodeURIComponent(serie)+'&pallet='+encodeURIComponent(pallet)+'&bateria='+encodeURIComponent(bateria);

	return cad;
}

var conexion1;
function enviarFormulario()
{	// este objeto nos permite comunicarnos con el servidor de forma asincrónica
	conexion1=new XMLHttpRequest();

	// La propiedad onreadystatechange se inicializa con la referencia de una función que será la encargada de procesar los datos enviados por el servidor
	// (cuando el servidor proceso la peticion)
	conexion1.onreadystatechange = procesarEventos;

	// método de envío de datos (GET o POST), pagina que procesara los datos, se procesarán los datos de forma asíncrona (true) o síncrona (false)
	conexion1.open('POST','ingresarBienesInv2019.php',true);

	conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

	conexion1.send(retornarDatos());
}

/* funcion de prueba */
function ingresarNoEncontrado()
{	// este objeto nos permite comunicarnos con el servidor de forma asincrónica
	conexion1=new XMLHttpRequest();

	// La propiedad onreadystatechange se inicializa con la referencia de una función que será la encargada de procesar los datos enviados por el servidor
	// (cuando el servidor proceso la peticion)
	conexion1.onreadystatechange = procesarEventos;

	// método de envío de datos (GET o POST), pagina que procesara los datos, se procesarán los datos de forma asíncrona (true) o síncrona (false)
	conexion1.open('POST','ingresarNoEncontrado.php',true);

	conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

	conexion1.send(retornarDatos());
}

function procesarEventos()
{
	var resultados = document.getElementById("resultados");
	var contador = document.getElementById("Cantidad");

	var contenidosrv = '';
	/* valores de conexion1:0 No inicializado, 1 Cargando, 2 Cargado, 3 Interactivo, 4 Completado */
	if(conexion1.readyState == 4)
	{	//con responseText recuperamos la información enviada por el servidor
		if(conexion1.status==200){
			contenidosrv = conexion1.responseText.split(",");
			
			if (contenidosrv[0]=="No se encuentra el registro" || contenidosrv[0]=="nuevo pallet dado de alta. No se encuentra el registro") {
				if(confirm("SERIE NO ENCONTRADO! Desea agregarlo?")){
					ingresarNoEncontrado();
				} else {
					resultados.innerHTML='';
				}

			} else {
				resultados.innerHTML=contenidosrv[0];
				contador.innerHTML=contenidosrv[1];
			}
			
			document.getElementById('nro_serie').value='';
			document.getElementById('nro_serie').focus();			
		}
		else
		{
			alert(conexion1.statusText);
		}
	}
	else // si tiene otro valor mostramos dentro del div el mensaje 'cargando...'.
	{
		resultados.innerHTML= '<img src="cargando.gif">';
	}
}

/* agregar validacion, de pallet y serie con espacios */
function validarDatos()
{
	// obtengo valores de los inputs
	var serie=document.getElementById('nro_serie').value;
	var pallet=document.getElementById('pallet').value;
	var bateria=document.getElementById('bateria').value;

	/* validacion campos vacios */
	if(serie != '' && pallet != ''){
		/* valida espacios */
		var noValido = /\s/;
		if(noValido.test(serie) || noValido.test(pallet)){ // chequea que el string no tenga espacio
     		alert ("Los campos no pueden contener espacios"); 
    		return false;	
		}
	} else {
		alert("verifique campos vacios");
		return false;
	}

	return true;
}