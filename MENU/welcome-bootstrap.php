<?php

session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title> MENU ST - Educ.ar S.E. </title>
	<link rel="shortcut icon" href="../IMG/favicon.ico" type="image/x-icon">
	<!-- Menu desplegable utilizando solo css -->
	<link rel="stylesheet" href="estilos.css">
	 <!-- Bootstrap 4 offline -->
	<link href="../BOOTSTRAP4/css/bootstrap.css" rel="stylesheet" />
	<script src="../JQUERY/jquery-3.4.1.min.js"></script>
	<script src="../BOOTSTRAP4/js/bootstrap.min.js"></script>
</head>
<body style="background:#CCC;">
	<div class="container">
		<h3 class="text-white bg-primary" align="center"> MENU </h3>	
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
		    <ul class="navbar-nav">
		    	<li class="nav-item dropdown mx-2 px-2 border-bottom border-left border-secondary rounded">
			    	<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Ingresos
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default">
				    		<a class="nav-link" href="../INGRESO/ingreso.php"> Ingreso de bienes </a>
				    		<a class="nav-link" href="../CONSULTANETs/formulario.html"> Consulta de bienes </a>
						</div>
		        	</div>
			  	</li>
		      	<li class="nav-item dropdown mx-2 px-2 border-bottom border-left border-secondary rounded">
			    	<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Diagnostico
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default">
				    		<a class="nav-link" href="../DIAGNOSTICO/intervencion.php"> Intervencion </a>
				    		<a class="nav-link" href="../CONSULTANETs/formulario.html"> consulta de equipo </a>
						</div>
		        	</div>
			  	</li>
				<li class="nav-item dropdown mx-2 px-2 border-bottom border-left border-secondary rounded">
			    	<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Calidad
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default">
				    		<a class="nav-link" href="../CALIDAD/intervencion.php"> Control de calidad </a>
				    		<a class="nav-link" href="../CONSULTANETs/formulario.html"> consulta de equipo </a>
						</div>
		        	</div>
			  	</li>
				<li class="nav-item dropdown mx-2 px-2 border-bottom border-left border-secondary rounded">
			    	<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Egreso
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default">
				    		<a class="nav-link" href="../INGRESO/ingreso.php"> Egreso de equipos </a>
				    		<a class="nav-link" href="../CONSULTANETs/formulario.html"> consulta de equipo </a>
						</div>
		        	</div>
			  	</li>
			  	<li class="nav-item dropdown mx-2 px-2 border-bottom border-left border-secondary rounded">
			    	<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Stock repuestos
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default">
				    		<a class="nav-link" href="../INVENTARIO2019/ingresar.php"> consulta de stock </a>
						</div>
		        	</div>
			  	</li>

		      	<li class="nav-item dropdown mx-2 px-2 border-bottom border-left border-secondary rounded">
			    	<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Inventario
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default">
				    		<a class="nav-link" href="../INVENTARIO2019/ingresar.php"> alta de bienes </a>
				    		<a class="nav-link" href="../CONSULTANETs/formulario.html"> consulta de equipo </a>
						</div>
		        	</div>
			  	</li>
		    </ul>
		 </div>
			<ul class="navbar">
			 	<li class="navbar dropdown" style="float: right">	
			    	<a class="navbar navbar-default dropdown-toggle nav" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	<?php
						if(isset($_SESSION['User']))
						{
							echo $_SESSION['User'];
						}
						else
						{
							header("location:../LOGGIN/index.php");
						}
					?>
			    	</a>	       
			    	<div class="dropdown-menu">
				    	<div class="navbar-default " style="text-align: center">
				    	<?php
							if(isset($_SESSION['User']))
							{
								

								echo '<a href="../LOGGIN/logout.php?logout" style="color: grey">logout</a>';
							}
							else
							{
								header("location:../LOGGIN/index.php");
							}
						?>
						</div>
		        	</div>	        
			  	</li>
		  	</ul>
		</nav>
	</div>
	<div class="fixed-bottom">
	<footer><font color="white"><marquee style="background: #007bff" scrolldelay="1"> Soporte Tecnico Educar SE - Bienes del programa Aprender Conectados </marquee></font></footer>
	</div>
</body>
</html>