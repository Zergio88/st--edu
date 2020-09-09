<?php 

session_start();

$usuario=$_SESSION['id_Usuario'];
$area="diagnostico";
/* en reparacion */
$id_tipo=2;

/* obtener este valor mediante query */
$bata="S";

/* recibe igual este valor de otro form */
$nroSerie=$_REQUEST['nro_serie'];



$conexion=mysqli_connect('localhost','root','','edustdb') or die ("problemas con la conexion ");

	$query2="insert into incidencias (id_tipo,id_usuario,observaciones,area) values ($id_tipo,$usuario,'$_REQUEST[observaciones]','$area')";

	/* luego se da de alta una incidencia con ese serie */
	mysqli_query($conexion, $query2) or die (" problemas en el insert de nueva incidencia ".mysqli_error($conexion));

	// obtengo el ultimo id de incidencia para asociarlo en otro registro en tabla del bien en si
	$id_incidencia=(int) mysqli_insert_id($conexion);

	$query3="insert into netbooks (nro_serie, bateria, id_incidencia) values ('$nroSerie','$bata',$id_incidencia)";
		mysqli_query($conexion,$query3) or die ("Problemas en el insert de netbooks ".mysqli_error($conexion));

	echo "registro ingresado en Netbooks e incidencias";

mysqli_close($conexion);

?>