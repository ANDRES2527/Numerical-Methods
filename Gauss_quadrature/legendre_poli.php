<?php
/**
 * Created by PhpStorm.
 * User: EYSCORP
 * Date: 10/4/2016
 * Time: 10:15
 */
$n=8;
echo legendre_n($n);
$res=raices_hibrido(-1,1,legendre_n($n),0.0001);
$pesos= pesos($n,$res);

$x_is=x_is($n,$res,-10,10);
for($i=0;$i<sizeof($x_is);$i++)
{
    $val=$x_is[$i];
    echo  nl2br("\n");
    echo "<tr><td colspan=3 align=center>x_is $i= $val</td></tr>";
}
for($i=0;$i<sizeof($pesos);$i++)
{
    $val=$pesos[$i];
    echo  nl2br("\n");
    echo "<tr><td colspan=3 align=center>pesos $i= $val</td></tr>";
}
echo nl2br( "\n Integral=".Integral(-10,10,$x_is,$pesos,$n,"x*x*x-4*x"));



function legendre_n($n)
{
    $p_n_2="1";
    $p_n_1="x";
    $it=2;
    $pn="";
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
    for($i=0;$i<sizeof($res);$i++)
    {
        $val=$res[$i];
        echo  nl2br("\n");
        echo "<tr><td colspan=3 align=center>raiz $i= $val</td></tr>";
    }
    return $res;
}

function fnEval($x, $funcion)//sirve
{
    $resultado=0;
    $funcion= str_replace("x","(".$x.")" , $funcion);
    eval("\$resultado=".$funcion.";");
    return $resultado;

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