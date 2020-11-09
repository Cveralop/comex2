<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_historico_goc = 'comexdb.mysql.database.azure.com';
$database_historico_goc = 'comex_historico'; 
$username_historico_goc = 'adminxms@comexdb';
$password_historico_goc = 'Manquehue01..';

$historico_goc = new mysqli($hostname_historico_goc, $username_historico_goc, $password_historico_goc,
$database_historico_goc);

// Check connection
if ($historico_goc->connect_error) {
    die("Connection failed: " . $historico_goc->connect_error);
  }
<<<<<<< HEAD
=======
  //echo "Connected successfully HISTORICO_GOC";

//conexion antigua
//$historico_goc = mysql_pconnect($hostname_historico_goc, $username_historico_goc, $password_historico_goc) or trigger_error(mysqli_error(),E_USER_ERROR); 
>>>>>>> cc43cb9b29c7362fb6e2ca584b11642ba1d0b55c
?>