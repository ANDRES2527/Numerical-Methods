<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1995/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ut-8"/ >
		<title>Graficador</title>
	</head>
	<?php
	require_once("/funciones/func.php");
	?>
	<body >
		<table width=60%  border="2" style="background-color:blue.">
			<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<tr>
					<td colspan="4" align="center" style="background-color:RoyalBlue"> Graficador</td>
	
				</tr>
				<tr>
					<td colspan="2" align="Center" style="background-color:RoyalBlue">Funci&oacute;n</td>
					<td colspan="2" align="left"><input type="text" style="width: 100%;" name="funcion"></td>
				</tr>
				
				<tr>
					<td colspan="2" align="Center" style="background-color:lightBlue">Ingrese el valor de X para la prueba</td>
					<td colspan="2" align="left"><input type="text" style="width: 100%;" name="x"></td>
				</tr>
				<tr>
					<td colspan="2" align="Center" style="background-color:lightBlue">Ingrese el valor de la dif. de X para la prueba</td>
					<td colspan="2" align="left"><input type="text" style="width: 100%;" name="difx"></td>
				</tr>
				<tr>
					<td colspan="2" align="Center" style="background-color:lightBlue">Ingrese el valor de la tolerancia E</td>
					<td colspan="2" align="left"><input type="text" style="width: 100%;" name="e"></td>
				</tr>
				<tr>
					<td colspan="2" align="Center" style="background-color:lightBlue">Ingrese el valor de A E</td>
					<td colspan="2" align="left"><input type="text" style="width: 100%;" name="a"></td>
				</tr>
				<tr>
					<td colspan="2" align="Center" style="background-color:lightBlue">Ingrese el valor de B E</td>
					<td colspan="2" align="left"><input type="text" style="width: 100%;" name="b"></td>
				</tr>
				<tr>
					<td colspan="4" align="center"><input type="submit" value="enviar" style="background-color:SteelBlue;width:100%;" name="enviar"></td>
				</tr>
			</form>
		</table>
		<br />
		<?php if(isset($_POST['enviar'])) {graficar(400,400,50,$_POST['funcion']);}?>
		<table width=100%  border="2" style="background-color:blue">
			
			<tr>
					<td colspan="3" style="width: 100%; background-color:lightblue" >;<center><?php if(isset($_POST['enviar'])) {echo "".$_POST['funcion'];}?></center></td> 
			</tr>
			<tr>
					<td style="width: 30%; background-color:royalblue" ><?php if(isset($_POST['enviar'])) {echo "".diferencias_centrales($_POST['x'],$_POST['difx'],$_POST['e'],$_POST['funcion']);}?></td> 
					<td style="width: 30%;background-color:royalblue"><?php if(isset($_POST['enviar'])) {echo "".diferencias_avanzadas($_POST['x'],$_POST['difx'],$_POST['e'],$_POST['funcion']);}?></td>
					 <td style="width: 30%;background-color:royalblue"><?php if(isset($_POST['enviar'])) {echo "".diferencias_retrazadas($_POST['x'],$_POST['difx'],$_POST['e'],$_POST['funcion']);}?></td>
			</tr>
			<tr>
					<td style="background-color:royalblue"></td>
					 <td style="background-color:white"> <div align="center"><img src="ejedecordenadas.png"></div></td> <td style="background-color:royalblue"> </td>
			</tr>
			<tr>
					<td colspan="3" style="background-color:royalblue"><center><?php if(isset($_POST['enviar'])) {echo "". metodo_trapecio($_POST['funcion'],$_POST['a'],$_POST['b'],120);}?>  </center></td>
			</tr>
			<tr>
					<td colspan="3" style="background-color:royalblue"><center><?php if(isset($_POST['enviar'])) {metodo_simpson($_POST['a'],$_POST['b'],$_POST['funcion'],0.0001);}?>  </center></td>
			</tr>
		</table>

		<?php ?>
	</body>
</html>