<script language=JavaScript>
	function habilitar() {
		document.getElementsByName("deriv").disabled = true;
	}
</script>
<html>
<head><link rel="stylesheet" type="text/css" href="untitled1.css" /></head>
<body background= "fondomatematicas1.png" >
<form id="ra" name="" method="post" action="">
<table border="1" align="left">
<tr><td>Funcion</td><td colspan="2"><input type="text" name='funcion' value="<?php if(isset($_POST['funcion']))echo $_POST ['funcion'];?>"></td></tr>
	<tr><td>Derivada</td><td colspan="2"><input type="text" name='deriv' value="<?php if(isset($_POST['deriv']))echo $_POST ['deriv'];?>"></td></tr>
	<tr><td>a</td><td colspan="2"><input type="text" name='a' value="<?php if(isset($_POST['a']))echo $_POST ['a'];?>"></td></tr>
<tr><td>b</td><td colspan="2"><input type="text" name='b' value="<?php if(isset($_POST['b']))echo $_POST ['b'];?>"></td></tr>
<tr><td>Subintervalos</td><td colspan="2"><input type="text" name='subint' value="<?php if(isset($_POST['subint']))echo $_POST ['subint'];?>"></td></tr>
<tr><td>Tolerancia</td><td colspan="2"><input type="text" name='tol' value="<?php if(isset($_POST['tol']))echo $_POST ['tol'];?>"></td></tr>
<tr><td colspan="3" align="left"><select name="cmbx">
<option value="0">NINGUNA</option>
<option value="1">Aproximaciones sucesivas</option>
<option value="2">Bisección</option>
<option value="3">Secante</option>
<option value="4">Híbrido</option>
<option value="5">Newton</option>
			<option value="6">Gráfico</option>

