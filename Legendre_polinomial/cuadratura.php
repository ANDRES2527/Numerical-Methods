<html>
<head>
	   <title> CHAVACANO</title>
</head>
<body background="Imagenes/d.png">

<?php
$funcion=$_POST["funcion"];
$a=$_POST["a"];
$b=$_POST["b"];
$n=$_POST["n"];
$width=600;
$height=600;
$salto=50;
  $img = crearFondo($width, $height );
		$img = ejesCordenados ($img,$width,$height,$salto);
		$path = "Imagenes/fondo.png";
		$img = ecuacion ($img, $width,$height,$salto,$funcion,$a,$b);
		crearArchivoG($img,$path);






//ingreso los polinomios de larange


$mb;
$res=raices_hibrido(-1,1,legendre_n($n),0.0001);
$pesos= pesos($n,$res);
$x_is=x_is($n,$res,1,5);
echo "<table width='60%' div align='center' valing='middle' border='3' cellpadding='9' cellspacing='4'  bgcolor='F4FCFF'>";
echo "<tr>";
echo "<th>PESOS</th>";
echo "<th>RAICES POLINOMIO LEGENDRE</th>";
echo "<th>INTEGRALES</th>";
echo "</tr>";
for ($i=0; $i <$n ; $i++) 
{ 
	echo "<tr>";
	$mb[$i][0]=$pesos[$i];
	$mb[$i][1]=$res[$i];
	echo "<th>".$mb[$i][0]."</th><th>".$mb[$i][1]."</th><th>".$x_is[$i]."</th>";
    echo "</tr>";
}



$temp1=($b+$a);
$temp2=($b-$a);	
$nueva_funcion="(($temp1)+(($temp2)*x))/2";
$du_nuevafuncion=centradas(1,$nueva_funcion);
$fxu_temp=(remplaso($funcion,'x',$nueva_funcion));
$fxu="($fxu_temp) *$du_nuevafuncion";
echo "<tr><td colspan='3' align='center'>&nbsp;FUNCION:".$funcion."</td></tr>";

$valor=0;

		for ($i=0; $i < $n ; $i++)
		{ 
			$ci=$mb[$i][0];
	  		$fi=$mb[$i][1];
	  		$valor+=$ci*evaluado($fi,$fxu);
		}

echo "<tr><td colspan='3' align='center'>&nbsp;<h1>RESPUESTA ES: ".$valor."</h1></td></tr>";

echo "<tr><td colspan='3' align='center'>&nbsp;GRAFICO</td></tr>";

?>
    <tr><td colspan='3' align='center'><br><br><br><div align="center"><img src="Imagenes/fondo.png" alt="Texto alternativo"></div></td></tr>
<?php

function remplaso($funci,$donde,$remp)
{
	$funci=str_replace($donde,"(".$remp.")",$funci);
	return $funci;
}
function evaluado($x,$funci)
{
	$result=0;
	$funci=str_replace("x","(".$x.")",$funci);
    eval("\$result=".$funci.";");
    return $result;
}
function centradas($val,$funcion)
{

  $temp=0;
  $count=0;
	    $delta=0.1;
 do{
		

    $result=$val+$delta; 
    $result2=$val-$delta;
	$result4=evaluado($result,$funcion);
	$result5=evaluado($result2,$funcion);
	$result3=($result4-$result5)/(2*$delta);
	    
	if($count>0&&tolerancia($result3,$temp)<=0.000000001)
	{

		break;
	 }
	 else {  

	$count++;
	 $temp=$result3;
	 $delta=$delta/2;


	}
	//echo "<br>".$count.".-interacion es: ".$result3."<br>";
	}while(1);
	    return $result3;
}
function tolerancia($a,$b)
{
 if($b!=0){
	$result=$a-$b;
	$result1=$result/$b;

	 return $result1;
	}
	else
	{
		return 0;
	}
}
function crearArchivoG($img,$path)
{
	//Ej: $path = "Imagenes/fondo.png"
	imagepng ($img,$path); //crea un archivo png
	imagedestroy ($img); //Libera la memoria
}
function crearFondo($width, $height )
{
	$img = imagecreatetruecolor ($width, $height); //Crea la imagen
	$color1 = imagecolorallocate ($img , 255,200,200); //Define color negro
	$color2 = imagecolorallocate ($img , 10,60,30); //Define color blanco
	imagefill($img,$width,$height,$color2); //imagen, origen en x, origen en y, color
	return $img;}
