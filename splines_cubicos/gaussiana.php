<?php
include 'class.gauss.php';
//$method = new Gauss($_GET['A']);
//$method->getGaussSolution();
$width=1000;
$height=1000;
$salto=50;
$parte_a_1;
$parte_a_2;
session_start();
$cont_pres=1;
$cont_pres_3=1;
$matriz=$_GET['A'];
$cont=count($matriz);
//comienzo parte a del método
$h_i=h_i($matriz);
for($i=1;$i<=count($h_i);$i++)
{
    $parte_a_1[$i][$cont_pres]=$h_i[$i+1];
}
$cont_pres++;
$sigma_i= sigma_i($matriz,$h_i);
for($i=1;$i<=count($sigma_i);$i++)
{
    $parte_a_1[$i][$cont_pres]=$sigma_i[$i+1];
}
$cont_pres++;
$lamnda_i= lamnda_i($h_i,$cont);
for($i=1;$i<=count($lamnda_i);$i++)
{
    $parte_a_2[$i][$cont_pres_3]=$lamnda_i[$i+1];
}
$cont_pres_3++;
$miu_i= miu_i($h_i,$cont);
for($i=1;$i<=count($miu_i);$i++)
{
    $parte_a_2[$i][$cont_pres_3]=$miu_i[$i+1];
}
$cont_pres_3++;
$d_i= d_i($sigma_i,$h_i,$cont);
for($i=1;$i<=count($d_i);$i++)
{
    $parte_a_2[$i][$cont_pres_3]=$d_i[$i+1];
}
$cont_pres_3++;
echo '<table border="1">';

    echo '<tr>';

        echo '<td>';
           echo '<p>'."h_i".'</p>';
        echo '</td>';
echo '<td>';
echo '<p>'."sig_i".'</p>';
echo '</td>';


    echo '</tr>';

echo '</table>';
echo '<style>table{margin-bottom:10px;} table tr td {width:40px;}</style>';
$mat_parte_a= new Gauss($parte_a_1);
$mat_parte_a->mostrarMatriz_2();
echo '<table border="1">';

echo '<tr>';


echo '<td>';
echo '<p>'."lam_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."miu_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."d_i".'</p>';
echo '</td>';

echo '</tr>';

