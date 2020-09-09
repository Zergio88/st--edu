<?php

session_start();
/* Parecido a Include pero es mas critico, si algo falla no sigue sino que tira fatal error */
//$conexion=require_once('../LOGGIN/connection.php');

$conexion=mysqli_connect('localhost','root','','inventariotinogasta2019') or die ("problemas con la conexion");

/* verifica si existe el nro de pallet */
if(!empty($_REQUEST['pallet'])){
	/* verifica que exista el pallet */
	$qExistePallet="select * from pallet where nro_pallet = '$_REQUEST[pallet]'";
	$runExistePallet=mysqli_query($conexion, $qExistePallet) or die ("problemas con verificacion de nro de pallet");
	$getExistePallet=mysqli_fetch_array($runExistePallet);
	/* Caso de pallet existente */
	if (mysqli_num_rows($runExistePallet)>0) {

		/* pallet en proceso*/
		if ($getExistePallet['estado']=="en proceso") {
			$estado="cerrado";
			$idDePallet=$getExistePallet['id_pallet'];
			$qActualizarCant="update pallet set estado='$estado' where id_pallet=$idDePallet";
			mysqli_query($conexion,$qActualizarCant);
			echo "Se cerro el pallet ".$getExistePallet['nro_pallet'];
		/* pallet cerrado */
		} elseif ($getExistePallet['estado']=="cerrado") {
	  		echo "el pallet ya fue marcado como cerrado";
		}
	} else {
		echo "No se encontro numero de pallet: ".$_REQUEST['pallet'];
	}
} else {
	echo "verifique el campo pallet";
}	
	
mysqli_close($conexion);

?>