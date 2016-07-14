<?php
//if(isset($_POST['add'])) {
    $dbhost = 'mysql.smartfreehosting.net';
    $dbuser = 'u766223154_andr';
    $dbpass = 'andys2a';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);

    if(! $conn ) {
        die('Could not connect: ' . mysql_error());
    }


    if(! get_magic_quotes_gpc() ) {

        $emp_address = addslashes ($_POST['Message']);
    }else {

        $emp_address = $_POST['Message'];
    }



    $sql = "INSERT INTO preguntas ". "(quest) ". "VALUES('$emp_address')";

    mysql_select_db('u766223154_preg');
    $retval = mysql_query( $sql, $conn );

    if(! $retval ) {
        die('Could not enter data: ' . mysql_error());
    }

    echo "Su pregunta se ha realizado correctamente. Gracias\n";

    mysql_close($conn);
//}
