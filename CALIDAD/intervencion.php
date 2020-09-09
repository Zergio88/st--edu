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
        <title> Control de Calidad - Educ.ar S.E. </title>
        <link rel="shortcut icon" href="../IMG/favicon.ico" type="image/x-icon">

        <!-- Bootstrap 4 -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="
        sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

        <!-- Bootstrap 4 offline -->
        <link href="../BOOTSTRAP4/css/bootstrap.css" rel="stylesheet" />
        <script src="../JQUERY/jquery-3.4.1.min.js"></script>
        <script src="../BOOTSTRAP4/js/bootstrap.min.js"></script>        
        <script src="funciones.js"></script>
    </head>
    <body>   

            <div class="card-title bg-primary text-white mt-0">
                <h1 align="center"> Control de Calidad - Educ.ar S.E. </h1>
            </div>
            <span> Ultima incidencia de la maquina </span>
            <div class="form-group">
                <form action="consultaIncidencia.php" method="POST" id="formulario">
                    <div class="container"style="padding: 10;">
                        Numero de serie
                        <input type="text" name="nro_serie" id="nro_serie" />
                        <input id="btn_consultar" type="submit" value="buscar" class="btn-primary align-center" />
                    </div>
               
                </form>          
            </div>            
        </div>
        <div id="resultados"></div>

        <span> Nueva intervencion </span>
            <div id="formulario" class="form-group">
                <form action="nuevaIncidencia.php" method="POST" id="formulario">
                    <div class="container"style="padding: 10;">
                        observaciones:
                        <textarea class="form-control" rows="1" id="observaciones" name="observaciones" ></textarea>
                        <input id="btn_ingresar" type="submit" value="agregar" class="btn-primary align-center" />
                    </div>
               
                </form>
        <div id="resulta"></div>
    </body>
</html>
