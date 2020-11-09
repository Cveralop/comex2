<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//Conexion base de datos en azure

/*$hostname_comercioexterior = 'comexdb.mysql.database.azure.com';
$database_comercioexterior = 'comercioexterior';
$username_comercioexterior = 'adminxms@comexdb';
$password_comercioexterior = 'Manquehue01..';

$comercioexterior = new mysqli($hostname_comercioexterior, $username_comercioexterior,$password_comercioexterior,
$database_comercioexterior);

// Check connection
if ($comercioexterior->connect_error) {
    die("Connection failed: " . $comercioexterior->connect_error);
  }
*/?>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//conexion base de datos Local
$hostname_comercioexterior = 'localhost';
$database_comercioexterior = 'comercioexterior';
$username_comercioexterior = 'root';
$password_comercioexterior = '';

$comercioexterior = new mysqli($hostname_comercioexterior, $username_comercioexterior,$password_comercioexterior,
$database_comercioexterior);

// Check connection
if ($comercioexterior->connect_error) {
    die("Connection failed: " . $comercioexterior->connect_error);
  }
?>