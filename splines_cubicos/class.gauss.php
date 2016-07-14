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
//$this->mostrarMatriz();
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
//$this->mostrarMatriz();

}
}
    $this->mostrarMatriz();
    return $this->matriz;
}
/**
* Imprime la matriz en una tabla
* @param void
* @return void
*/
public function mostrarMatriz(){
echo '<table border="1">';
    for($i = 1; $i <= $this->filas; $i++ ){
    echo '<tr>';
        for($j = 1; $j <= $this->columnas; $j++ ){
        echo '<td>';
            if($j<=2&&$i<=4|| $i<=3&&$j<=5)
            echo '<p>'.round($this->matriz[$i][$j], 2).'</p>';
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
echo '<style>table{margin-bottom:10px;} table tr td {width:50px;}</style>';
}
    public function mostrarMatriz_2(){
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
        echo '<style>table{margin-bottom:10px;} table tr td {width:50px;}</style>';
    }
    public function Matriz_por($a){

        for($i = 1; $i <= $this->filas; $i++ ){

            for($j = 1; $j <= $this->columnas; $j++ ){
               $this->matriz[$i][$j]*=$a;
            }

        }

    }

    public function Matriz_igual_escalar($a){

        for($i = 1; $i <= $this->filas; $i++ ){

            for($j = 1; $j <= $this->columnas; $j++ ){
                $this->matriz[$i][$j]=$a;
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
}
?>