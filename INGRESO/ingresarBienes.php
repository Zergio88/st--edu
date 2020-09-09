<?php

session_start();
/* Parecido a Include pero es mas critico, si algo falla no sigue sino que tira fatal error */
//$conexion=require_once('../LOGGIN/connection.php');
$conexion=mysqli_connect('localhost','root','','edustdb') or die("problemas con la conexion");

/* seteo de variables */
$usuario=$_SESSION['id_Usuario'];
$area="ingreso";
($_REQUEST['Remitente'] == "Otro") ? $remi=$_REQUEST['oremitente'] : $remi=$_REQUEST['Remitente'];

/* query para ingreso */
$query="insert into ingresos (nro_serie,id_bien,estado_del_bien,id_usuario,remitente) values ('$_REQUEST[nro_serie]','$_REQUEST[tipoBien]','$_REQUEST[estadoBien]',$usuario,'$remi')";

/* query para incidencias */
$query2="insert into incidencias (id_tipo,id_usuario,observaciones,area) values (1,$usuario,'$_REQUEST[comentarios]','$area')";

$result=mysqli_query($conexion, $query) or die("Problemas en el insert de ingresos ".mysqli_error($conexion));

if($result){
	/* luego se da de alta una incidencia con ese serie */
	mysqli_query($conexion, $query2);

	// obtengo el ultimo id de incidencia para asociarlo en otro registro en tabla del bien en si
	$id_incidencia=(int) mysqli_insert_id($conexion);

	if($_REQUEST['tipoBien']==1){
		// inserto en tabla de netbooks
		$query3="insert into netbooks (nro_serie, bateria, id_incidencia) values ('$_REQUEST[nro_serie]','$_REQUEST[bateria]',$id_incidencia)";
		mysqli_query($conexion,$query3) or die ("Problemas en el insert de netbooks ".mysqli_error($conexion));
		echo "registro ingresado en Netbooks";

	} elseif ($_REQUEST['tipoBien']==2) {
		/* inserto en tabla de servidores */
		$query4="insert into servidores (nro_serie, id_incidencia) values ('$_REQUEST[nro_serie]',$id_incidencia)";
		mysqli_query($conexion,$query4) or die ("Problemas en el insert de servidores ".mysqli_error($conexion));
		echo "registro ingresado en Servidores";
	}
}
mysqli_close($conexion);


?>
