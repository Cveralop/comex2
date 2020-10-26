<?php require_once('../../../Connections/comercioexterior.php'); ?>
<?php
  session_start();
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
$colname_consultatracer = "-1";
if (isset($_GET['rut_cliente'])) {
  $colname_consultatracer = $_GET['rut_cliente'];
}
$colname1_consultatracer = "aaabbb";
if (isset($_GET['nro_operacion'])) {
  $colname1_consultatracer = $_GET['nro_operacion'];
}
$colname2_consultatracer = "aaabbb";
if (isset($_GET['nro_operacion_exterior'])) {
  $colname2_consultatracer = $_GET['nro_operacion_exterior'];
}
$colname3_consultatracer = "aaabbb";
if (isset($_GET['evento'])) {
  $colname3_consultatracer = $_GET['evento'];
}
$colname4_consultatracer = "aasbbb";
if (isset($_GET['estado'])) {
  $colname4_consultatracer = $_GET['estado'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_consultatracer = sprintf("SELECT * FROM tracer WHERE rut_cliente LIKE %s and nro_operacion LIKE %s and nro_operacion_exterior LIKE %s and evento LIKE %s and estado LIKE %s ORDER BY date_seg_tracer ASC", GetSQLValueString("%" . $colname_consultatracer . "%", "text"),GetSQLValueString("%" . $colname1_consultatracer . "%", "text"),GetSQLValueString("%" . $colname2_consultatracer . "%", "text"),GetSQLValueString("%" . $colname3_consultatracer . "%", "text"),GetSQLValueString("%" . $colname4_consultatracer . "%", "text"));
$consultatracer = mysqli_query($comercioexterior, $query_consultatracer) or die(mysqli_error());
$row_consultatracer = mysqli_fetch_assoc($consultatracer);
$totalRows_consultatracer = mysqli_num_rows($consultatracer);
$consultatracer = mysqli_query($comercioexterior, $query_consultatracer) or die(mysqli_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta Tracer</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	color: #00F;
}
body {
	background-image: url(../../../imagenes/JPEG/edificio_corporativo.jpg);
}
a {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	color: #F00;
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
-->
</style>
<link href="../../../estilos/estilo12.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
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
//-->
</script>
<script> 
var segundos=1200
var direccion='http://pdpto38:8303/comex/index.php' 
milisegundos=segundos*1000 
window.setTimeout("window.location.replace(direccion);",milisegundos); 
</script>
</head>
<body onload="MM_preloadImages('../../../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr>
    <td width="93%" align="left" valign="middle" class="Estilo3">CONSULTA TRACER OP ENVIADAS Y OP RECIBIDAS - MAESTRO</td>
    <td width="7%" rowspan="2" align="left" valign="middle" class="Estilo3"><img src="../../../imagenes/GIF/erde016.gif" alt="" width="43" height="43" align="right" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="Estilo4">MERCADO DE CORREDORES</td>
  </tr>
</table>
<br />
<form id="form1" name="form1" method="get" action="">
  <table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr>
      <td colspan="2" align="left" valign="middle" bgcolor="#999999" class="titulo_menu"><img src="../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21" border="0" />Consulta TRACER</td>
    </tr>
    <tr>
      <td align="right" valign="middle">Rut Cliente:</td>
      <td align="left" valign="middle"><input name="rut_cliente" type="text" class="etiqueta12" id="rut_cliente" size="17" maxlength="15" />
        <span class="respuestacolumna_rojo">Sin Puntos ni Guión</span></td>
    </tr>
    <tr>
      <td width="21%" align="right" valign="middle">Nro Operacion:</td>
      <td width="79%" align="left" valign="middle"><input name="nro_operacion" type="text" class="etiqueta12" value="" size="20" maxlength="15" /></td>
    </tr>
    <tr>
      <td align="right" valign="middle">Nro Operacion Exterior:</td>
      <td align="left" valign="middle"><input name="nro_operacion_exterior" type="text" class="etiqueta12" value="" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td align="right" valign="middle">Evento:</td>
      <td align="left" valign="middle"><select name="evento" class="etiqueta12" id="evento">
        <option value="." selected="selected">Todos</option>
        <option value="Tracer OP Enviada.">Tracer OP Enviada</option>
        <option value="Tracer OP Recibida.">Tracer OP Recibida</option>
</select></td>
    </tr>
    <tr>
      <td align="right" valign="middle">Estado:</td>
      <td align="left" valign="middle"><select name="estado" class="etiqueta12" id="estado">
        <option value="Pendiente.">Pendiente</option>
        <option value="Cerrado.">Cerrado</option>
        <option value=".">Todos</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><input name="button" type="submit" class="boton" id="button" value="Buscar TRACER" /></td>
    </tr>
  </table>
</form>
<br />
<table width="95%" border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="../meco.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Imagen3','','../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Imagen3" width="80" height="25" border="0" id="Imagen3" /></a></td>
  </tr>
</table>
<br />
<?php if ($totalRows_consultatracer > 0) { // Show if recordset not empty ?>
  <span class="respuestacolumna_azul"><?php echo $totalRows_consultatracer ?></span> Registros Total <br />
  <br />
  <table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr>
      <td align="center" valign="middle" class="titulocolumnas">Fecha Ingreso</td>
      <td align="center" valign="middle" class="titulocolumnas">Evento</td>
      <td align="center" valign="middle" class="titulocolumnas">Estado</td>
      <td align="center" valign="middle" class="titulocolumnas">Operador</td>
      <td align="center" valign="middle" class="titulocolumnas">Nro Operación</td>
      <td align="center" valign="middle" class="titulocolumnas">Nro Operacion Exterior</td>
      <td align="center" valign="middle" class="titulocolumnas">OBS Swift</td>
      <td align="center" valign="middle" class="titulocolumnas">Fecha Seguimiento</td>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center" valign="middle" class="respuestacolumna_azul"><?php echo $row_consultatracer['date_ingreso']; ?></td>
        <td align="left" valign="middle"><?php echo $row_consultatracer['evento']; ?></td>
        <td align="center" valign="middle"><?php echo $row_consultatracer['estado']; ?></td>
        <td align="center" valign="middle" class="respuestacolumna_rojo"><?php echo $row_consultatracer['operador']; ?></td>
        <td align="center" valign="middle"><?php echo $row_consultatracer['nro_operacion']; ?></td>
        <td align="center" valign="middle"><?php echo $row_consultatracer['nro_operacion_exterior']; ?></td>
        <td align="left" valign="middle"><?php echo $row_consultatracer['obs_swift']; ?></td>
        <td align="center" valign="middle" class="respuestacolumna_rojo"><?php echo $row_consultatracer['date_seg_tracer']; ?></td>
      </tr>
      <?php } while ($row_consultatracer = mysqli_fetch_assoc($consultatracer)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
</body>
</html>
<?php
mysqli_free_result($consultatracer);
?>