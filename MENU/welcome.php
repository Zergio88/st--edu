<?php

session_start();

if(isset($_SESSION['User']))
{
	echo 'Welcome '.$_SESSION['User'];
	echo '<a href="../LOGGIN/logout.php?logout"> logout</a>';
}
else
{
	header("location:../LOGGIN/index.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> MENU ST - Educ.ar S.E. </title>
<link rel="shortcut icon" href="../IMG/favicon.ico" type="image/x-icon">
<!-- Menu desplegable utilizando solo css -->
<link rel="stylesheet" href="estilos.css">

</head>
<body>
	<center>
		<h1> ST - Educ.ar S.E. </h1>
	</center>

	<header>
		<nav class="navegacion">
			<ul class="menu">
				<li><a href="#"></a> Ingresos 
					<ul class="submenu_Netbooks">
						<li><a href="../INGRESO/ingreso.php"> Ingreso de bienes </a></li>
						<li><a href="../CONSULTANETs/formulario.html"> Consulta de bienes </a></li>
						<li><a href="../CONSULTA/index.html"> Modificar </a></li>
						<li><a href="../BORRARNETs/formulario.html"> Borrar un registro </a></li>
					</ul>
				</li>
				<li><a href="#"></a> Diagnostico
					<ul class="submenu_srv">
						<li><a href="../INGRESOSRV/formulario.html"> Diagnostico de equipo </a></li>
						<li><a href="../CONSULTASRV/formulario.html"> Consulta de equipo </a></li>
						<li><a href="../BORRARSRV/formulario.html"> Modifcar estado </a></li>
						<li><a href="../BORRARSRV/formulario.html"> Borrar registro </a></li>
					</ul>
				</li>
				<li><a href="#"></a> Calidad
					<ul class="submenu_srv">
						<li><a href="../INGRESOSRV/formulario.html"> Cambiar estado </a></li>
						<li><a href="../CONSULTASRV/formulario.html"> Consulta de equipo </a></li>
						<li><a href="../BORRARSRV/formulario.html"> Borrar registro </a></li>
					</ul>
				</li>
				<li><a href="#"></a> Egreso
					<ul class="submenu_Ingreso">
						<li><a href="#"> Armar pallet </a></li>
						<li><a href="#"> Consulta de equipos </a></li>
						<li><a href="#"> Modificar </a></li>
						<li><a href="#"> Borrar </a></li>
					</ul>
				</li>
				<li><a href="#"></a> Inventario
					<ul class="submenu_Ingreso">
						<li><a href="../INVENTARIO2019/ingresar.php"> alta de netbooks </a></li>
						<li><a href="#"> Consulta de netbooks </a></li>
						<li><a href="#"> Modificar </a></li>
						<li><a href="#"> Borrar </a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

</body>
</html>