echo '</table>';
echo '<style>table{margin-bottom:10px;} table tr td {width:40px;}</style>';
$mat_parte_a_2= new Gauss($parte_a_2);
$mat_parte_a_2->mostrarMatriz_2();
//print_r($parte_a);
//fin parte a del método
//comienzo de la parte b del método
echo ("MATRICES DEL SISTEMA DE ECUACIONES PARA CALCULAR M_i");
$matriz_m_i= new Gauss(crearmatriz($lamnda_i,$miu_i,$d_i));
$resp_matriz_m_i= $matriz_m_i->getGaussSolution();
$m_i=$resp_matriz_m_i;
//comienzo de la parte c del metodo
$cont_pres_1=1;
$parte_c;
$r_i= r_i($m_i,$h_i,$cont);
for($i=1;$i<=count($r_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$r_i[$i+1];
}
$cont_pres_1++;
$s_i= s_i($m_i,$h_i,$cont);
for($i=1;$i<=count($s_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$s_i[$i+1];
}
$cont_pres_1++;
$t_i= t_i($matriz,$m_i,$h_i);
for($i=1;$i<=count($t_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$t_i[$i+1];
}
$cont_pres_1++;
$u_i= u_i($matriz,$m_i,$h_i);
for($i=1;$i<=count($u_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$u_i[$i+1];
}
$cont_pres_1++;
$v_i= v_i($s_i,$r_i,$cont);
for($i=1;$i<=count($v_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$v_i[$i+1];
}
$cont_pres_1++;
$w_i= w_i($s_i,$r_i,$matriz);
for($i=1;$i<=count($w_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$w_i[$i+1];
}
$cont_pres_1++;
$f_i= f_i($s_i,$matriz,$u_i,$t_i,$r_i);
for($i=1;$i<=count($f_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$f_i[$i+1];
}
$cont_pres_1++;
$g_i= g_i($r_i,$matriz,$t_i,$s_i,$u_i);
for($i=1;$i<=count($g_i);$i++)
{
    $parte_c[$i][$cont_pres_1]=$g_i[$i+1];
}
$cont_pres_1++;

echo '<table border="1">';

echo '<tr>';

echo '<td>';
echo '<p>'."r_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."s_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."t_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."u_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."v_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."w_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."f_i".'</p>';
echo '</td>';
echo '<td>';
echo '<p>'."g_i".'</p>';
echo '</td>';

echo '</tr>';

echo '</table>';
echo '<style>table{margin-bottom:10px;} table tr td {width:40px;}</style>';
$mat_parte_c= new Gauss($parte_c);
$mat_parte_c->mostrarMatriz_2();
$_SESSION['poli_i']= armar_poli_presentar($v_i,$w_i,$f_i,$g_i,$cont);
echo ("POLINOMIOS:");
echo '<table1 border="1">';
for($i = 2; $i <= count($_SESSION['poli_i'])+1; $i++ ){
    echo '<tr>';

        echo '<td>';
            echo '<p>'."P".$i."=".$_SESSION['poli_i'][$i].'</p>';
        echo '</td>';

    echo '</tr>';
}
echo '</table1>';

$_SESSION['poli_graf_i']= armar_poli_calcular($v_i,$w_i,$f_i,$g_i,$cont);

function h_i( $matriz)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=$matriz[$i][1]-$matriz[$i-1][1];
    }
    return $resp;
}
function sigma_i($matriz,$h_i)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=($matriz[$i][2]-$matriz[$i-1][2])/$h_i[$i];
    }
    return $resp;
}
function lamnda_i($h_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont-1;$i++)
    {
        $resp[$i]=$h_i[$i+1]/($h_i[$i]+$h_i[$i+1]);
    }
    return $resp;
}
function miu_i($h_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont-1;$i++)
    {
        $resp[$i]=$h_i[$i]/($h_i[$i]+$h_i[$i+1]);
    }
    return $resp;
}
function d_i($sigma_i,$h_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont-1;$i++)
    {
        $resp[$i]=(6*($sigma_i[$i+1]-$sigma_i[$i]))/($h_i[$i]+$h_i[$i+1]);
    }
    return $resp;
}
function armar_matriz($lamnda_i,$miu_i,$d_i)
{
    $matriz[1][1]=2;
    $matriz[1][2]=$lamnda_i[2];
    $matriz[1][3]=0;
    $matriz[1][4]=$d_i[2];
    $matriz[2][1]=$miu_i[3];
    $matriz[2][2]=2;
    $matriz[2][3]=$lamnda_i[3];
    $matriz[2][4]=$d_i[3];
    $matriz[3][1]=0;
    $matriz[3][2]=$miu_i[4];
    $matriz[3][3]=2;
    $matriz[3][4]=$d_i[4];
    return $matriz;
}
function crearmatriz($lamnda_i, $miu_i,$d_i)
{
    $lam=$lamnda_i;
    $ui=$miu_i;
    $di=$d_i;
    $num=count($di);
    $matriz=array(array());

    for($i=1;$i<=$num;$i++)
    {
        for($j=1;$j<=$num;$j++)
            $matriz[$i][$j]=0;
    }
    for($i=1;$i<=$num-1;$i++)
        $matriz[$i][$i+1]=$lam[$i];

    for($i=1;$i<=$num;$i++)
        $matriz[$i][$i]=2;

    for($i=2;$i<=$num;$i++)
    {
        $matriz[$i][$i-1]=$ui[$i];
    }
    return $matriz;
}
function r_i($m_i,$h_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont;$i++)
    {
        $resp[$i]=$m_i[$i-1]/(6*$h_i[$i]);
    }
    return $resp;
}
function s_i($m_i,$h_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont;$i++)
    {
        $resp[$i]=$m_i[$i]/(6*$h_i[$i]);
    }
    return $resp;
}
function t_i($matriz,$m_i,$h_i)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=($matriz[$i-1][2]-($m_i[$i-1]*(($h_i[$i]*$h_i[$i])/6)))/($h_i[$i]);
    }
    return $resp;
}
function u_i($matriz,$m_i,$h_i)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=($matriz[$i][2]-($m_i[$i]*(($h_i[$i]*$h_i[$i])/6)))/($h_i[$i]);
    }
    return $resp;
}
function v_i($s_i,$r_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont;$i++)
    {
        $resp[$i]=$s_i[$i]-$r_i[$i];
    }
    return $resp;
}
function w_i($s_i,$r_i,$matriz)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=3*(($r_i[$i]*$matriz[$i][1])-($s_i[$i]*$matriz[$i-1][1]));
    }
    return $resp;
}
function f_i($s_i,$matriz,$u_i,$t_i,$r_i)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=(3*(($s_i[$i]*$matriz[$i-1][1]*$matriz[$i-1][1])-($r_i[$i]*$matriz[$i][1]*$matriz[$i][1])))+$u_i[$i]-$t_i[$i];
    }
    return $resp;
}
function g_i($r_i,$matriz,$t_i,$s_i,$u_i)
{
    $resp=null;
    for($i=2;$i<=count($matriz);$i++)
    {
        $resp[$i]=($matriz[$i][1]*(($r_i[$i]*$matriz[$i][1]*$matriz[$i][1])+$t_i[$i]))-($matriz[$i-1][1]*(($s_i[$i]*$matriz[$i-1][1]*$matriz[$i-1][1])+$u_i[$i]));
    }
    return $resp;
}
function armar_poli_presentar($v_i,$w_i,$f_i,$g_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont;$i++)
    {
        $resp[$i]=$v_i[$i]."x^3";
        if($w_i[$i]<0)
            $resp[$i]=$resp[$i].$w_i[$i]."x^2";
        else
            $resp[$i]=$resp[$i]."+".$w_i[$i]."x^2";
        if($f_i[$i]<0)
            $resp[$i]=$resp[$i].$f_i[$i]."x";
        else
            $resp[$i]=$resp[$i]."+".$f_i[$i]."x";
        if($g_i[$i]<0)
            $resp[$i]=$resp[$i].$g_i[$i];
        else
            $resp[$i]=$resp[$i]."+".$g_i[$i];
    }
    return $resp;
}
function armar_poli_calcular($v_i,$w_i,$f_i,$g_i,$cont)
{
    $resp=null;
    for($i=2;$i<=$cont;$i++)
    {
        $resp[$i]=$v_i[$i]."*x*x*x";
        if($w_i[$i]<0)
            $resp[$i]=$resp[$i].$w_i[$i]."*x*x";
        else
            $resp[$i]=$resp[$i]."+".$w_i[$i]."*x*x";
        if($f_i[$i]<0)
            $resp[$i]=$resp[$i].$f_i[$i]."*x";
        else
            $resp[$i]=$resp[$i]."+".$f_i[$i]."*x";
        if($g_i[$i]<0)
            $resp[$i]=$resp[$i].$g_i[$i];
        else
            $resp[$i]=$resp[$i]."+".$g_i[$i];
    }
    return $resp;
}

?>
<form action="Grafico.php" method="get">
    <table>

        <tr>
            <td colspan="2">
                <p><input type="submit" value=" GRAFICAR POLINOMIOS "></p>
            </td>
        </tr>
    </table>
