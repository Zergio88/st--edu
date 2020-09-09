<?php

session_start();
/* Parecido a Include pero es mas critico, si algo falla no sigue sino que tira fatal error */
//$conexion=require_once('../LOGGIN/connection.php');
$conexion=mysqli_connect('localhost','root','','edustdb') or die("problemas con la conexion");

$serie=$_REQUEST['nro_serie'];
/* query para ingreso */
$query="select * from ingresos where nro_serie = $serie";

$resultado=mysqli_query($conexion, $query) or die("Problemas en el select de ingresos ".mysqli_error($conexion));

// creamos una variable que sera la salida 
$salida = "";

	// si el resultado es mayor a 0, quiere decir que encontramos filas
	if(mysqli_num_rows($resultado) > 0){

		$getResultado=mysqli_fetch_array($resultado);

		if($getResultado['id_bien']==1){

			/* joineo tabla ingresos, netbooks, incidencias, tipo bienes */
			$q_consultarTablas="SELECT c.id_incidencia, n.nro_serie, t.nombre_bien, c.observaciones, c.area, c.fecha_inc FROM ingresos i join netbooks n on i.nro_serie = n.nro_serie JOIN incidencias c on c.id_incidencia = n.id_incidencia JOIN tipo_bienes t on i.id_bien = t.id_bien WHERE n.nro_serie = $serie";
		
			$salida.="<table border=\"1\">
						<thead>
							<tr>
								<td> id incidencia </td>
								<td> serie </td>
								<td> bien </td>
								<td> observaciones </td>
								<td> area </td>
								<td> fecha </td>
							</tr>
						</thead>
						";
			// generamos las filas, concatenamos con los datos
			$resultadoJoin=mysqli_query($conexion, $q_consultarTablas) or die("Problemas en el select de tablas varias ".mysqli_error($conexion));
			//$fila = mysqli_fetch_array($resultadoJoin)
			while($fila = mysqli_fetch_assoc($resultadoJoin)){
				$salida.="<tr>
						<td> ".$fila['id_incidencia']." </td>
						<td> ".$fila['nro_serie']." </td>
						<td> ".$fila['nombre_bien']." </td>
						<td> ".$fila['observaciones']." </td>
						<td> ".$fila['area']." </td>
						<td> ".$fila['fecha_inc']." </td>
						</tr>";
			}

			$salida.="</tbody></table>";
		}

	} else {

		$salida.="Serie no encontrado";

	}

	echo $salida;

mysqli_close($conexion);

?>
