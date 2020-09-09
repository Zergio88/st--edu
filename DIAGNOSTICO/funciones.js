addEventListener('load',inicializarEventos,false);

function inicializarEventos()
{
	// Asigna referencia a los botones
	var btnConsultar=document.getElementById('btn_consultar');
	var btnIngresar=document.getElementById('btn_ingresar');

	// asigna funciones a evento
	btnConsultar.addEventListener('click',enviarDatos,false);
	btnIngresar.addEventListener('click',agregarIncidencia,false);

}

function enviarDatos(e)
{	
	// evita el evento por defecto del hipervinculo
	e.preventDefault();

	enviarFormulario();	
	
}

function retornarDatos()
{
	var cad='';
	// armo el string con los datos
	var serie=document.getElementById('nro_serie').value;
	var observaciones=document.getElementById('observaciones').value;
	
	cad='&nro_serie='+encodeURIComponent(serie)+'&observaciones='+encodeURIComponent(observaciones);

	return cad;
}

var conexion1;
var tipo='';
function enviarFormulario()
{	// este objeto nos permite comunicarnos con el servidor de forma asincrónica
	tipo='consulta';
	conexion1=new XMLHttpRequest();

	// La propiedad onreadystatechange se inicializa con la referencia de una función que será la encargada de procesar los datos enviados por el servidor
	conexion1.onreadystatechange = procesarEventos;

	// método de envío de datos (GET o POST), pagina que procesara los datos, se procesarán los datos de forma asíncrona (true) o síncrona (false)
	conexion1.open('POST','consultaIncidencia.php',true);

	conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

	conexion1.send(retornarDatos());
}

function procesarEventos()
{
	var resultados;

	if(tipo=='consulta'){
		resultados = document.getElementById("resultados");
	} else {
		resultados = document.getElementById("resulta");
	}

	/* valores de conexion1:0 No inicializado, 1 Cargando, 2 Cargado, 3 Interactivo, 4 Completado */
	if(conexion1.readyState == 4)
	{	//con responseText recuperamos la información enviada por el servidor
		if(conexion1.status==200){
			resultados.innerHTML = conexion1.responseText;
		} else {
			alert(conexion1.statusText);
		}
	}
	else // si tiene otro valor mostramos dentro del div el mensaje 'cargando...'.
	{
		resultados.innerHTML= '<img src="cargando.gif">';
	}
}

function agregarIncidencia(e)
{
	// evita el evento por defecto del hipervinculo
	e.preventDefault();
	
	tipo='ingreso';
	conexion1=new XMLHttpRequest();

	// La propiedad onreadystatechange se inicializa con la referencia de una función que será la encargada de procesar los datos enviados por el servidor
	conexion1.onreadystatechange = procesarEventos;

	// método de envío de datos (GET o POST), pagina que procesara los datos, se procesarán los datos de forma asíncrona (true) o síncrona (false)
	conexion1.open('POST','nuevaIncidencia.php',true);

	conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");

	conexion1.send(retornarDatos());
	/* obtener nuevos datos, enviarlos, recibir, proyectar */
}