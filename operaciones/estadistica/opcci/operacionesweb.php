<?php require_once('../../../Connections/comercioexterior.php'); ?>
<?php
session_start();
$MM_authorizedUsers = "ADM,SUP";
$MM_donotCheckaccess = "false";
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 
  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
$MM_restrictGoTo = "../../estadistica/erroracceso.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php

$colname2_flujo = "Si";
if (isset($_GET['via_web'])) {
  $colname2_flujo = $_GET['via_web'];
}
$colname1_flujo = "Cursada.";
if (isset($_GET['estado'])) {
  $colname1_flujo = $_GET['estado'];
}
$colname_flujo = "zzz";
if (isset($_GET['date_curse'])) {
  $colname_flujo = $_GET['date_curse'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_flujo = sprintf("SELECT * FROM opcci nolock WHERE fecha_curse LIKE '%%%s%%' and estado = '%s' and via_web = '%s'", $colname_flujo,$colname1_flujo,$colname2_flujo);
$flujo = mysqli_query($comercioexterior, $query_flujo) or die(mysqli_error());
$row_flujo = mysqli_fetch_assoc($flujo);
$totalRows_flujo = mysqli_num_rows($flujo);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="shortcut icon" href="../../../imagenes/barraweb/favicon.ico">
<link rel="icon" type="image/gif" href="../../../imagenes/barraweb/animated_favicon1.gif">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Operaciones WEB</title>
<style type="text/css">
<!--
@import url("../../../estilos/estilo12.css");
.Estilo1 {font-size: 18px;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo2 {font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000FF;
}
body {
	background-image: url(../../../imagenes/JPEG/edificio_corporativo.jpg);
}
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FF0000;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
.Estilo3 {
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo8 {font-size: 10px}
.Estilo9 {font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo10 {font-size: 10px; font-weight: bold; }
.Estilo11 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo14 {color: #00FF00}
-->
</style>
<script> 
var segundos=1200
var direccion='http://pdpto38:8303/comex/index.php' 
milisegundos=segundos*1000 
window.setTimeout("window.location.replace(direccion);",milisegundos); 
</script> 
</head>
<body onLoad="MM_preloadImages('../../../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr>
    <td width="93%" align="left" valign="middle" bgcolor="#FF0000"><span class="Estilo1">OPERACIONES WEB </span></td>
    <td width="7%" rowspan="2" align="left" valign="middle" bgcolor="#FF0000"><img src="../../../imagenes/GIF/erde016.gif" width="43" height="43"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" bgcolor="#FF0000"><span class="subtitulopaguina">CARTA DE CR&Eacute;DITO DE IMPORTACI&Oacute;N</span></td>
  </tr>
</table>
<br>
<form name="form1" method="get" action="">
  <table width="95%"  border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr bgcolor="#999999">
      <td colspan="2" align="left" valign="middle"><img src="../../../imagenes/GIF/notepad.gif" width="19" height="21"><span class="Estilo3">Operaciones WEB</span></td>
    </tr>
    <tr>
      <td width="21%" align="right" valign="middle">Fecha Curse:</td>
      <td width="79%" align="left" valign="middle"><input name="date_curse" type="text" class="etiqueta12" id="date_curse" value="<?php echo date("Y-m-d"); ?>" size="12" maxlength="10">
        <span class="rojopequeno">(dd-mm-aaaa)</span></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle">
        <input name="Submit" type="submit" class="boton" value="Buscar">
        <input name="Submit" type="submit" class="boton" value="Limpiar"></td>
    </tr>
  </table>
</form>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="../../estadistica/estadistica.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image2" width="80" height="25" border="0"></a></div></td>
  </tr>
</table>
<br>
<?php if ($totalRows_flujo > 0) { // Show if recordset not empty ?>
<table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#999999">
    <td><span class="Estilo11">Nombre Cliente</span></td>
    <td class="titulocolumnas">Especialista</div></td>
    <td><span class="Estilo9">Segmento</span></td>
    <td><span class="Estilo9">Evento</span></td>
  </tr>
  <?php do { ?>
  <tr align="center" valign="middle">
    <td><strong class="respuestacolumna"><?php echo strtoupper($row_flujo['nombre_cliente']); ?></strong></div></td>
    <td><span class="respuestacolumna"><?php echo strtoupper($row_flujo['especialista']); ?> </span></td>
    <td><span class="respuestacolumna"><?php echo $row_flujo['segmento']; ?></span></td>
    <td><span class="respuestacolumna"><?php echo $row_flujo['evento']; ?></span></td>
  </tr>
  <?php } while ($row_flujo = mysqli_fetch_assoc($flujo)); ?>
</table>
<?php } // Show if recordset not empty ?>
</body>
</html>
<?php
mysqli_free_result($flujo);
?>