<?php
/**
 * Created by PhpStorm.
 * User: EYSCORP
 * Date: 20/5/2016
 * Time: 15:02
 */
 date_default_timezone_set('America/New_York');
 $email=$_POST['Email'];
 $num=$_POST['Phone'];
 $subject= $_POST['Subject'];
 $nomb=$_POST['Name'];
 $message= $_POST['Message']."  De:".$email."  Telefono:".$num." Nombre: ".$nomb;

 mail("amena172@puce.edu.ec", $subject, $message);
 echo "Email sent!";
?>