<?php require_once('../../../../Connections/comercioexterior.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "ADM,TER";
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
$MM_restrictGoTo = "../../erroracceso.php";
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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE oppre SET evento=%s, estado=%s, nro_operacion=%s, nro_operacion_relacionada=%s, obs=%s, territorial=%s, moneda_operacion=%s, monto_operacion=%s, sub_estado=%s, origen_fondos=%s, destino_fondos=%s, tipo_tasa=%s, libor_tt=%s, algo_tt=%s, libor_tf=%s, algo_tf=%s, tasa_final=%s, spread=%s, tt=%s, reparo_obs=%s, mandato=%s, excepcion=%s, autorizacion_operaciones=%s, autorizacion_especialista=%s, responsable_excepcion=%s, tipo_excepcion=%s, solucion_excepcion=%s, urgente=%s, fuera_horario=%s, nro_folio=%s WHERE id=%s",
                       GetSQLValueString($_POST['evento'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['nro_operacion'], "text"),
                       GetSQLValueString($_POST['nro_operacion_relacionada'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['territorial'], "text"),
                       GetSQLValueString($_POST['moneda_operacion'], "text"),
                       GetSQLValueString($_POST['monto_operacion'], "double"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['origen_fondos'], "text"),
                       GetSQLValueString($_POST['destino_fondos'], "text"),
                       GetSQLValueString($_POST['tipo_tasa'], "text"),
                       GetSQLValueString($_POST['libor_tt'], "text"),
                       GetSQLValueString($_POST['algo_tt'], "double"),
                       GetSQLValueString($_POST['libor_tf'], "text"),
                       GetSQLValueString($_POST['algo_tf'], "double"),
                       GetSQLValueString($_POST['tasa_final'], "double"),
                       GetSQLValueString($_POST['spread'], "double"),
                       GetSQLValueString($_POST['tt'], "text"),
                       GetSQLValueString($_POST['reparo_obs'], "text"),
                       GetSQLValueString($_POST['mandato'], "text"),
                       GetSQLValueString($_POST['excepcion'], "text"),
                       GetSQLValueString($_POST['autorizacion_operaciones'], "text"),
                       GetSQLValueString($_POST['autorizacion_especilista'], "text"),
                       GetSQLValueString($_POST['responsable_excepcion'], "text"),
                       GetSQLValueString($_POST['tipo_excepcion'], "text"),
                       GetSQLValueString($_POST['solucion_excepcion'], "date"),
                       GetSQLValueString($_POST['urgente'], "text"),
                       GetSQLValueString($_POST['fuera_horario'], "text"),
                       GetSQLValueString($_POST['nro_folio'], "int"),
                       GetSQLValueString($_POST['id'], "int"));
  mysqli_select_db($comercioexterior, $database_comercioexterior);
  $Result1 = mysqli_query($comercioexterior, $updateSQL) or die(mysqli_error($comercioexterior));
  $updateGoTo = "modmae.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
$colname_DetailRS1 = "-1";
if (isset($_GET['id'])) {
  $colname_DetailRS1 = $_GET['id'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_DetailRS1 = sprintf("SELECT * FROM oppre WHERE id = %s", GetSQLValueString($colname_DetailRS1, "int"));
$DetailRS1 = mysqli_query($comercioexterior, $query_DetailRS1) or die(mysqli_error($comercioexterior));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysqli_num_rows($DetailRS1);
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_DetailRS2 = "SELECT cliente.* FROM oppre INNER JOIN cliente ON oppre.rut_cliente=cliente.rut_cliente WHERE oppre.id = $recordID";
$DetailRS2 = mysqli_query($comercioexterior, $query_DetailRS2) or die(mysqli_error($comercioexterior));
$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);
$totalRows_DetailRS2 = mysqli_num_rows($DetailRS2);
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;
$colname1_DetailRS1 = "Pendiente.";
if (isset($_GET['estado_visacion'])) {
  $colname1_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['estado_visacion'] : addslashes($_GET['estado_visacion']);
}
$colname2_DetailRS1 = "1";
if (isset($_GET['nro_operacion'])) {
  $colname2_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['nro_operacion'] : addslashes($_GET['nro_operacion']);
}
$colname3_DetailRS1 = "Pendiente.";
if (isset($_GET['sub_estado'])) {
  $colname3_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['sub_estado'] : addslashes($_GET['sub_estado']);
}
$colname_DetailRS1 = "1";
if (isset($_GET['rut_cliente'])) {
  $colname_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['rut_cliente'] : addslashes($_GET['rut_cliente']);
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$recordID = $_GET['recordID'];
$query_DetailRS1 = sprintf("SELECT * FROM oppre WHERE id = $recordID", $colname_modificacion,$colname1_modificacion,$colname2_modificacion,$colname3_modificacion);
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysqli_query($comercioexterior, $query_limit_DetailRS1) or die(mysqli_error($comercioexterior));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysqli_query($comercioexterior, $query_DetailRS1);
  $totalRows_DetailRS1 = mysqli_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Modificaci&oacute;n Instrucciones - Detalle</title>
<style type="text/css">
<!--
@import url("../../../../estilos/estilo12.css");
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000FF;
}
body {
	background-image: url(../../../../imagenes/JPEG/edificio_corporativo.jpg);
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
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo6 {
	font-size: 14px;
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script src="../../../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript">
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
//Script original de KarlanKas para forosdelweb.com 
var segundos=1200
var direccion='http://pdpto38:8303/comex/index.php' 
milisegundos=segundos*1000 
window.setTimeout("window.location.replace(direccion);",milisegundos);
</script>
<link href="../../../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../../../../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="MM_preloadImages('../../../../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr valign="middle">
    <td width="93%" align="left" class="Estilo3">MODIFICAR INSTRUCCIONES - DETALLE</td>
    <td width="7%" rowspan="2" align="left" class="Estilo3"><img src="../../../../imagenes/GIF/erde016.gif" width="43" height="43" align="right"></td>
  </tr>
  <tr valign="middle">
    <td align="left" class="Estilo4">PR&Eacute;STAMOS</td>
  </tr>
</table>
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
  <table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr valign="middle" bgcolor="#999999">
      <td colspan="4" align="left"><img src="../../../../imagenes/GIF/notepad.gif" width="19" height="21"><span class="titulodetalle">Modificar Instrucci&oacute;n</span></div></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">No. Folio</td>
      <td colspan="3" align="left" bgcolor="#CCCCCC"><span id="sprytextfield5">
      <input name="nro_folio" type="text" class="etiqueta12" id="nro_folio" value="<?php echo $row_DetailRS1['nro_folio']; ?>" size="15" maxlength="10">
      <span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span><span class="textfieldMinCharsMsg">No se cumple el m&iacute;nimo de caracteres requerido.</span><span class="textfieldMaxCharsMsg">Se ha superado el n&uacute;mero m&aacute;ximo de caracteres.</span><span class="textfieldMinValueMsg">El valor introducido es inferior al m&iacute;nimo permitido.</span><span class="textfieldMaxValueMsg">El valor introducido es superior al m&aacute;ximo permitido.</span><span class="textfieldRequiredMsg">Se necesita un valor.</span></span><span class="respuestacolumna_rojo">#</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Nro Registro: </td>
      <td align="center" bgcolor="#CCCCCC"><span class="nroregistro"><?php echo $row_DetailRS1['id']; ?></span>        </div></td>
      <td align="right" bgcolor="#CCCCCC">Rut Cliente:</td>
      <td align="center" bgcolor="#CCCCCC">
        <input name="rut_cliente" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['rut_cliente']; ?>" size="17" maxlength="15" readonly="readonly">
        <span class="rojopequeno">Sin punto ni Guion</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Nombre Cliente:</td>
      <td colspan="3" align="left" bgcolor="#CCCCCC"><input name="nombre_cliente" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['nombre_cliente']; ?>" size="122" maxlength="120" readonly="readonly"></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Fecha Ingreso:</td>
      <td align="center" bgcolor="#CCCCCC">
        <input name="fecha_ingreso" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['fecha_ingreso']; ?>" size="12" maxlength="10" readonly="readonly">
      <span class="rojopequeno">(dd-mm-aaaa)</span></div></td>
      <td align="right" bgcolor="#CCCCCC">Evento:        </div></td>
      <td align="center" bgcolor="#CCCCCC"><select name="evento" class="etiqueta12" id="evento">
        <option value="Apertura." <?php if (!(strcmp("Apertura.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Apertura</option>
        <option value="Prorroga." <?php if (!(strcmp("Prorroga.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Prorroga</option>
        <option value="Cambio Tasa." <?php if (!(strcmp("Cambio Tasa.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Cambio Tasa</option>
        <option value="Pago." <?php if (!(strcmp("Pago.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Pago</option>
        <option value="Visacion." <?php if (!(strcmp("Visacion.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Visacion (DI)</option>
        <option value="Cartera Vencida." <?php if (!(strcmp("Cartera Vencida.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Cartera Vencida</option>
        <option value="LBTR." <?php if (!(strcmp("LBTR.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>LBTR</option>
        <option value="Requerimiento." <?php if (!(strcmp("Requerimiento.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Requerimiento</option>
        <option value="Dev Comisiones." <?php if (!(strcmp("Dev Comisiones.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Dev Comisiones</option>
        <option value="Carta Original." <?php if (!(strcmp("Carta Original.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Carta Original</option>
        <option value="Prorroga y Pago." <?php if (!(strcmp("Prorroga y Pago.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Prorroga y Pago</option>
        <option value="Restructuracion." <?php if (!(strcmp("Restructuracion.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Restructuracion</option>
        <option value="Redenominacion." <?php if (!(strcmp("Redenominacion.", $row_DetailRS1['evento']))) {echo "selected=\"selected\"";} ?>>Redenominacion</option>
      </select>        </div></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Territorial:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="territorial" type="text" class="etiqueta12" id="territorial" value="<?php echo $row_DetailRS2['territorial']; ?>" size="30" maxlength="50" readonly="readonly"></td>
      <td align="right" bgcolor="#CCCCCC">Tipo Operaci&oacute;n:</td>
      <td align="center" bgcolor="#CCCCCC"><select name="tipo_operacion" class="etiqueta12" id="tipo_operacion">
        <option value="Confirming.">Confirming</option>
        <option value="Forfaiting.">Forfaiting</option>
        <option value="PAE.">PAE</option>
        <option value="PAE Cobex.">PAE Cobex</option>
        <option value="PAE SGR.">PAE SGR</option>
        <option value="Finan. Contado.">Finan. Contado</option>
        <option value="Finan. Contado COBEX.">Finan. Contado COBEX</option>
        <option value="Finan. Contado SGR.">Finan. Contado SGR</option>
        <option value="Credito Comercial.">Credito Comercial</option>
        <option value="Credito Comercial COBEX.">Credito Comercial COBEX</option>
        <option value="Credito Comercial SGR.">Credito Comercial SGR</option>
      </select></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Observaci&oacute;n:</td>
      <td colspan="3" align="left" bgcolor="#CCCCCC"><span id="sprytextarea1">
        <textarea name="obs" cols="80" rows="4" class="etiqueta12"><?php echo $row_DetailRS1['obs']; ?></textarea>
      <span class="rojopequeno" id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Se ha superado el n�mero m�ximo de caracteres.</span></span></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Nro Operaci&oacute;n:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="nro_operacion" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['nro_operacion']; ?>" size="15" maxlength="7">
      <span class="rojopequeno">F &oacute; K000000 / 
      <input name="nro_operacion_relacionada" type="text" class="etiqueta12" id="nro_operacion_relacionada" value="<?php echo $row_DetailRS1['nro_operacion_relacionada']; ?>" size="15" maxlength="7">
      L000000</span></td>
      <td align="right" bgcolor="#CCCCCC">Mandato:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="mandato" type="text" class="etiqueta12" id="mandato" value="<?php echo $row_DetailRS2['estado_mandato']; ?>" size="30" maxlength="25" readonly="readonly"></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Moneda / <br>
Monto Operaci&oacute;n:</td>
      <td align="center" bgcolor="#CCCCCC"><select name="moneda_operacion" class="etiqueta12" id="moneda_operacion">
        <option value="CLP" <?php if (!(strcmp("CLP", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>CLP</option>
        <option value="DKK" <?php if (!(strcmp("DKK", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>DKK</option>
        <option value="NOK" <?php if (!(strcmp("NOK", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>NOK</option>
        <option value="SEK" <?php if (!(strcmp("SEK", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>SEK</option>
        <option value="USD" <?php if (!(strcmp("USD", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>USD</option>
        <option value="CAD" <?php if (!(strcmp("CAD", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>CAD</option>
        <option value="AUD" <?php if (!(strcmp("AUD", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>AUD</option>
        <option value="HKD" <?php if (!(strcmp("HKD", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>HKD</option>
        <option value="EUR" <?php if (!(strcmp("EUR", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>EUR</option>
        <option value="CHF" <?php if (!(strcmp("CHF", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>CHF</option>
        <option value="GBP" <?php if (!(strcmp("GBP", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>GBP</option>
        <option value="ZAR" <?php if (!(strcmp("ZAR", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>ZAR</option>
        <option value="JPY" <?php if (!(strcmp("JPY", $row_DetailRS1['moneda_operacion']))) {echo "SELECTED";} ?>>JPY</option>
      </select>
        <span class="rojopequeno">/</span>
      <input name="monto_operacion" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['monto_operacion']; ?>" size="20" maxlength="20"></td>
      <td align="right" bgcolor="#CCCCCC">Urgente:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="urgente" type="radio" class="etiqueta12" id="urgente_1" value="Si" <?php if (!(strcmp($row_DetailRS1['campana_comex'],"Si"))) {echo "checked=\"checked\"";} ?>>
Si
  <input name="urgente" type="radio" class="etiqueta12" id="urgente_0" value="No" <?php if (!(strcmp($row_DetailRS1['campana_comex'],"No"))) {echo "checked=\"checked\"";} ?>>
No<br>
      </td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC"></div>
Fuera Horario:</td>
      <td align="center" bgcolor="#CCCCCC"><label>
        <input <?php if (!(strcmp($row_DetailRS1['fuera_horario'],"Si"))) {echo "checked=\"checked\"";} ?> name="fuera_horario" type="radio" class="etiqueta12" id="campana_comex_1" value="Si">
        Si</label>
        <input <?php if (!(strcmp($row_DetailRS1['fuera_horario'],"No"))) {echo "checked=\"checked\"";} ?> name="fuera_horario" type="radio" class="etiqueta12" id="campana_comex_0" value="No">
No</td>
      <td align="right" bgcolor="#CCCCCC">Origen Fondos / Destino Fondos:</td>
      <td align="center" bgcolor="#CCCCCC"><select name="origen_fondos" class="etiqueta12" id="origen_fondos">
        <option value="N/A" <?php if (!(strcmp("N/A", $row_DetailRS1['origen_fondos']))) {echo "selected=\"selected\"";} ?>>Seleccione una Opcion</option>
        <option value="CTA. CTE." <?php if (!(strcmp("CTA. CTE.", $row_DetailRS1['origen_fondos']))) {echo "selected=\"selected\"";} ?>>CTA. CTE.</option>
        <option value="V.A." <?php if (!(strcmp("V.A.", $row_DetailRS1['origen_fondos']))) {echo "selected=\"selected\"";} ?>>V.A.</option>
<option value="MT910." <?php if (!(strcmp("MT910.", $row_DetailRS1['origen_fondos']))) {echo "selected=\"selected\"";} ?>>MT910</option>
      </select> 
      / <select name="destino_fondos" class="etiqueta12" id="destino_fondos">
        <option value="N/A." <?php if (!(strcmp("N/A.", $row_DetailRS1['destino_fondos']))) {echo "selected=\"selected\"";} ?>>Seleccione una Opci&oacute;n</option>
        <option value="V.A." <?php if (!(strcmp("V.A.", $row_DetailRS1['destino_fondos']))) {echo "selected=\"selected\"";} ?>>V.A.</option>
        <option value="CTA. CTE." <?php if (!(strcmp("CTA. CTE.", $row_DetailRS1['destino_fondos']))) {echo "selected=\"selected\"";} ?>>CTA. CTE.</option>
<option value="REMESA." <?php if (!(strcmp("REMESA.", $row_DetailRS1['destino_fondos']))) {echo "selected=\"selected\"";} ?>>REMESA</option>
      </select></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Tipo Tasa:</td>
      <td align="center" bgcolor="#CCCCCC"><span id="spryradio1">
      <label>
        <input <?php if (!(strcmp($row_DetailRS1['tipo_tasa'],"Fija."))) {echo "checked=\"checked\"";} ?> type="radio" name="tipo_tasa" value="Fija." id="tipo_tasa_0">
        Fija</label>
      <label>
        <input <?php if (!(strcmp($row_DetailRS1['tipo_tasa'],"Variable."))) {echo "checked=\"checked\"";} ?> type="radio" name="tipo_tasa" value="Variable." id="tipo_tasa_1">
        Variable</label>
      <span class="radioRequiredMsg">Seleccione Tasa Fija o Variable.</span></span></td>
      <td align="right" bgcolor="#CCCCCC">Tasa Variable:</td>
      <td align="center" bgcolor="#CCCCCC"><select name="libor_tt" class="etiqueta12" id="libor_tt">
        <option value="N/A" selected <?php if (!(strcmp("N/A", $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor a...</option>
        <option value="30" <?php if (!(strcmp(30, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 30</option>
        <option value="60" <?php if (!(strcmp(60, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 60</option>
        <option value="90" <?php if (!(strcmp(90, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 90</option>
        <option value="120" <?php if (!(strcmp(120, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 120</option>
        <option value="150" <?php if (!(strcmp(150, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 150</option>
        <option value="180" <?php if (!(strcmp(180, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 180</option>
        <option value="210" <?php if (!(strcmp(210, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 210</option>
        <option value="240" <?php if (!(strcmp(240, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 240</option>
        <option value="270" <?php if (!(strcmp(270, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 270</option>
        <option value="300" <?php if (!(strcmp(300, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 300</option>
        <option value="330" <?php if (!(strcmp(330, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 330</option>
        <option value="360" <?php if (!(strcmp(360, $row_DetailRS1['libor_tt']))) {echo "selected=\"selected\"";} ?>>Libor 360</option>
      </select>
        <span class="rojopequeno">+</span>
        <input name="algo_tt" type="text" class="etiqueta12" id="algo_tt" value="<?php echo $row_DetailRS1['algo_tt']; ?>" size="10" maxlength="10">
        <span class="rojopequeno">= TT</span> <span class="respuestacolumna_azul">//</span>
        <select name="libor_tf" class="etiqueta12" id="libor_tf">
          <option value="N/A" selected <?php if (!(strcmp("N/A", $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor a...</option>
          <option value="30" <?php if (!(strcmp(30, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 30</option>
          <option value="60" <?php if (!(strcmp(60, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 60</option>
          <option value="90" <?php if (!(strcmp(90, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 90</option>
          <option value="120" <?php if (!(strcmp(120, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 120</option>
          <option value="150" <?php if (!(strcmp(150, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 150</option>
          <option value="180" <?php if (!(strcmp(180, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 180</option>
          <option value="210" <?php if (!(strcmp(210, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 210</option>
          <option value="240" <?php if (!(strcmp(240, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 240</option>
          <option value="270" <?php if (!(strcmp(270, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 270</option>
          <option value="300" <?php if (!(strcmp(300, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 300</option>
          <option value="330" <?php if (!(strcmp(330, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 330</option>
          <option value="360" <?php if (!(strcmp(360, $row_DetailRS1['libor_tf']))) {echo "selected=\"selected\"";} ?>>Libor 360</option>
        </select>
        <span class="rojopequeno">+</span>
        <input name="algo_tf" type="text" class="etiqueta12" id="algo_tf" value="<?php echo $row_DetailRS1['algo_tf']; ?>" size="10" maxlength="10">
      <span class="rojopequeno">= Tasa Final</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Tasas: </td>
      <td colspan="3" align="left" bgcolor="#CCCCCC"><span id="sprytextfield2"><span id="sprytextfield1"><span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="respuestacolumna_azul"><span class="respuestacolumna_rojo">TT</span></span></span><span class="respuestacolumna_rojo"><span class="textfieldInvalidFormatMsg">Formato debe ser 00.000000</span><span class="textfieldRequiredMsg">e necesita un valor.</span></span></span>
        <span id="sprytextfield3">
      <label>
        <input name="tt" type="text" class="etiqueta12" id="tt" value="<?php echo $row_DetailRS1['tt']; ?>" size="10" maxlength="10">
          <span class="respuestacolumna_rojo">SPREAD</span>
        </label>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><span class="respuestacolumna_azul">
      <input name="spread" type="text" class="etiqueta12" id="spread" value="<?php echo $row_DetailRS1['tasa']; ?>" size="10" maxlength="10">
      </span><span class="respuestacolumna_rojo">TASA FINAL</span><span class="respuestacolumna_azul">
<input name="tasa_final" type="text" class="etiqueta12" id="tasa_final" value="<?php echo $row_DetailRS1['tasa']; ?>" size="10" maxlength="10">
      </span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="left" bgcolor="#999999"><img src="../../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21" border="0"><span class="titulodetalle">Excepci&oacute;n</span></td>
    </tr>
    <tr valign="middle">
      <td rowspan="3" align="right" bgcolor="#CCCCCC">Excepci&oacute;n:</td>
      <td rowspan="3" align="center" bgcolor="#CCCCCC"><label>
        <input <?php if (!(strcmp($row_DetailRS1['excepcion'],"Si"))) {echo "checked=\"checked\"";} ?> type="radio" name="excepcion" value="Si">
        Si</label>
        <label>
          <input <?php if (!(strcmp($row_DetailRS1['excepcion'],"No"))) {echo "checked=\"checked\"";} ?> name="excepcion" type="radio" value="No">
      No</label></td>
      <td align="right" bgcolor="#CCCCCC">Auto. Opera.:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="autorizacion_operaciones" type="text" class="etiqueta12" id="autorizacion_operaciones" value="<?php echo $row_DetailRS1['autorizacion_operaciones']; ?>" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Auto. Espe.:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="autorizacion_especilista" type="text" class="etiqueta12" id="autorizacion_especilista" value="<?php echo $row_DetailRS1['autorizacion_especialista']; ?>" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Resp. Excepci&oacute;n:</td>
      <td align="center" bgcolor="#CCCCCC"><input name="responsable_excepcion" type="text" class="etiqueta12" id="responsable_excepcion" value="<?php echo $row_DetailRS1['responsable_excepcion']; ?>" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Tipo Excepci&oacute;n:</td>
      <td align="left" bgcolor="#CCCCCC"><input name="tipo_excepcion" type="text" class="etiqueta12" id="tipo_excepcion" value="<?php echo $row_DetailRS1['tipo_excepcion']; ?>" size="30" maxlength="50">
      <span class="rojopequeno">Max 50 Caracteres</span></td>
      <td align="right" bgcolor="#CCCCCC">Soluci&oacute;n Excepci&oacute;n:</td>
      <td align="center" bgcolor="#CCCCCC"><span id="sprytextfield4">
      <input name="solucion_excepcion" type="text" class="etiqueta12" id="solucion_excepcion" value="<?php echo $row_DetailRS1['solucion_excepcion']; ?>" size="12" maxlength="10">
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span></span><span class="rojopequeno">(aaaa-mm-dd)</span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="left" bgcolor="#999999"><img src="../../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21" border="0"><span class="titulodetalle">Reparo</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Estado Operaci&oacute;n:</td>
      <td colspan="3" align="left" bgcolor="#CCCCCC"><select name="estado" class="etiqueta12" id="estado">
        <option value="Preingresada." <?php if (!(strcmp("Preingresada.", $row_DetailRS1['estado']))) {echo "selected=\"selected\"";} ?>>Preingresada</option>
        <option value="Pendiente." <?php if (!(strcmp("Pendiente.", $row_DetailRS1['estado']))) {echo "selected=\"selected\"";} ?>>Enviada a Curse</option>
        <option value="Reparada." <?php if (!(strcmp("Reparada.", $row_DetailRS1['estado']))) {echo "selected=\"selected\"";} ?>>Reparada</option>
      </select></td>
    </tr>
    <tr valign="middle">
      <td align="right" bgcolor="#CCCCCC">Observaci&oacute;n Reparo:</td>
      <td colspan="3" align="left" bgcolor="#CCCCCC"><span id="sprytextarea2">
      <textarea name="reparo_obs" cols="80" rows="6" class="etiqueta12" id="reparo_obs"><?php echo $row_DetailRS1['reparo_obs']; ?></textarea>
      <span class="rojopequeno"><span id="countsprytextarea2">&nbsp;</span></span><span class="textareaMaxCharsMsg">Se ha superado el n&uacute;mero m&aacute;ximo de caracteres.</span></span><br>
      </td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="center" bgcolor="#CCCCCC"><input type="submit" class="etiqueta12" value="Modificar Instrucci&oacute;n"></td>
    </tr>
  </table>
<input name="id" type="hidden" value="<?php echo $row_DetailRS1['id']; ?>">
    <input type="hidden" name="MM_update" value="form1">
</form>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="modmae.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image3" width="80" height="25" border="0"></a></div></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {isRequired:false, minChars:0, maxChars:255, validateOn:["blur"], counterId:"countsprytextarea1", counterType:"chars_remaining"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"], hint:"0.00"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"], hint:"0.00"});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1", {validateOn:["blur"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {minChars:0, maxChars:450, counterId:"countsprytextarea2", counterType:"chars_remaining", isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy-mm-dd", validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {validateOn:["blur"], minChars:0, maxChars:10, minValue:0, maxValue:9999999999});
//-->
</script>
</body>
</html>
<?php
mysqli_free_result($DetailRS1);
mysqli_free_result($DetailRS2);
?>