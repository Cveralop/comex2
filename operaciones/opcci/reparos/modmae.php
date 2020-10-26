<?php require_once('../../../Connections/comercioexterior.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "ADM,SUP,OPE";
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
$MM_restrictGoTo = "../erroracceso.php";
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
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  global $comercioexterior;

  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($comercioexterior, $theValue) : mysqli_escape_string($comercioexterior, $theValue);
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_modrep = 10;
$pageNum_modrep = 0;
if (isset($_GET['pageNum_modrep'])) {
  $pageNum_modrep = $_GET['pageNum_modrep'];
}
$startRow_modrep = $pageNum_modrep * $maxRows_modrep;
$colname2_modrep = "zzz";
if (isset($_GET['nro_operacion'])) {
  $colname2_modrep = $_GET['nro_operacion'];
}
$colname1_modrep = "xxx";
if (isset($_GET['rut_cliente'])) {
  $colname1_modrep = $_GET['rut_cliente'];
}
$colname_modrep = "1";
if (isset($_GET['id'])) {
  $colname_modrep = $_GET['id'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_modrep = sprintf("SELECT * FROM opcci WHERE id LIKE %s and rut_cliente LIKE %s and nro_operacion LIKE %s and sub_estado = 'Reparada.' ORDER BY id DESC", GetSQLValueString($colname_modrep . "%", "text"),GetSQLValueString($colname1_modrep . "%", "text"),GetSQLValueString($colname2_modrep . "%", "text"));
$query_limit_modrep = sprintf("%s LIMIT %d, %d", $query_modrep, $startRow_modrep, $maxRows_modrep);
$modrep = mysqli_query($comercioexterior, $query_limit_modrep) or die(mysqli_error());
$row_modrep = mysqli_fetch_assoc($modrep);
if (isset($_GET['totalRows_modrep'])) {
  $totalRows_modrep = $_GET['totalRows_modrep'];
} else {
  $all_modrep = mysqli_query($comercioexterior, $query_modrep);
  $totalRows_modrep = mysqli_num_rows($all_modrep);
}
$totalPages_modrep = ceil($totalRows_modrep/$maxRows_modrep)-1;
$queryString_modrep = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_modrep") == false && 
        stristr($param, "totalRows_modrep") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_modrep = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_modrep = sprintf("&totalRows_modrep=%d%s", $totalRows_modrep, $queryString_modrep);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Ingreso o Modificaci&oacute;n Reparo - Maestro</title>
<style type="text/css">
<!--
@import url("../../../estilos/estilo12.css");
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
.Estilo3 {font-size: 18px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo4 {font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo5 {
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo7 {color: #FFFFFF; font-weight: bold; }
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<script> 
var segundos=1200
var direccion='http://pdpto38:8303/comex/index.php' 
milisegundos=segundos*1000 
window.setTimeout("window.location.replace(direccion);",milisegundos); 
</script> 
</head>
<link rel="shortcut icon" href="../../../imagenes/barraweb/favicon.ico">
<link rel="icon" type="image/gif" href="../../../imagenes/barraweb/animated_favicon1.gif">
<body onLoad="MM_preloadImages('../../../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr>
    <td align="left" valign="middle" class="Estilo3">INGRESO O MODIFICACI&Oacute;N REPARO - MAESTRO</td>
    <td width="7%" rowspan="2" align="left" valign="middle" class="Estilo3"><img src="../../../imagenes/GIF/erde016.gif" width="43" height="43" align="right"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="Estilo4">CARTAS DE CR&Eacute;DITO IMPORTACI&Oacute;N</td>
  </tr>
</table>
<br>
<form name="form1" method="get" action="">
  <table width="95%"  border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr valign="middle" bgcolor="#999999">
      <td colspan="2" align="left" valign="middle"><img src="../../../imagenes/GIF/notepad.gif" width="19" height="21" border="0"><span class="Estilo5">Ingreso o Modificaci&oacute;n  Reparo</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Nro Folio:</td>
      <td align="left" valign="middle"><label>
        <input name="id" type="text" class="etiqueta12" id="id" size="12" maxlength="10">
      </label></td>
    </tr>
    <tr valign="middle">
      <td width="21%" align="right" valign="middle">Rut Cliente:</div></td>
      <td width="79%" align="left" valign="middle"><input name="rut_cliente" type="text" class="etiqueta12" id="rut_cliente" size="17" maxlength="15">
      <span class="rojopequeno">Sin puntos ni Guion</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Nro Operaci&oacute;n:</div></td>
      <td align="left" valign="middle"><input name="nro_operacion" type="text" class="etiqueta12" id="nro_operacion" size="15" maxlength="7">
      <span class="rojopequeno">K000000</span></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle">
        <input name="Submit" type="submit" class="boton" value="Buscar">
        <input name="Submit" type="reset" class="boton" value="Limpiar">
      </div></td>
    </tr>
  </table>
</form>
<br>
 <?php if ($totalRows_modrep > 0) { // Show if recordset not empty ?>
  <table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr valign="middle" bgcolor="#999999">
      <td align="center" class="titulocolumnas">Modificar</div></td>
      <td align="center" class="titulocolumnas">Nro Operaci&oacute;n</td>
      <td align="center" class="titulocolumnas">Rut Cliente</td>
      <td align="center" class="titulocolumnas">Fecha Ingreso</td>
      <td align="center" class="titulocolumnas">Evento</td>
    </tr>
    <?php do { ?>
    <tr valign="middle">
      <td align="center"><a href="moddet.php?recordID=<?php echo $row_modrep['id']; ?>"> <img src="../../../imagenes/ICONOS/update_2.jpg" width="18" height="18" border="0"></a></div></td>
      <td align="center"> <span class="respuestacolumna_rojo"><?php echo strtoupper($row_modrep['nro_operacion']); ?></span>&nbsp; </div></td>
<td align="center"><?php echo $row_modrep['rut_cliente']; ?>&nbsp; </div></td>
      <td align="center"><?php echo $row_modrep['fecha_ingreso']; ?>&nbsp; </div></td>
      <td align="center"><?php echo $row_modrep['evento']; ?>&nbsp; </div></td>
    </tr>
    <?php } while ($row_modrep = mysqli_fetch_assoc($modrep)); ?>
  </table>
  <br>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_modrep > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_modrep=%d%s", $currentPage, 0, $queryString_modrep); ?>">Primero</a>
                <?php } // Show if not first page ?>
      </td>
          <td width="31%" align="center"><?php if ($pageNum_modrep > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_modrep=%d%s", $currentPage, max(0, $pageNum_modrep - 1), $queryString_modrep); ?>">Anterior</a>
                <?php } // Show if not first page ?>
          </td>
          <td width="23%" align="center"><?php if ($pageNum_modrep < $totalPages_modrep) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_modrep=%d%s", $currentPage, min($totalPages_modrep, $pageNum_modrep + 1), $queryString_modrep); ?>">Siguiente</a>
                <?php } // Show if not last page ?>
          </td>
          <td width="23%" align="center"><?php if ($pageNum_modrep < $totalPages_modrep) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_modrep=%d%s", $currentPage, $totalPages_modrep, $queryString_modrep); ?>">�ltimo</a>
                <?php } // Show if not last page ?>
          </td>
    </tr>
  </table>
  <br>
  Registros del <strong><?php echo ($startRow_modrep + 1) ?></strong> al <strong><?php echo min($startRow_modrep + $maxRows_modrep, $totalRows_modrep) ?></strong> de un total de <strong><?php echo $totalRows_modrep ?></strong>
  <?php } // Show if recordset not empty ?> 
</div>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="../carcreimp.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image3" width="80" height="25" border="0"></a> <a href="../visacion/principal.php"><img src="../../../imagenes/Botones/visacion_1.jpg" width="80" height="25" border="0"></a></td>
  </tr>
</table>
</body>
</html>
<?php
mysqli_free_result($modrep);
?>