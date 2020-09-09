<?php

session_start();
/* Parecido a Include pero es mas critico, si algo falla no sigue sino que tira fatal error */
//$conexion=require_once('../LOGGIN/connection.php');

$conexion=mysqli_connect('localhost','root','','inventariotinogasta2019') or die ("problemas con la conexion ");

/* Verifica campos vacios */
if(!empty($_REQUEST['nro_serie'] && $_REQUEST['pallet'])){
	/* query para verificar si el numero de serie ya fue escaneado */
	$qFueIngresado="select * from bienes_escaneados where nro_serieB = '$_REQUEST[nro_serie]'";
	$runFueIngresado=mysqli_query($conexion, $qFueIngresado) or die ("Error en la validacion de bienes ya ingresados ".mysqli_error($conexion));
	/* Caso de numero ya escaneado */
	if (mysqli_num_rows($runFueIngresado)>0){
		$GetResultado=mysqli_fetch_array($runFueIngresado);
		$qPallet="select * from pallet where id_pallet = '$GetResultado[id_pallet]'";
		$runqPallet=mysqli_query($conexion,$qPallet) or die("problemas con el consulta de pallet".($conexion));
		$getPallet=mysqli_fetch_array($runqPallet);
		echo "No ingresado ('".$GetResultado['nro_serieB']."' ya fue ingresado en el pallet '".$getPallet['nro_pallet']."' el '".$GetResultado['fecha']."')";
	} else {
	/* Caso de numero no escaneado */
		
		/* Verifica si el pallet existe */
		$qExistePallet="select * from pallet where nro_pallet = '$_REQUEST[pallet]'";
		$runExistePallet=mysqli_query($conexion, $qExistePallet) or die ("Error en la verificacion de Pallet".mysqli_error($conexion));
		$getExistePallet=mysqli_fetch_array($runExistePallet);

		/* Pallet existente en estado "cerrado" */
		if($getExistePallet['estado']=="cerrado"){
			echo "el pallet '".$getExistePallet['nro_pallet']."' ya fue marcado como cerrado";
		} else {							
			/* Pallet no existe */
			if (mysqli_num_rows($runExistePallet)==0) {
				/* Creo nuevo pallet */
				$estadoPallet="en proceso";
				$cantidadReg=0;
				$qnuevoPallet="insert into pallet (nro_pallet,cantidad,estado) values ('$_REQUEST[pallet]',$cantidadReg,'$estadoPallet')";
				mysqli_query($conexion,$qnuevoPallet) or die ("Error en el alta de nuevo pallet ".mysqli_error($conexion));
				/* obtengo el id del pallet nuevo creado para asociarlo en el ingreso del bien */
				$idDePallet=(int) mysqli_insert_id($conexion);
				echo "nuevo pallet dado de alta. ";

			/* Pallet existente en estado "en proceso" */	
			} elseif ($getExistePallet['estado']=="en proceso") {
				/* obtengo el id del pallet */
				$idDePallet=$getExistePallet['id_pallet'];
			}
			
			$usuario=$_SESSION['id_Usuario'];
			/* query que verifica si existe el serie en la bd */
			$qVerificaSerie="select id_series from series WHERE nro_serie = '$_REQUEST[nro_serie]'";
			/* query para ingresar bienes */
			$qIngresaBienes="insert into bienes_escaneados (nro_serieB,bateria,usuario,id_pallet) values ('$_REQUEST[nro_serie]','$_REQUEST[bateria]',$usuario,$idDePallet)";
			/* query para hacer un conteo de registros segun nro pallet */
			$qContador="select count(*) as total from bienes_escaneados where id_pallet=$idDePallet";

			/* valido el serie en la bd de Conectar */
			$runVerificaSerie=mysqli_query($conexion, $qVerificaSerie) or die ("Error en la validacion de series Conectar ".mysqli_error($conexion));

			if(mysqli_num_rows($runVerificaSerie)>0){
				/* Si encontro registro, ejecuto insert */
				mysqli_query($conexion, $qIngresaBienes) or die ("Error en el alta de bienes escaneados ".mysqli_error($conexion));
				echo "'".$_REQUEST['nro_serie']."' ingresado".",";
				$cantidadReg=mysqli_query($conexion, $qContador) or die ("Error en la consulta contador de ingresados ".mysqli_error($conexion));
				$cant = mysqli_fetch_array($cantidadReg);
				echo $cant['total'];
				$qActualizaCant="update pallet set cantidad='$cant[total]' where id_pallet=$idDePallet";
				mysqli_query($conexion,$qActualizaCant) or die("Error en la actualizacion de cantidad de pallet ".mysqli_error($conexion));
			} else {
				echo "No se encuentra el registro";
			}
		}				
	}			
} else {
	echo "Verifique campos vacíos";
}

mysqli_close($conexion);

?>