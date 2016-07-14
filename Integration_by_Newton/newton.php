
<html>
<head><link rel="stylesheet" type="text/css" href="untitled1.css" /></head>
<body>
<form name="" method="post" action="">
<table border="1" align="left">
<tr><td>funcion</td><td colspan="2"><input type="text" name='funcion' value="<?php if(isset($_POST['funcion']))echo $_POST ['funcion'];?>"></td></tr>
<tr><td>a</td><td colspan="2"><input type="text" name='a' value="<?php if(isset($_POST['a']))echo $_POST ['a'];?>"></td></tr>
<tr><td>b</td><td colspan="2"><input type="text" name='b' value="<?php if(isset($_POST['b']))echo $_POST ['b'];?>"></td></tr>
<tr><td>#subintervalos</td><td colspan="2"><input type="text" name='subint' value="<?php if(isset($_POST['subint']))echo $_POST ['subint'];?>"></td></tr>
<tr><td>tolerancia</td><td colspan="2"><input type="text" name='tol' value="<?php if(isset($_POST['tol']))echo $_POST ['tol'];?>"></td></tr>
<tr><td colspan="3" align="left"><select name="cmbx">
<option value="0">SELECCIONE UN MÉTODO</option>
<option value="1">Aproximaciones sucesivas</option>
<option value="2">Bisección</option>
<option value="3">Secante</option>
<option value="4">Híbrido</option>
<option value="5">Newton</option>
<</select></td></tr>
<tr><td colspan="3" align="left"><input type="submit" name='btn' value="calcular"></td></tr>
<tr><td>i</td><td>f(x0)</td><td>fx(x1)</td></tr>
<?php
if(isset($_POST['btn']))
{
	$op=$_POST['cmbx'];
	$funcion=$_POST['funcion'];
	$a=$_POST['a'];
	$b=$_POST['b'];
	$subint=$_POST['subint'];	
	$tol=$_POST['tol'];	
$h=($b-$a)/$subint;
	$res=array();
	$k=0;
	
	switch($op)
	{
		case 1:
			Graficar();

		for($x=$a;$x<=$b;$x=$x+$h)
		{
			echo "<tr><td>$k</td><td>".fnEval($x,$funcion)."</td><td>".fnEval($x+$h,$funcion)."</td></tr>";
			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
				if(converge($x,$funcion,$tol))
					array_push($res,aproximaciones($funcion,$x,$tol));
			}
			$k++;
		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;
		
		case 2:
		for($x=$a;$x<=$b;$x=$x+$h)
		{
			echo "<tr><td>$k</td><td>".fnEval($x,$funcion)."</td><td>".fnEval($x+$h,$funcion)."</td></tr>";
			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,biseccion($x,$x+$h,$funcion,$tol));
			}
			$k++;
		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;
		
		case 3:
		for($x=$a;$x<=$b;$x=$x+$h)
		{
			echo "<tr><td>$k</td><td>".fnEval($x,$funcion)."</td><td>".fnEval($x+$h,$funcion)."</td></tr>";
			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,secante($x,$x+$h,$funcion,$subint,$tol));
			}
			$k++;
		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;
		
		case 4:
		for($x=$a;$x<=$b;$x=$x+$h)
		{
			echo "<tr><td>$k</td><td>".fnEval($x,$funcion)."</td><td>".fnEval($x+$h,$funcion)."</td></tr>";
			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,hibrido($x,$x+$h,$funcion,$tol));
			}
			$k++;
		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;
		
		case 5:
		for($x=$a;$x<=$b;$x=$x+$h)
		{
			echo "<tr><td>$k</td><td>".fnEval($x,$funcion)."</td><td>".fnEval($x+$h,$funcion)."</td></tr>";
			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,newton($funcion,$x,$tol,$subint));
			}
			$k++;
		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;
		
		default: break;
	}
}
?>
</table>
</form>
</body>
</html>
<?php

function cambiosig($funcion,$x0,$x1)//sirve
{
	$y1=fnEval($x0,$funcion);
	$y2=fnEval($x1,$funcion);
	//echo $x0.":".$x1.":".$y1.":".$y2."<br/>";
	if($y1*$y2<0)
		return true;
	return false;
}

function biseccion($x0,$x1,$fun,$tol)//sirve
{
	do{
		$c=($x1+$x0)/2;
		$resultado=$c;
		
		if (fnEval($c,$fun)==0)
			break;
		if (fnEval($x0,$fun)*fnEval($x1,$fun)<0)
			$x1=$c;
		else
			$x0=$c;	
	}while(abs($x0-$x1)<$tol);
	return $resultado;
}

function secante($x0,$x1,$funcion,$subint,$tol)//sirve
{
	$i=0;
	$itemax=$subint;
	$fx0=fnEval($x0,$funcion);
	$fx1=fnEval($x1,$funcion);
	while($i<$itemax)
	{
		$x=($x1)-((($fx1)*($x1-$x0))/($fx1-$fx0));
		$fx=fnEval($x,$funcion);
		if(abs($fx)<$tol)
			break;
		$i++;
		$x0=$x1;
		$x1=$x;
	}
	return $x;
}

function fnEval($x, $funcion)//sirve
{
	$resultado=0;
	$funcion= str_replace("x","(".$x.")" , $funcion);
	eval("\$resultado=".$funcion.";");
	return $resultado;

}

