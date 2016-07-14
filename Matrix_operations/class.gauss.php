<?php
class Gauss {

private $filas;
private $columnas;
private $matriz;

/**
* Constructor. Establace la matriz a resolver, obtiene numero de filas y columnas.
* @param array matriz
* @return void
*/
public function __construct($m){
$this->matriz = $m;
$this->filas = count($m);
$this->columnas = count($m['1']);
}
/**
* Obtiene la solución de la matriz por el método de Gauss
* @param void
* @return void
*/
public function getGaussSolution(){
$this->mostrarMatriz();
for($x = 1; $x <= $this->filas; $x++){
$pivote = $this->matriz[$x][$x];
for($i = $x; $i <= $this->filas; $i++ ){
for($j = $x; $j <= $this->columnas; $j++ ){
if($i == $x) {
$this->matriz[$i][$j] /= $pivote;
continue;
} elseif($j == $x && $i != $x){
$aux = $this->matriz[$i][$j] * (-1);
}
$this->matriz[$i][$j] =	$this->matriz[$x][$j] * $aux + $this->matriz[$i][$j];
}
$this->mostrarMatriz();
}
}
for($x = 4; $x > 0; $x--){
//$pivote = $this->matriz[$x][$x];
for($i = $x-1; $i > 0; $i-- ){
for($j = $x; $j <= $this->columnas; $j++ ){
if($j == $x){
$aux = $this->matriz[$i][$j] * (-1);
}
    if($x<$this->columnas)
$this->matriz[$i][$j] =	$this->matriz[$x][$j] * $aux + $this->matriz[$i][$j];
}
$this->mostrarMatriz();
}
}
}
/**
* Imprime la matriz en una tabla
* @param void
* @return void
*/
private function mostrarMatriz(){
echo '<table border="1">';
    for($i = 1; $i <= $this->filas; $i++ ){
    echo '<tr>';
        for($j = 1; $j <= $this->columnas; $j++ ){
        echo '<td>';
            echo '<p>'.round($this->matriz[$i][$j], 2).'</p>';
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
echo '<style>table{margin-bottom:10px;} table tr td {width:20px;}</style>';
}


    public function Matriz_igual_escalar($a){

        for($i = 1; $i <= $this->filas; $i++ ){

            for($j = 1; $j <= $this->columnas; $j++ ){
                $this->matriz[$i][$j]=$a;
            }

        }

    }

    public function Matriz_por($a){

        for($i = 1; $i <= $this->filas; $i++ ){

            for($j = 1; $j <= $this->columnas; $j++ ){
                $this->matriz[$i][$j]*=$a;
            }

        }

    }
    public function Suma_matrices(Gauss $a){
        $resp=null;
        if($a->filas==$this->filas) {
            for ($i = 1; $i <= $this->filas; $i++) {

                for ($j = 1; $j <= $this->columnas; $j++) {
                    $resp[i][j]=$this->matriz[$i][$j] + $a->matriz[$i][$j];
                }

            }
        }
        else
        {
            echo ("NO SE PUEDEN SUMAR ESTAS MATRICES REVISE LOS INDICES!!");
        }

        return $resp;

    }

    public function Resta_matrices(Gauss $a){
        $resp=null;
        if($a->filas==$this->filas) {
            for ($i = 1; $i <= $this->filas; $i++) {

                for ($j = 1; $j <= $this->columnas; $j++) {
                    $resp[i][j]=$this->matriz[$i][$j] - $a->matriz[$i][$j];
                }

            }
        }
        else
        {
            echo ("NO SE PUEDEN RESTAR ESTAS MATRICES REVISE LOS INDICES!!");
        }

        return $resp;

    }

    public function Multip_matrices(Gauss $a){
        $resp=null;
        if($a->columnas==$this->filas) {
            for ($i = 1; $i <= $this->filas; $i++) {
                for ($j = 1; $j <= $this->columnas; $j++) {
                    $resp[$i][$j]=0;
                    for($k=1;$k<=$this->columnas;$k++)
                    $resp[i][j]+=$this->matriz[$i][$k] * $a->matriz[$i][$j];
                }

            }
        }
        else
        {
            echo ("NO SE PUEDEN RESTAR ESTAS MATRICES REVISE LOS INDICES!!");
        }

        return $resp;

    }

    public function Derivada_parcial_reemplazo($funcion,$respecto,$x,$xo,$c,$d,$alfa)
    {
        if($respecto=="alfa")
        {
            $funcion=str_replace("alfa","x",$funcion);
            $funcion=str_replace("x","(".$x.")",$funcion);
            $funcion=str_replace("xo","(".$xo.")",$funcion);
            $funcion=str_replace("c","(".$c.")",$funcion);
            $funcion=str_replace("d","(".$d.")",$funcion);
        }
        elseif($respecto=="c")
        {
            $funcion=str_replace("c","x",$funcion);
            $funcion=str_replace("x","(".$x.")",$funcion);
            $funcion=str_replace("xo","(".$xo.")",$funcion);
            $funcion=str_replace("alfa","(".$alfa.")",$funcion);
            $funcion=str_replace("d","(".$d.")",$funcion);
        }
        elseif($respecto=="d")
        {
            $funcion=str_replace("d","x",$funcion);
            $funcion=str_replace("x","(".$x.")",$funcion);
            $funcion=str_replace("xo","(".$xo.")",$funcion);
            $funcion=str_replace("alfa","(".$alfa.")",$funcion);
            $funcion=str_replace("c","(".$c.")",$funcion);
        }
        return $funcion;
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
}
function evaluado($x,$funci)
{
    $result=0;
    $funci=str_replace("x","(".$x.")",$funci);
    eval("\$result=".$funci.";");
    return $result;
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

?>