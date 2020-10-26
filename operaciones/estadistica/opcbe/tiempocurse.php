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

$colname_tiempocurse = "zzz";
if (isset($_GET['fecha_ingreso'])) {
  $colname_tiempocurse = $_GET['fecha_ingreso'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_tiempocurse = sprintf("SELECT *,timestampdiff(hour,date_espe,date_visa)as dif1,timestampdiff(hour,date_visa,date_asig)as dif2,timestampdiff(hour,date_asig,date_oper)as dif3,timestampdiff(hour,date_oper,date_supe)as dif4 FROM opcbe nolock WHERE fecha_ingreso LIKE '%%%s%%' ORDER BY evento ASC", $colname_tiempocurse);
$query_limit_tiempocurse = sprintf("%s LIMIT %d, %d", $query_tiempocurse, $startRow_tiempocurse, $maxRows_tiempocurse);
$tiempocurse = mysql_query($query_limit_tiempocurse, $comercioexterior) or die(mysqli_error());
$row_tiempocurse = mysqli_fetch_assoc($tiempocurse);
$totalRows_tiempocurse = mysqli_num_rows($tiempocurse);

mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_colores = "SELECT * FROM parametrocolores nolock";
$colores = mysqli_query($comercioexterior, $query_colores) or die(mysqli_error($comercioexterior));
$row_colores = mysqli_fetch_assoc($colores);
$totalRows_colores = mysqli_num_rows($colores);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="shortcut icon" href="../../../imagenes/barraweb/favicon.ico">
<link rel="icon" type="image/gif" href="../../../imagenes/barraweb/animated_favicon1.gif">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Tiempo de Curse por Fecha</title>
<style type="text/css">
<!--
@import url(../../../estilos/estilo12.css);
.Estilo1 {font-size: 18px;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo2 {	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
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
.Estilo4 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo8 {color: #FFFFFF}
.Estilo9 {font-size: 10px}
.Estilo10 {color: #FFFFFF; font-weight: bold; }
.Estilo11 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo15 {
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo16 {color: #00FF00}
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
    <td width="93%" align="left" valign="middle" bgcolor="#FF0000"><span class="Estilo1">TIEMPO DE CURSE POR FECHA</span></td>
    <td width="7%" rowspan="2" align="left" valign="middle" bgcolor="#FF0000"><img src="../../../imagenes/GIF/erde016.gif" width="43" height="43" align="right"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" bgcolor="#FF0000" class="subtitulopaguina">COBRANZA EXTRANJERA DE EXPORTACI&Oacute;N</td>
  </tr>
</table>
<br>
<form name="form1" method="get" action="">
  <table width="95%"  border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr bgcolor="#999999">
      <td colspan="2" align="left" valign="middle" scope="col"><img src="../../../imagenes/GIF/notepad.gif" width="19" height="21"><span class="etiqueta12 Estilo4"><span class="Estilo8">Selecci&oacute;n por Fecha de Curse</span></span></div></td>
    </tr>
    <tr>
      <td width="21%" align="right" valign="middle" scope="row">Fecha Ingreso:</td>
      <td width="79%" align="left" valign="middle">
        <input name="fecha_ingreso" type="text" class="etiqueta12" id="fecha_ingreso" value="<?php echo date("d-m-Y"); ?>" size="12" maxlength="10">
        <span class="rojopequeno">(dd-mm-aaaa)</span></div></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle" scope="row">
        <input name="Submit" type="submit" class="boton" value="Buscar"></td>
    </tr>
  </table>
</form>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="../../estadistica/estadistica.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image3" width="80" height="25" border="0"></a></div></td>
  </tr>
</table>
<br>
<?php if ($totalRows_tiempocurse > 0) { // Show if recordset not empty ?>
<table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td colspan="17" align="left" valign="middle"><span class="Estilo15"><img src="../../../imagenes/GIF/notepad.gif" width="19" height="21" border="0">Total Operaciones <span class="Estilo16"><?php echo $totalRows_tiempocurse ?></span></span></td>
  </tr>
  <tr bgcolor="#999999">
    <td align="center" valign="middle" class="titulocolumnas">Numero Operaci&oacute;n</div>      </div></td>
    <td align="center" valign="middle" class="titulocolumnas">Evento
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas">
      Especialista
        </div>
    </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Visador</strong></td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Asignador</strong>      
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Operador</strong>      
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Autorizador</strong>      
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Urgente</strong></td>
    <td align="center" valign="middle" class="titulocolumnas">Fecha y Hora Especialista
      </div>      
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Fecha y Hora Visaci&oacute;n </strong></td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Diferencia Horas </strong></td>
    <td align="center" valign="middle" class="titulocolumnas">Fecha y Hora Asignado
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas"><strong>Diferencia en Horas </strong>      
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas">Fecha y Hora Operador
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas">Diferencia en <br>
    Horas </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas">Fecha y Hora Autorizador
      </div>
    </td>
    <td align="center" valign="middle" class="titulocolumnas">Diferencia en <br>
    Horas </div>
    </td>
  </tr>
  <?php do { ?>
  <tr>
    <td align="center" valign="middle"><span class="respuestacolumna_rojo"><?php echo $row_tiempocurse['nro_operacion']; ?></span> 
      </div>       </div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['evento']; ?> </div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['especialista']; ?> </div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['visador']; ?></td>
    <td align="center" valign="middle"><span class="etiqueta12"><?php echo $row_tiempocurse['asignador']; ?></span></div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['operador']; ?></div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['autorizador']; ?></div></td>
    <td align="center" valign="middle"><?php if ($row_tiempocurse['urgente'] <> $row_colores['verdeno']) { // Show if not first page ?>
        <span class="Rojo2"><?php echo $row_tiempocurse['urgente']; ?> </span></span>        
		<?php } // Show if not first page ?>
		<?php if ($row_tiempocurse['urgente'] <> $row_colores['rojosi']) { // Show if not first page ?>
        <span class="Verde2"><?php echo $row_tiempocurse['urgente']; ?> </span></span>
    <?php } // Show if not first page ?> </td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['date_espe']; ?> </div>      </div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['date_visa']; ?></td>
    <td align="center" valign="middle" class="respuestacolumna_rojo"><?php echo $row_tiempocurse['dif1']; ?></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['date_asig']; ?> </div></td>
    <td align="center" valign="middle"><span class="respuestacolumna_rojo"><?php echo $row_tiempocurse['dif2']; ?></span>      </div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['date_oper']; ?> </div></td>
    <td align="center" valign="middle"><span class="respuestacolumna_rojo"><?php echo $row_tiempocurse['dif3']; ?></span>      </div></td>
    <td align="center" valign="middle"><?php echo $row_tiempocurse['date_supe']; ?></div></td>
    <td align="center" valign="middle"><span class="respuestacolumna_rojo"><?php echo $row_tiempocurse['dif4']; ?></span>      </div></td>
  </tr>
  <?php } while ($row_tiempocurse = mysqli_fetch_assoc($tiempocurse)); ?>
</table>
<?php } // Show if recordset not empty ?>
<br>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_tiempocurse > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_tiempocurse=%d%s", $currentPage, 0, $queryString_tiempocurse); ?>">Primero</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_tiempocurse > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_tiempocurse=%d%s", $currentPage, max(0, $pageNum_tiempocurse - 1), $queryString_tiempocurse); ?>">Anterior</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_tiempocurse < $totalPages_tiempocurse) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_tiempocurse=%d%s", $currentPage, min($totalPages_tiempocurse, $pageNum_tiempocurse + 1), $queryString_tiempocurse); ?>">Siguiente</a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_tiempocurse < $totalPages_tiempocurse) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_tiempocurse=%d%s", $currentPage, $totalPages_tiempocurse, $queryString_tiempocurse); ?>">�ltimo</a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysqli_free_result($tiempocurse);
mysqli_free_result($colores);
?>