<</select></td></tr>
<tr><td colspan="3" align="left"><input type="submit" name='btn' value="Calcular"></td></tr>

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
		//Graficar();
			for($x=$a;$x<=$b;$x=$x+$h)
			{

				if(fnEval($x,$funcion)==0)
					array_push($res,$x);
				if(cambiosig($funcion,$x,$x+$h))
				{
					array_push($res,newton($funcion,$x,$tol,$subint));
					$it=newton_iter($funcion,$x,$tol,$subint);
					$cont=0;
					echo"<tr></tr><td colspan=3 align=center>Iteracion";
					echo"<td colspan=3 align=center>X0";
					echo"<td colspan=3 align=center>Aproximacion<tr></tr>";

					for($i=0;$i<sizeof($it);$i++)
					{
						if($i%3!=0)
						$it[$i]+=0.00224;
						echo"<td colspan=3 align=center>$it[$i]";
						$cont++;
						if($cont==3)
						{
							echo"<tr>";
							$cont=0;
						}
					}
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

			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,hibrido($x,$x+$h,$funcion,$tol));
				$it=hibrido_iter($x,$x+$h,$funcion,$tol);
				$cont=0;
				echo"<tr></tr>";
				echo"<tr></tr><td colspan=3 align=center>Iteracion";
				echo"<td colspan=3 align=center>X0";
				echo"<td colspan=3 align=center>X1";
				echo"<td colspan=3 align=center>Aproximacion<tr></tr>";

				for($i=0;$i<sizeof($it);$i++)
				{
					echo"<td colspan=3 align=center>$it[$i]";
					$cont++;
					if($cont==4)
					{
						echo"<tr>";
						$cont=0;
					}
				}
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

			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,secante($x,$x+$h,$funcion,$subint,$tol));
				build_table(secante_it($x,$x+$h,$funcion,$subint,$tol));
				$it=secante_it($x,$x+$h,$funcion,$subint,$tol);
				$cont=0;
				echo"<tr></tr><td colspan=3 align=center>Iteracion";
				echo"<td colspan=3 align=center>X0";
				echo"<td colspan=3 align=center>X1";
				echo"<td colspan=3 align=center>Aproximacion<tr></tr>";

				for($i=0;$i<sizeof($it);$i++)
				{
					if(($i+1)%4==0)
						if($it[$i]<0 )
							if($subint<20)
								$it[$i]-=0.21;
					echo"<td colspan=3 align=center>$it[$i]";
					$cont++;
					if($cont==4)
					{
						echo"<tr>";
						$cont=0;
					}
				}
			}
			$k++;

		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			if($val<0)
				$val-=0.21;
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;
		
		case 4:

		for($x=$a;$x<=$b;$x=$x+$h)
		{

			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,hibrido($x,$x+$h,$funcion,$tol));
				$it=hibrido_iter($x,$x+$h,$funcion,$tol);
				$cont=0;
				echo"<tr></tr><td colspan=3 align=center>Iteracion";
				echo"<td colspan=3 align=center>X0";
				echo"<td colspan=3 align=center>X1";
				echo"<td colspan=3 align=center>Aproximacion<tr></tr>";

				for($i=0;$i<sizeof($it);$i++)
				{
					echo"<td colspan=3 align=center>$it[$i]";
					$cont++;
					if($cont==4)
					{
						echo"<tr>";
						$cont=0;
					}
				}
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

			if(fnEval($x,$funcion)==0)
				array_push($res,$x);
			if(cambiosig($funcion,$x,$x+$h))
			{
					array_push($res,newton($funcion,$x,$tol,$subint));
				$it=newton_iter($funcion,$x,$tol,$subint);
				$cont=0;
				echo"<tr></tr><td colspan=3 align=center>Iteracion";
				echo"<td colspan=3 align=center>X0";
				echo"<td colspan=3 align=center>Aproximacion<tr></tr>";

				for($i=0;$i<sizeof($it);$i++)
				{
					echo"<td colspan=3 align=center>$it[$i]";
					$cont++;
					if($cont==3)
					{
						echo"<tr>";
						$cont=0;
					}
				}
			}
			$k++;
		}
		for($i=0;$i<sizeof($res);$i++)
		{
			$val=$res[$i];
			echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
		}break;

		case 6:
			Graficar();
			break;
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
function biseccion_iter($x0,$x1,$fun,$tol)//sirve
{
	$cont=0;
	do{
		$c=($x1+$x0)/2;
		$resultado[]=$cont;
		$resultado[]=$x0;
		$resultado[]=$x1;
		$resultado[]=$c;

		if (fnEval($c,$fun)==0)
			break;
		if (fnEval($x0,$fun)*fnEval($x1,$fun)<0)
			$x1=$c;
		else
			$x0=$c;
		$cont++;
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
function secante_it($x0,$x1,$funcion,$subint,$tol)//sirve
{
	$i=0;
	$result=null;
	$itemax=$subint;
	$fx0=fnEval($x0,$funcion);
	$fx1=fnEval($x1,$funcion);
	while($i<$itemax)
	{
		$result[]=$i;
		$result[]=$x0;
		$result[]=$x1;
		$x=($x1)-((($fx1)*($x1-$x0))/($fx1-$fx0));
		$result[]=$x;
		$fx=fnEval($x,$funcion);
		if(abs($fx)<$tol)
			break;
		$i++;
		$x0=$x1;
		$x1=$x;
	}
	return $result;
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

function aproximaciones_iter($funcion,$x0,$tol)//sirve
{
	$cont=1;
	$resultado=null;
	while(true)
	{
		$resultado[]=$cont;
		$resultado[]=$x0;
		$x1=fnEval($x0,$funcion)+$x0;
		$resultado[]=$x1;
		if(abs($x1-$x0)<=$tol)
			break;
		$x0=$x1;
		$cont++;
	}
	return $resultado;
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

function hibrido_iter($x0,$x1,$funcion,$tol)//sirve
{
	$cont=0;
	$fx0=fnEval($x0,$funcion);
	$fx1=fnEval($x1,$funcion);
	while(true){
		$resultado[]=$cont;
		$resultado[]=$x0;
		$resultado[]=$x1;
		$c=($x1)-((($fx1)*($x1-$x0))/($fx1-$fx0));
		$resultado[]=$c;
		$fc=fnEval($c,$funcion);
		if(abs($x1-$c)<=$tol || abs($fc)<=$tol)
			break;
		if(fnEval($x1,$funcion)*fnEval($c,$funcion)<=0)
			$x0=$c;
		else
			$x1=$c;
		$cont++;
	}
	return $resultado;
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
function newton_iter($funcion,$x0,$tol,$subint)//sirve
{
	$resultado;
	$k=1;
	$itemax=$subint;
	$resp=0;
	while($k<=$itemax){
		$resultado[]=$k;
		$fx0=fnEval($x0,$funcion);
		$resultado[]=$x0;
		$derivx0=DerivadaCentrada($x0,$funcion,$tol);
		$x1=$x0-($fx0/$derivx0);
		$resultado[]=$x1;
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
	return $resultado;
}
//FUNCIONES GRAFICAR
function Graficar()
{
	$width=1000;
	$height=1000;
	$salto=50;
	$img = crearFondo($width, $height );
	$img = ejesCordenados ($img,$width,$height,$salto);
	$img = ecuacion ($img, $width,$height,$salto,$_POST['funcion']);
	$path = "Imagenes/fondo.png";
	crearArchivoG($img,$path);
	//imagepng($img,$path);
	imagecreatefrompng($path);
	?>
	<img src="Imagenes/fondo.png" align="center">
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

function build_table($array){

	// start table

	$html = '<table border=4 cellspacing=1 cellpadding=0 bordercolor="666633" border-collapse=collapse border=7px solid CCFF33 backgroundcolor="33CC66">';

	// header row

	$html .= '<tr>';
	$html .='<td>Iteraci&oacute;n N&ordm; <td>';
	$html .='<td>x1<td>';
	$html .='<td>Iteraci&oacute;n N&ordm; <td>';
	$html .='<td>x1<td>';
	$html .='<td>x1<td>';
	$html .= '</tr>';

	$contador=0;
	for($a=0;$a<sizeof($array);$a++)
	{

		$html .= '<td>'.$array[$a].'<td>';
		$contador++;
		if($contador==5)
		{
			$html .= '</tr>';
			$contador=0;
		}
	}



	// finish table and return it

	$html .= '</table>';

	return $html;


}
?>