function ejesCordenados ($img,$ancho,$alto,$salto)
{
	$color1 = imagecolorallocate ($img , 70,60,70); //Cargo de nuevo mi color
	$color2 = imagecolorallocate ($img , 240,240,240); //Cargo de nuevo mi color
	$gris = imagecolorallocatealpha($img, 156, 156, 156, 50); // Color de las lineas 
	imagefill ($img , 0,0 , $color1); //Rellena de un color la imagen
	for ($i=0; $i <4 ; $i++) { 
	imageline($img,0,(($ancho/2)-2)+$i,$alto,(($ancho/2)-2)+$i,$color2);//Lineas Horizontales
	}
	for ($i=0; $i <4 ; $i++) {
	imageline($img,(($ancho/2)-2)+$i,0,(($ancho/2)-2)+$i,$alto,$color2);//Lineas verticales
	}
	//Numeracion de ejes coordenados
	$n = (($alto/$salto)/2);
	$m = ($ancho/$salto)/2*(-1);
	for($i=0; $i<$alto;$i++)
		if ($i % $salto==0){
			imageline($img,($alto/2)-1,$i,($alto/2)+2,$i,$color2);//horizontal
			imageline($img,0,$i,$ancho,$i,$gris);//horizontal cuadricula
			imageline($img,$i,($alto/2)-1,$i,($alto/2)+2,$color2);//vertical
			imageline($img,$i,0,$i,$alto,$gris);//vertical cuadricula
			imagestring ($img, 3 , $i-6,15, $m , $color2);//horizontal
			imagestring ($img, 3 , $i-6,$ancho-20, $m , $color2);//horizontal
			imagestring ($img, 3 ,0, $i-4 , $n , $color2);//vertical
			imagestring ($img, 3 ,$ancho-20, $i-4 , $n , $color2);//vertical
			$n--;
			$m++;
		}
	return $img;}
function ecuacion ($img, $ancho,$alto,$salto,$funcion,$a,$b)
{
	$ancho=($ancho/2)*-1;
	$alto=$alto/2;
	$color = imagecolorallocate ($img , 255, 0, 0);
	$color1 = imagecolorallocate ($img , 50, 90, 100);
	for($x=$ancho;$x<$alto;$x+=0.01)
	{  

		$y= fnEval($x,$funcion);//(($x)*($x))-4; //Funcion matematica
		if($x>=$a&&$x<=$b)
		{
		 imageline($img,($x*$salto)+$alto,$alto,($x*$salto)+$alto,$alto-($y*$salto),$color1);
        }
        if(($y<=0)&&($x>=$a&&$x<=$b))
        {
		 imageline($img,($x*$salto)+$alto,$alto-($y*$salto),($x*$salto)+$alto,$alto,$color1);
        }	
		imagesetpixel ($img , ($x*$salto)+$alto,$alto-($y*$salto),$color ); //Manda a graficar la funcion
	}

       
	return $img;
}
function fnEval($x, $funcion)//sirve
{
    $resultado=0;
    $funcion= str_replace("x","(".$x.")" , $funcion);
    eval("\$resultado=".$funcion.";");
    return $resultado;
}
function legendre_n($n)
{
    $p_n_2="1";
    $p_n_1="x";
    $it=2;
    $pn="";
    if($n==0)
        return "1";
    if($n==1)
        return "x";
    while($it<=$n)
    {

        $pn="".(1/$it)."*(".((2*$it)-1)."*x"."*".$p_n_1."-".($it-1)."*".$p_n_2.")";

        $p_n_2=$p_n_1;

        $p_n_1=$pn;

        $it++;
    }
    return $pn;
}
function pesos_ra($n,$res)
{
    $it=0;
    $pes_ra=array();
    while($it<=$n)
    {
        $pes_ra[0][$it]=-2/(($n-1)*DerivadaCentrada($res[$it],legendre_n($n),0.00001)*fnEval($res[$it],legendre_n($n+1)));
        $pes_ra[1][$it]=$res[$it];
        $it++;
    }
    return $pes_ra;
}
function pesos($n,$res)
{
    $it=0;
    $pes=array();

    while($it<$n)
    {
        $pes[$it]=(-2)/(($n+1)*DerivadaCentrada($res[$it],legendre_n($n),0.00001)*fnEval($res[$it],legendre_n($n+1)));

        $it++;
    }
    return $pes;
}
function x_is($n,$res,$a,$b)
{
    $it=0;
    $x_is=array();
    while($it<$n)
    {
        $x_is[$it]=((($b-$a)/2)*$res[$it])+(($b+$a)/2);
        $it++;
    }
    return $x_is;
}
function Integral($a,$b,$x_is,$pes,$n,$funcion)
{
    $inte=0;
    $h=($b-$a)/2;
    $it=0;
    while($it<$n)
    {
        $inte+=fnEval($x_is[$it],$funcion)* $pes[$it];
        $it++;
    }
    return $h*$inte;
}
function DerivadaCentrada( $x, $funcion, $e)//sirve
{
    $result= 1;
    $l = 0;
    $vx = 0.0001;
    while(true)
    {
        $f1 = (fnEval($x + $vx, $funcion) - fnEval($x - $vx, $funcion)) / (2 * $vx);
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
function raices_hibrido($a,$b,$funcion,$tol)
{
    $h=($b-$a)/30;
    $res=array();
    for($x=$a;$x<=$b;$x=$x+$h)
    {

        if(fnEval($x,$funcion)==0)
        {
            array_push($res,$x);
           // echo ("si");
        }
        if(cambiosig($funcion,$x,$x+$h))
        {
           // echo ("si");
            array_push($res,hibrido($x,$x+$h,$funcion,$tol));
        }

    }
    return $res;
}

function cambiosig($funcion,$x0,$x1)//sirve
{
    $y1=fnEval($x0,$funcion);
    $y2=fnEval($x1,$funcion);
    //echo $x0.":".$x1.":".$y1.":".$y2."<br/>";
    if($y1*$y2<0)
        return true;
    return false;
}

?>
</body>
</html>