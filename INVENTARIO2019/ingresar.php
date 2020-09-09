<?php
    session_start();
    if(isset($_SESSION['User']))
    {
        echo '<div class="" style="float: right; margin-right:10">';
        echo 'Welcome '.$_SESSION['User'];
        echo '<a href="../LOGGIN/logout.php?logout"> logout </a>';    
        echo '</div><br />';    
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
        <title> Ingreso de Bienes - Educ.ar S.E. </title>
        <link rel="shortcut icon" href="../IMG/favicon.ico" type="image/x-icon">
        <!-- Bootstrap 4 online -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="
        sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

        <!-- Bootstrap 4 offline -->
        <link href="../BOOTSTRAP4/css/bootstrap.css" rel="stylesheet" />
        <script src="../BOOTSTRAP4/js/bootstrap.min.js"></script>
        <script src="funciones.js"></script>
        <script type="jquery.min"></script>
    </head>
    <body>
            <div class="card-title bg-primary text-white mt-0">
                <h1 align="center"> Inventario de netbooks - Educ.ar S.E. </h1>
            </div>
            <form action="ingresarBienesInv2019.php" method="POST" id="formulario">
                <div class="container"style="padding: 10;">

                    Numero de serie:
                    <input type="text" name="nro_serie" id="nro_serie" />                   

                    Pallet:
                    <input type="text" name="pallet" id="pallet"/>

                     bateria:
                    <select name="bateria" id="bateria"><br>
                        <option value="S">SI</option>
                        <option value="N">NO</option>
                    </select>
                     cantidad escaneada:
                    <label id="Cantidad"></label>
                </div>
                <div class="container" style="padding: 5;">
                    <input id="btn_ingresar" type="submit" value="Ingresar" class="btn btn-primary btn-center">
                    <label id="resultados" class="alert alert-light" role="alert"></label>
                </div>
                <div class="trans text-center" style="padding: 5;">
                    <input id="btn_terminar" type="submit" value="cerrar pallet" class="btn btn-secondary">
                </div>

            </form>
    </body>
</html>
