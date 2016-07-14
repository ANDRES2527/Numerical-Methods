<?php
	function graficar($width,$height,$salto,$funcion)
	{
		$img=imagecreatetruecolor($width, $height);
		$color1=imagecolorallocate($img, 0, 0, 0);
		$color2=imagecolorallocate($img, 255, 255, 255);
		imagefill($img, 0, 0, $color2);
		$img= ejescordenados($img,$width,$height,$salto);
		$img= ecuacion($img,$width,$height,$salto,$funcion);
		imagepng($img,"ejedecordenadas.png");
		imagedestroy($img);

	}
	function ejescordenados($img,$ancho,$alto,$salto)
	{
		$color1=imagecolorallocate($img, 0, 0, 0);
		$color2=imagecolorallocate($img, 255, 255, 255);
		$gris=imagecolorallocatealpha($img, 0, 0, 0, 80);
		imagefill($img, 0, 0, $color2);
		imageline($img, 0, $ancho/2, $alto, $ancho/2, $color1);
		imageline($img, $ancho/2, 0, $alto/2, $alto, $color1);
		$n=($ancho/2)/$salto;
		$m=(($alto/2)/$salto)*-1;
		for($i=0;$i<$alto;$i++)
		if($i%$salto==0)
		{
			imageline($img, ($alto/2)-1, $i, ($alto/2)+2, $i, $color1);
			imageline($img, 0, $i, $ancho, $i, $gris);
			imageline($img, $i, ($alto/2)-1, $i, ($alto/2)+2, $color1);
			imageline($img, $i, 0, $i, $alto, $gris);
			imagestring($img, 1, $i-6, ($alto/2)-10, $m, $color1);
			imagestring($img, 1, ($alto/2)+6, $i-4, $n, $color1);
			$n--;
			$m++;
		}
		return $img;

	}
	function ecuacion($img,$ancho,$alto,$salto,$funcion)
	{
		$ancho=($ancho/2)*-1;
		$alto=$alto/2;
		$color=imagecolorallocate($img, 21, 252, 10);
		for($x=$ancho;$x<$alto;$x+=0.001)
		{
			$y=fnEval($x,$funcion);
			imagesetpixel($img, ($x*$salto)+$alto, $alto-($y*$salto),$color);
		}
		return $img;
	}
	function fnEval($x,$funcion)
	{
		$resultado=0;
		$funcion=str_replace("x", "(".$x.")", $funcion);
		echo $funcion;
		eval("\$resultado=".$funcion.";");
		return $resultado;
	}
	function diferencias_centrales($x,$difx,$e,$funcion)
	{	$diferencials=111;$Lsiguiente=0;$Lanterior=0;$f1=0;$f2=0;
		$contador=0;
		while ($diferencials>$e) 
		{
			$f1=fnEval($x+$difx,$funcion);
			$f2=fnEval($x-$difx,$funcion);
			if($difx==0)continue;
			$Lanterior=($f1-$f2)/(2*$difx);
			$diferencials=($Lsiguiente-$Lanterior)/$Lanterior;
			if($diferencials<0)$diferencials=0-$diferencials;
			$Lsiguiente=$Lanterior;
			$difx=($difx-1)/2;	
			$contador++;		
		}
		echo "M&eacute;todo de Diferencias centrales:";
		echo "<br/>";
		echo "El contador es:".$contador."";
		echo "<br/>";
		echo "El resultado es: ".$Lsiguiente;
	}
	function diferencias_avanzadas($x,$difx,$e,$funcion)
	{	$diferencials=111;$Lsiguiente=0;$Lanterior=0;$f1=0;$f2=0;
		$contador=0;
		while ($diferencials>$e) 
		{
			$f1=fnEval($x+$difx,$funcion);
			$f2=fnEval($x,$funcion);
			if($difx==0)continue;
			$Lanterior=($f1-$f2)/($difx);
			$diferencials=($Lsiguiente-$Lanterior)/$Lanterior;
			if($diferencials<0)$diferencials=0-$diferencials;
			$Lsiguiente=$Lanterior;
			$difx=($difx-1)/2;	
			$contador++;		
		}
		echo "M&eacute;todo de Diferencias avanzadas:";
		echo "<br/>";
		echo "El contador es:".$contador."";
		echo "<br/>";
		echo "El resultado es: ".$Lsiguiente;
	}
	function diferencias_retrazadas($x,$difx,$e,$funcion)
	{	$diferencials=111;$Lsiguiente=0;$Lanterior=0;$f1=0;$f2=0;
		$contador=0;
		while ($diferencials>$e) 
		{
			$f1=fnEval($x,$funcion);
			$f2=fnEval($x-$difx,$funcion);
			if($difx==0)continue;
			$Lanterior=($f1-$f2)/($difx);
			$diferencials=($Lsiguiente-$Lanterior)/$Lanterior;
			if($diferencials<0)$diferencials=0-$diferencials;
			$Lsiguiente=$Lanterior;
			$difx=($difx-1)/2;	
			$contador++;		
		}
		echo "M&eacute;todo de Diferencias retrazadas:";
		echo "<br/>";
		echo "El contador es:".$contador."";
		echo "<br/>";
		echo "El resultado es: ".$Lsiguiente;
	}
	function metodo_trapecio($funcion,$a,$b,$tolerancia)//aqui se busca el valor de ns necesarios y se ocupa la otra formula
	{
		$contador=0;
		$val_anterior=0;
		$val=0;
		while (true) 
		{

			$val=metodo_trapecio_formula($funcion,$a,$b,$contador+1);
			if($contador!=0&&(abs($val_anterior-$val)<=pow(10, -10))||$contador>100)
			break;
			$contador++;
			$val_anterior=$val;
			//echo"<br />".$contador.") ".$val_anterior;
		}
		echo "<br/>El valor del area por el metodo del trapecio es:  ";echo $val;
	}
	function metodo_trapecio_formula($funcion,$a,$b,$n)
	{
		$h=($b-$a)/$n;//encuentras el valor de h
		//este como todos los metodos numericos se componen de la suma de segmentos de la funcion
		$i=1;
		$suma=(fnEval($a,$funcion)+fnEval($b,$funcion))/2;//Se suma F(X0)-->a y F(Xn)---> b sobre 2 ambas
		for($i=1;$i<$n;$i++)
		{
			$suma=$suma+(fnEval(($a+($h*($i))),$funcion));//en esta parte se suma los valores de F(X) hasta llegar a n 
			//por ejemplo si n es 6, se suma (F(X1))+(F(X2))+(F(X3))+(F(X4))+(F(X5))
		}
		$suma=($suma)*$h;
		return $suma;
	
	}
	function metodo_simpson($a,$b,$funcion,$tolerancia)//aqui se busca el valor de ns necesarios y se ocupa la otra formula 
	{
		$contador=0;
		$val_anterior=0;
		$val=0;
		while (true) 
		{

			$val=metodo_simpson_formula($a,$b,$contador+1,$funcion);
			if($contador!=0&&(abs($val_anterior-$val)<=pow(10, -5))||$contador>2000)
			break;
			$contador++;
			$val_anterior=$val;
			echo"<br />".$contador.") ".$val_anterior;
		}
		echo "<br/>El valor del area es:  ";echo $val;
	}
	function metodo_simpson_formula($a,$b,$n,$funcion)
	{
		$h=($b-$a)/$n;//encuentras el valor de h
		//este como todos los metodos numericos se componen de la suma de segmentos de la funcion
		$i=1;
		$suma=fnEval($a,$funcion);+fnEval($b,$funcion);//Se suma F(X0)-->a y F(Xn)---> b
		for($i=1;$i<=($n/2);$i++)
		{
			$suma=$suma+4*(fnEval(($a+($h*((2*$i)-1))),$funcion));//en esta parte se suma los valores de Xinpares hasta llegar a n 
			//por ejemplo si n es 6, se suma 4(F(X1))+4(F(X3))+4(F(X5))
		}
		for($i=1;$i<=($n/2)-1;$i++)
		{
			$suma=$suma+2*(fnEval(($a+($h*((2*$i)))),$funcion));//en esta parte se suma los valores de Xpares hasta llegar a n 
			//por ejemplo si n es 6, se suma 2(F(X2))+2(F(X4))
		}
			
		$suma=($suma*$h)/3;//el final de la formula se multipica por h y se divide para 3(asi estaba en la formula)
		return $suma;
	}
?>