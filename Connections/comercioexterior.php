<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_comercioexterior = "localhost";
$database_comercioexterior = "comercioexterior";
$username_comercioexterior = "root";
//$password_comercioexterior = "sss123";
$password_comercioexterior = "";

$comercioexterior = new mysqli($hostname_comercioexterior, $username_comercioexterior,$password_comercioexterior,
$database_comercioexterior);

// Check connection
if ($comercioexterior->connect_error) {
    die("Connection failed: " . $comercioexterior->connect_error);
  }
  //echo "Connected successfully comercio exterior";


//conexion antigua
//$comercioexterior = mysql_pconnect($hostname_comercioexterior, $username_comercioexterior, $password_comercioexterior) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>