<?php 
//FUNCIONES PRINCIPALES

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

function fnEval($x, $funcion)
{
	$resultado=0;
	$funcion= str_replace("x","(".$x.")" , $funcion);
	eval("\$resultado=".$funcion.";");
	return $resultado;

}

function metodo_aproximaciones_sucesivas($a,$b,$funcion,$n)
{
	echo "<br/>---------  a= ".$a." b= ".$b." n= ".$n."<br/>";
	$h=($b-$a)/$n;
	for($i=1;$i<=$n;$i++)
	{	if(fnEval($a+($h*($i)),$funcion)!=0)
		$error=abs((fnEval($a+($h*($i-1)),$funcion)-fnEval($a+($h*$i),$funcion))/fnEval($a+($h*$i),$funcion));
	else echo "<br/>El cero encontrado es: ".($a+($h*($i)));
		if($error<pow(10,-5))
			echo "<br/>El cero encontrado es: ".($a+($h*($i-1)));
	}
}

function biseccion($a,$b,$fun,$tol)
{
	do{
		$c=($b+$a)/2;
		$resultado=$c;
		if (fnEval($c,$fun)==0)
			break;
		if (fnEval($a,$fun)*fnEval($c,$fun)<0)
			$b=$c;
		else
			$a=$c;
	}while(abs($a-$b)<$tol);
	return $resultado;
}

function biseccion_iteraciones($a,$b,$fun,$tol)
{
    $resultado;
	$contador=1;
	$xr_antiguo=0.0;
    $xr=0.0;
    $error_aproximado=100;
	//$resultado[]=$a;
	//$resultado[]=$b;
    while ($error_aproximado>$tol){
		$resultado[]=$contador;
		$resultado[]=$a;
		$resultado[]=$b;
        $xr_antiguo=$a;
        $xr=($a+$b)/2;
		
        if ($xr!=0.0){
            $error_aproximado=abs(($xr-$xr_antiguo)/$xr)*100;
            //echo "Valor numerico de la raiz: ",$xr," Error aproximado(%): ",$error_aproximado;
            $prueba=fnEval($a,$fun) *fnEval($xr,$fun);
            if ($prueba<0)
                $b=$xr;
				
            else
			{
                if ($prueba>0)
                    $a=$xr;
					
                else
                    $error_aproximado=0;
					
			}
			$contador++;
		}
		//$contador++;
		//$resultado[]=$contador;
		//$resultado[]=$a;
		//$resultado[]=$b;
		$resultado[]=$xr;
		$resultado[]=$error_aproximado;
	
	}
	
	return $resultado;
}

function secante($func,$a,$b,$tol)
{
	$k=1;
	$resultado;
	$xk=$b;
	$xk_1=$a;
	$fxk_1=fnEval($xk_1,$func);
	$fxk=fnEval($xk,$func);
	do {
		$xkm1 = $xk - ($fxk * ($xk - $xk_1) / ($fxk - $fxk_1));
		$fxkm1 = fnEval($xkm1, $func);
		if (abs($xkm1 - $xk) <= $tol || abs($fxkm1 < $tol)) {
			$resultado = $xkm1;
			return $resultado;
		}
		$k = $k + 1;
	}while(k<=40);
	if($resultado==null)
	{
		echo ("No converge supero el numero maximo de iteraciones");
	}

}

function derivada($x,$funcion,$valordelta,$tol, $dif)
{
$L=0;
	$deltainicial=$valordelta;
	$derivadanumerica1=0;
	do{	if ($L==0)
	{
		$derivadanumerica0=$derivadanumerica1;
		$derivadanumerica1=Diferencias($x,$funcion,$valordelta, $dif);
		$valordelta=$deltainicial/2;
		$L++;
	}
		$error=abs($derivadanumerica1-$derivadanumerica0);
		if ($L>=1)
		{	$derivadanumerica0=$derivadanumerica1;
			$derivadanumerica1=Diferencias($x,$funcion,$valordelta, $dif);
			$valordelta=$valordelta/2;
			$L++;
		}
		else
		{	if($error<$tol)
			break;
		}
	}while ($error>$tol);
	return $derivadanumerica1;

}

function newton($func,$deriv_analitica,$a,$tol)
{
	$k=1;
	$solucion;
	$xk;
	$xk_1=$a;
	do {
		$fxk_1 = fnEval($xk_1, $func);
		$fpxk_1 = fnEval($xk_1,$deriv_analitica);
		if (abs($fxk_1) < $tol) {
			$solucion = $xk_1;
			return $solucion;
		}
		if ($fpxk_1 == 0) {
			echo("Error 1: Derivada Nula");
			return null;
		}
		$xk = $xk_1 - ($fxk_1 / $fpxk_1);
		if (abs($xk - $xk_1) <= $tol) {
			$solucion = $xk;
			return $solucion;
		}
		$k = $k + 1;
		$xk_1=$xk;
	}while($k<=20);
	if($solucion==null)
	{
		echo ("No converge supero el numero maximo de iteraciones");
	}


}
function build_table($array){

    // start table

    $html = '<table border=4 cellspacing=1 cellpadding=0 bordercolor="666633" border-collapse=collapse border=7px solid CCFF33 backgroundcolor="33CC66">';

    // header row

    $html .= '<tr>';
	$html .='<td>Iteraci&oacute;n N&ordm; <td>';
	$html .='<td>x1<td>';
	$html .='<td>x2<td>';
	$html .='<td>Raiz aproximada<td>';
	$html .='<td>Error aproximado<td>';
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


}?>?>
