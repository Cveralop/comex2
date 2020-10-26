<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_basecomercial = "localhost";
$database_basecomercial = "basecomercial";
$username_basecomercial = "root";
//$password_basecomercial = "sss123";
$password_basecomercial = "";

//conexion nueva
$basecomercial = new mysqli($hostname_basecomercial, $username_basecomercial, $password_basecomercial,
$database_basecomercial);

// Check connection
if ($basecomercial->connect_error) {
    die("Connection failed: " . $basecomercial->connect_error);
  }
  echo "Connected successfully BASE COMERCIAL";


//conexion antigua
//$basecomercial = mysql_pconnect($hostname_basecomercial, $username_basecomercial, $password_basecomercial) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>