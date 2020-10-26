<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_historico_goc = "localhost";
$database_historico_goc = "comex_historico";
$username_historico_goc = "root";
//$password_historico_goc = "sss123";
$password_historico_goc = "";

$historico_goc = new mysqli($hostname_historico_goc, $username_historico_goc, $password_historico_goc,
$database_historico_goc);

// Check connection
if ($historico_goc->connect_error) {
    die("Connection failed: " . $historico_goc->connect_error);
  }
  echo "Connected successfully HISTORICO_GOC";


//conexion antigua
//$historico_goc = mysql_pconnect($hostname_historico_goc, $username_historico_goc, $password_historico_goc) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>