<?php
	require_once('Funciones/funciones.php');

	$width=1000;
	$height=1000;
	$salto=50;

	if (isset($_GET['Grafico'])){

		$img = crearFondo($width, $height );
		$img = ejesCordenados ($img,$width,$height,$salto);
		$img = ecuacion ($img, $width,$height,$salto,$_GET['funcion']);
		$path = "Imagenes/fondo.png";
		crearArchivoG($img,$path);
	}
	if (isset($_GET['calculos']) ){
		$tol=$_GET['tolerancia'];
		$nint=$_GET['nintervalos'];
		$fun=$_GET['funcion'];
		$soporte=$width/$salto;
		$inc=$soporte/$nint;
		//verificaci�n cambio de cambio de signo
		$cont=0;
		$resultado;
		for($x=$_GET['a'];$x<$_GET['b']-$inc;$x+=$inc){
			$pt1=fnEval($x, $fun);
			$pt2=fnEval($x+$inc, $fun);
			//cambio de signo, posible raiz
			if($pt1*$pt2<0){
				$cont++;
				$resultado=biseccion_iteraciones($x,$x+$inc,$fun,$tol);
				echo build_table($resultado);
				echo '<br><br>';
			}
		}

		echo build_table($resultado);

	}

?>
<html>
<head>
<title>Gr&aacute;fico b&aacute;sico</title>
<link rel="stylesheet" type="text/css" href="untitled1.css" />

<script type="text/JavaScript">
<!--'
function MM_goToURL() { //v3.0
  alert("Se va calcular la raiz");
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");

}
//-->
</script>

</head>
<body>
<table width="200">
	<form id="datos" action="" method="get" >

	<tr>
		<td colspan="2">
			<?php if (isset($_GET['Grafico'])){ ?>
			<img src="Imagenes/fondo.png" alt="Texto alternativo" >
			<?php } ?>
	</td>
	</tr>
	<tr>
		<td>Generar gr&aacute;fico PNG:</td>
		<td><input name="Grafico" type="submit" value="Ok"></td>

		<tr>
		<input type="checkbox" name="biseccion" > Raices Bisección<br>
		</tr>

		<td>Funcion:</td>
		<td><input type="text" name="funcion" id="funcion" value="<?php if(isset($_GET['funcion'])) echo $_GET['funcion'];?>"></td>
	</tr>
	</tr>
	<tr>
		<td>No. Intervalos: </td>
		<td><input type="text" name="nintervalos" id="nintervalos" value="<?php if(isset($_GET['nintervalos'])) echo $_GET['nintervalos'];?>"></td>
	</tr>
	<tr>
		<td>Tolerancia: </td>
		<td><input type="text" name="tolerancia" id="tolerancia" value="<?php if(isset($_GET['tolerancia'])) echo $_GET['tolerancia'];?>"></td>
	</tr>
		<tr>
			<td>a: </td>
			<td><input type="text" name="a" id="a" value="<?php if(isset($_GET['a'])) echo $_GET['a'];?>"></td>
		</tr>
		<tr>
			<td>b: </td>
			<td><input type="text" name="b" id="b" value="<?php if(isset($_GET['b'])) echo $_GET['b'];?>"></td>
		</tr>
	<tr>

		<td>Calcular raices:</td>
		<td><input name="calcular" type="button" onClick="MM_goToURL('parent','<?php echo $_SERVER['PHP_SELF']; ?>?calculos=true&nintervalos='+document.getElementById('nintervalos').value+'&tolerancia='+document.getElementById('tolerancia').value+'&funcion='+document.getElementById('funcion').value+'&a='+document.getElementById('a').value+'&b='+document.getElementById('b').value);return document.MM_returnValue" value="Calcular"></td>
	</tr>	
	</form>
</table>

</body>
</html>
