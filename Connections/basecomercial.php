<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//Conexion base de datos en azure
/*$hostname_basecomercial = 'comexdb.mysql.database.azure.com';
$database_basecomercial = "basecomercial";
$username_basecomercial = 'adminxms@comexdb';
$password_basecomercial = 'Manquehue01..';

//conexion nueva
$basecomercial = new mysqli($hostname_basecomercial, $username_basecomercial, $password_basecomercial,
$database_basecomercial);

// Check connection
if ($basecomercial->connect_error) {
    die("Connection failed: " . $basecomercial->connect_error);
  }*/
?>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//conexion base de datos Local
$hostname_basecomercial = 'localhost';
$database_basecomercial = 'basecomercial';
$username_basecomercial = 'root';
$password_basecomercial = '';

//conexion nueva
$basecomercial = new mysqli($hostname_basecomercial, $username_basecomercial, $password_basecomercial,
$database_basecomercial);

// Check connection
if ($basecomercial->connect_error) {
    die("Connection failed: " . $basecomercial->connect_error);
  }
?>