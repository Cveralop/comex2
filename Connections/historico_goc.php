<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//Conexion base de datos en azure
/*$hostname_historico_goc = 'comexdb.mysql.database.azure.com';
$database_historico_goc = 'comex_historico'; 
$username_historico_goc = 'adminxms@comexdb';
$password_historico_goc = 'Manquehue01..';

$historico_goc = new mysqli($hostname_historico_goc, $username_historico_goc, $password_historico_goc,
$database_historico_goc);

// Check connection
if ($historico_goc->connect_error) {
    die("Connection failed: " . $historico_goc->connect_error);
  }*/
?>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//conexion base de datos Local

$hostname_historico_goc = 'localhost';
$database_historico_goc = 'comex_historico'; 
$username_historico_goc = 'root';
$password_historico_goc = '';

$historico_goc = new mysqli($hostname_historico_goc, $username_historico_goc, $password_historico_goc,
$database_historico_goc);

// Check connection
if ($historico_goc->connect_error) {
    die("Connection failed: " . $historico_goc->connect_error);
  }
?>