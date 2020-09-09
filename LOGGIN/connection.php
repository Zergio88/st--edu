<?php 

$con = 	mysqli_connect('localhost','root','','edustdb');

if(!$con)
{
	die(' Por favor, chequear su conexion'.mysqli_error());
}

?>