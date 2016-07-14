<?php
include 'class.gauss.php';
$method = new Gauss($_GET['A']);
$method->getGaussSolution();
?>