function DerivadaCentrada( $x, $funcion, $e)//sirve
{
	$result= 1;
	$l = 0;
	$vx = 0.0001;
	while(true)
	{
		$f1 = (FnEval($x + $vx, $funcion) - FnEval($x - $vx, $funcion)) / (2 * $vx);
		$l = $l+1;
		$vx= $vx/2;
		if($l > 1)
			$result = abs(($f1 - $f2) /$f2);
		if($result < $e)
			break;
		$f2 =$f1;
	}
		return $f2;
}

function converge($x,$funcion,$tol)//deberia
{	
	if(abs(DerivadaCentrada($x,$funcion,$tol))>=1)
		return false;
	return true;
}

function aproximaciones($funcion,$x0,$tol)//sirve 
{
	while(true)
	{
		$x1=fnEval($x0,$funcion)+$x0;
		if(abs($x1-$x0)<=$tol)
			break;		
		$x0=$x1;
	}
	return $x1;
}

function hibrido($x0,$x1,$funcion,$tol)//sirve
{	
	$fx0=fnEval($x0,$funcion);
	$fx1=fnEval($x1,$funcion);
	while(true){
		$c=($x1)-((($fx1)*($x1-$x0))/($fx1-$fx0));
		$fc=fnEval($c,$funcion);
		if(abs($x1-$c)<=$tol || abs($fc)<=$tol)
			break;
		if(fnEval($x1,$funcion)*fnEval($c,$funcion)<=0)
			$x0=$c;
		else
			$x1=$c;
	}
	return $c;
}

function newton($funcion,$x0,$tol,$subint)//sirve
{
	$k=1;
	$itemax=$subint;
	$resp=0;
	while($k<=$itemax){
		$fx0=fnEval($x0,$funcion);
		$derivx0=DerivadaCentrada($x0,$funcion,$tol);
		$x1=$x0-($fx0/$derivx0);
		if(abs($fx0)<=$tol)
		{
			$resp=$x0;
			break;
		}
		if($derivx0==0)
			return "Error 1: derivada nula";
		if(abs($x1-$x0)<=$tol)
		{
			$resp=$x1;
			break;
		}
		$k++;
		$x0=$x1;
	}
	return $resp;	
}
//FUNCIONES GRAFICAR
function Graficar()
{
	$width=1000;
	$height=1000;
	$salto=50;
	$img = crearFondo($width, $height );
	$img = ejesCordenados ($img,$width,$height,$salto);
	$img = ecuacion ($img, $width,$height,$salto,$_GET['funcion']);
	$path = "Imagenes/fondo.png";
	crearArchivoG($img,$path);
	//imagepng($img,$path);
	imagecreatefrompng($path);
	?>
	<img src="Imagenes/fondo.png" align="right">
	<?php
}

function crearArchivoG($img,$path){
	//Ej: $path = "Imagenes/fondo.png"
	imagepng ($img,$path); //crea un archivo png
	imagedestroy ($img); //Libera la memoria
}

function crearFondo($width, $height ){
	$img = imagecreatetruecolor ($width, $height); //Crea la imagen
	$color1 = imagecolorallocate ($img , 0,0,0); //Define color negro
	$color2 = imagecolorallocate ($img , 255,255,255); //Define color blanco
	imagefill($img,$width,$height,$color2); //imagen, origen en x, origen en y, color
	return $img;
}

function ejesCordenados ($img,$ancho,$alto,$salto){
	$color1 = imagecolorallocate ($img , 0,0,0); //Cargo de nuevo mi color
	$color2 = imagecolorallocate ($img , 255,255,255); //Cargo de nuevo mi color
	$gris = imagecolorallocatealpha($img, 255, 255, 255, 80); // Color de las lineas
	imagefill ($img , 0,0 , $color1); //Rellena de un color la imagen
	imageline($img,0,$ancho/2,$alto,$ancho/2,$color2);//Lineas Horizontales
	imageline($img,$ancho/2,0,$alto/2,$alto,$color2);//Lineas verticales
	//Numeracion de ejes coordenados
	$n = ($ancho/2)/$salto;
	$m = (($alto/2)/$salto)*-1;
	for($i=0; $i<$alto;$i++)
		if ($i % $salto==0){
			imageline($img,($alto/2)-1,$i,($alto/2)+2,$i,$color2);//horizontal
			imageline($img,0,$i,$ancho,$i,$gris);//horizontal cuadricula
			imageline($img,$i,($alto/2)-1,$i,($alto/2)+2,$color2);//vertical
			imageline($img,$i,0,$i,$alto,$gris);//vertical cuadricula
			imagestring ($img, 1 , $i-6, ($alto/2)-10  , $m , $color2);//horizontal
			imagestring ($img, 1 , ($alto/2)+6, $i-4 , $n , $color2);//vertical
			$n--;
			$m++;
		}
	return $img;
}

function ecuacion ($img, $ancho,$alto,$salto,$funcion){
	$ancho=($ancho/2)*-1;
	$alto=$alto/2;
	$color = imagecolorallocate ($img , 0, 255, 0);
	for($x=$ancho;$x<$alto;$x+=0.001){
		$y= fnEval($x,$funcion);//(($x)*($x))-4; //Funcion matematica
		imagesetpixel ($img , ($x*$salto)+$alto,$alto-($y*$salto),$color ); //Manda a graficar la funcion
	}
	return $img;
}
?>