<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_comercioexterior = 'comexdb.mysql.database.azure.com';
$database_comercioexterior = "comercioexterior";
$username_comercioexterior = 'adminxms@comexdb';
$password_comercioexterior = 'Manquehue01..';

$comercioexterior = new mysqli($hostname_comercioexterior, $username_comercioexterior,$password_comercioexterior,
$database_comercioexterior);

// Check connection
if ($comercioexterior->connect_error) {
    die("Connection failed: " . $comercioexterior->connect_error);
  }
  ?>