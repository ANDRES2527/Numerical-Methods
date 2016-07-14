<?php
/**
 * Created by PhpStorm.
 * User: EYSCORP
 * Date: 24/4/2016
 * Time: 22:29
 */
session_start();
set_time_limit(1000);
$width=1000;
$height=1000;
$salto=50;
$funciones= $_SESSION['poli_graf_i'];
echo($funciones[2]);
$img = crearFondo($width, $height );
$img = ejesCordenados ($img,$width,$height,$salto);
$img = ecuacion ($img, $width,$height,$salto,$funciones[2],$funciones[3],$funciones[4],$funciones[5]);
$path = "fondo.png";
crearArchivoG($img,$path);

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

function ecuacion ($img, $ancho,$alto,$salto,$funcion1,$funcion2,$funcion3,$funcion4){
    $ancho=($ancho/2)*-1;
    $alto=$alto/2;
    $color = imagecolorallocate ($img , 0, 255, 0);
    $color1 = imagecolorallocate ($img , 255, 0, 0);
    $color2 = imagecolorallocate ($img , 0, 0, 255);
    for($x=$ancho;$x<$alto;$x+=0.001){
        $y= fnEval($x,$funcion1);//(($x)*($x))-4; //Funcion matematica
        imagesetpixel ($img , ($x*$salto)+$alto,$alto-($y*$salto),$color ); //Manda a graficar la funcion
    }
    for($x=$ancho;$x<$alto;$x+=0.001){
        $y= fnEval($x,$funcion2);//(($x)*($x))-4; //Funcion matematica
        imagesetpixel ($img , ($x*$salto)+$alto,$alto-($y*$salto),$color1 ); //Manda a graficar la funcion
    }
    for($x=$ancho;$x<$alto;$x+=0.001){
        $y= fnEval($x,$funcion3);//(($x)*($x))-4; //Funcion matematica
        imagesetpixel ($img , ($x*$salto)+$alto,$alto-($y*$salto),$color2 ); //Manda a graficar la funcion
    }
    for($x=$ancho;$x<$alto;$x+=0.001){
        $y= fnEval($x,$funcion4);//(($x)*($x))-4; //Funcion matematica
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