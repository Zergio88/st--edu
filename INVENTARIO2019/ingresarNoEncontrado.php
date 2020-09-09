<?php

session_start();
/* Parecido a Include pero es mas critico, si algo falla no sigue sino que tira fatal error */
//$conexion=require_once('../LOGGIN/connection.php');

$conexion=mysqli_connect('localhost','root','','inventariotinogasta2019') or die ("problemas con la conexion".mysqli_error($conexion));

/* query para verificar si existe el nro de pallet */
$qExistePallet="select * from pallet where nro_pallet = '$_REQUEST[pallet]'";
$runExistePallet=mysqli_query($conexion, $qExistePallet) or die ("problemas con verificacion de nro de pallet".mysqli_error($conexion));
$resul_pallet=mysqli_fetch_array($runExistePallet);
/* si no existe el pallet, lo creo*/
if (mysqli_num_rows($runExistePallet)==0) {
	$estadoPallet="en proceso";
	$cantidadReg=0;
	/* query para crear nuevo pallet */
	$qnuevoPallet="insert into pallet (nro_pallet,cantidad,estado) values ('$_REQUEST[pallet]',$cantidadReg,'$estadoPallet')";
	mysqli_query($conexion,$qnuevoPallet) or die ("Problemas en el alta de nuevo pallet".mysqli_error($conexion));
	/* obtengo el id del nuevo pallet (ultimo id creado) para usarlo en el ingreso de bienes */
	$idDePallet=(int) mysqli_insert_id($conexion);
	echo "Nuevo pallet dado de alta. ";
} else if ($resul_pallet['estado']=="en proceso") {
	$msjPalletCreado="";
	/* obtengo el id del pallet existente */
 	$idDePallet=$resul_pallet['id_pallet'];
 	if ($resul_pallet['cantidad']==0) {
 		$msjPalletCreado="nuevo pallet dado de alta.";
 	}
}

$usuario=$_SESSION['id_Usuario'];
/* query para ingresar bienes */
$qIngresoBienes="insert into bienes_escaneados (nro_serieB,bateria,usuario,id_pallet) values ('$_REQUEST[nro_serie]','$_REQUEST[bateria]',$usuario,$idDePallet)";

/* ejecuto insert imperativamente */
mysqli_query($conexion, $qIngresoBienes) or die ("Problemas en el insert de ingresos ".mysqli_error($conexion));
echo $msjPalletCreado." '".$_REQUEST['nro_serie']."' ingresado".",";

/* query para hacer un conteo de registros segun nro pallet */
$qCantidad="select count(*) as total from bienes_escaneados where id_pallet=$idDePallet";
$runCantidad=mysqli_query($conexion, $qCantidad) or die ("Problemas en el insert de chequeo de serie ".mysqli_error($conexion));
$cant = mysqli_fetch_array($runCantidad);
echo $cant['total'];
/* query para actualizar la cantidad */
$qActualizarCant="update pallet set cantidad='$cant[total]' where id_pallet=$idDePallet";
mysqli_query($conexion,$qActualizarCant);

/* cierre de conexion */
mysqli_close($conexion);

?>
