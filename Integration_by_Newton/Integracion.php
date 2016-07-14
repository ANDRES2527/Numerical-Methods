

<?php
/**
 * Created by PhpStorm.
 * User: EYSCORP
 * Date: 7/3/2016
 * Time: 8:29
 * jose.lucio@epn.edu.ec
 */


?>
<link rel="stylesheet" type="text/css" href="untitled1.css" />
<table width=40%  border="10" style="background-color:midnightblue" >
<form name = "form1" action = "Llamar_integral.php" method= "get" >

    <font color="#191970"> <H1 ALIGN=center > CALCULADOR DE INTEGRALES DEFINIDAS </H1> </font>
    <H2 ALIGN=center> Andrés Asimbaya </H2>



    <font color="black" size="10"><th><b>Ingrese la funcion:</b></th></font>
    <td ><input type = "text"  name = "funcion" align="center"/></td>

    <tr>
        <font color="black" size="10"><th><b>Ingrese la derivada:</b></th></font>
        <td ><input type = "text"  name = "derivada" align="center"/></td>
    </tr>

    <tr>

        <font color="black" size="10"><th><b>Ingrese el numero de intervalos:</b></th></font>
            <td ><input type = "text"  name = "nintervalos" align="center" /></td>
    </tr>

    <tr>
    <font color="black" size="10"><th><b>Ingrese la tolerancia:</b></th></font>
    <td ><input type = "text"  name = "tolerancia" align="center"  /></td>
    </tr>


    <tr>
        <font color="black" size="5"><b><th>a:</th></b></font>
        <td><input type = "text"  name = "a"  /></td>
    </tr>


    <tr>
        <font color="black" size="5"><b><th>b:</th></b></font>
        <td><input type = "text"  name = "b" /></td>
    </tr>

    <br>
    <br>

    <select name="Funciones">
        <option value="1">Raices Biseccion</option>
        <option value="2">Raices Secante</option>
        <option value="3">Raices Newton</option>
        <option value="4">Graficar función</option>

        <br>
        <br>
        <p>
            <b> <input name="enviar_simpson" value="Calcular" type="submit"/></b>
        </p>

        <div>
            <body background= "fondomatematicas1.png" >
        </div>






</form>
    </table>
