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
                <h1 align="center"> Ingreso de bienes - Educ.ar S.E. </h1>
            </div>
            <form action="ingresarBienes.php" method="POST" id="formulario">
                <div class="container"style="padding: 10;">

                     Tipo de bien
                    <select name="tipoBien" id="tipoBien" onchange="
                            if(this.value==5) {
                                document.getElementById('estadoRep').disabled = false
                                document.getElementById('nro_serie').disabled=true
                                document.getElementById('cantidad').disabled=false
                            }
                            else {
                                document.getElementById('estadoRep').disabled = true
                                document.getElementById('nro_serie').disabled=false
                                document.getElementById('cantidad').disabled=true
                            }
                            
                            if(this.value==1 || this.value==3) {
                                document.getElementById('bateria').disabled = false
                            } else {
                                document.getElementById('bateria').disabled = true}"
                            ><br>
                        <option value="" selected="true" disabled="disabled">seleccione</option>
                        <option value=1> Netbook </option>
                        <option value=2> Servidor </option>
                        <option value=3> Ups </option>
                        <option value=4> Caps </option>
                        <option value=5> Repuestos </option>
                    </select>

                    Numero de serie
                    <input type="text" name="nro_serie" id="nro_serie" />                   

                    Tipo de repuesto
                    <select name="estadoRep" id="estadoRep" disabled="true"><br>
                        <option value="" selected="true" disabled="disabled">seleccione</option>
                        <option value="bateria_ups"> Bateria de ups </option>
                        <option value="pila_netbook"> Pila de netbook </option>
                        <option value="pila_servidor"> Pila de servidor </option>
                        <option value="memoria_ram"> memoria ram </option>
                        <option value="disco_rigido"> Disco </option>
                        <option value="fuente_srv"> Fuente de servidor </option>
                    </select>

                    Cantidad
                    <input type="text" name="cantidad" id="cantidad" disabled="true"/>
                </div>
                <div class="container" style="padding: 5;">
                    <!-- Fecha
                    <input type="text" name="fecha" /> -->

                    estado del bien
                    <select name="estadoBien" id="estadoBien"><br>
                        <option value="" selected="true" disabled="disabled">seleccione</option>
                        <option value="AVerificacion"> Diagnostico </option>
                        <option value="Nuevo"> Nuevo </option>
                        <option value="Areparacion"> reparacion </option>
                        <option value="Desguace-repuesto"> desguace </option>
                    </select>

                    bateria
                    <select name="bateria" id="bateria" disabled="true"><br>
                        <option value="S">SI</option>
                        <option value="N">NO</option>
                    </select><br>         
                </div>        
                <div class="container" style="padding: 5;">

                    Remitente
                    <select name="Remitente" id="Remitente" onchange="
                        if(this.value=='Otro') {
                            document.getElementById('oremitente').disabled = false
                        } else {
                            document.getElementById('oremitente').disabled = true
                        }"><br>
                        <option value="" selected="true" disabled="disabled">seleccione</option>
                        <option value="Educar S.E."> Educar S.E. </option>
                        <option value="Corasa"> Corasa </option>
                        <option value="Otro"> Otros </option>
                    </select>

                    Otros
                    <input type="text" name="oremitente" id="oremitente" disabled="true"/><br>
                    <div class="form-group" style="padding: 5;">        
                        observaciones:
                        <textarea class="form-control" rows="1" id="comentarios" name="comentarios" ></textarea>
                    </div>
                    <input type="submit" value="Ingresar" class="btn-primary btn-center">
            </form>          
        </div>
        <div id="resultados"></div>
    </body>
</html>
