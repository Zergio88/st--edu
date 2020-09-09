<?php
	
session_start();

/* Parecido a Include pero es mas critico, si algo falla no sigue sino que tira fatal error */
require_once('connection.php');

	if(isset($_POST['Login']))
	{
		if(empty($_POST['UName']) || empty($_POST['Password']))
		{
			header("location:index.php?Empty=Por favor completar campos vacios");
		}
		else
		{
			$query="select * from usuarios where user='".$_POST['UName']."'and password='".$_POST['Password']."'";

			$result=mysqli_query($con,$query);

			// assoc y array son parecidas (ver diferencias)
			//if(mysqli_fetch_assoc($result))
			if ($reg=mysqli_fetch_array($result))

			{
				$_SESSION['User']=$_POST['UName'];
				$_SESSION['id_Usuario']=$reg['id_user'];
				header("location:../MENU/welcome-bootstrap.php");
			}
			else
			{
				header("location:index.php?Invalid=Contraseña o nombre de usuario incorrecto.");
			}
		}
	}
	else
	{
		echo 'No esta funcionando';
	}

 ?>