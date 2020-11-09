<?php require_once('../../../../Connections/comercioexterior.php'); ?>
<?php
session_start();
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO oppre (rut_cliente, nombre_cliente, ejecutivo_cuenta, ejecutivo_ni, especialista_ni, nombre_oficina, fecha_ingreso, date_ingreso, evento, estado, obs, especialista_curse, territorial, moneda_operacion, monto_operacion, sub_estado, destino_fondos, tipo_tasa, libor_tt, algo_tt, libor_tf, algo_tf, tasa_final, spread, tt, date_preingreso, date_espe, date_visa, reparo_obs, estado_visacion, visador, mandato, excepcion, autorizacion_operaciones, autorizacion_especialista, responsable_excepcion, tipo_excepcion, solucion_excepcion, urgente, impedido_operar, fuera_horario, nro_folio, cliente_passport) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['rut_cliente'], "text"),
                       GetSQLValueString($_POST['nombre_cliente'], "text"),
                       GetSQLValueString($_POST['ejecutivo_cuenta'], "text"),
                       GetSQLValueString($_POST['ejecutivo_ni'], "text"),
                       GetSQLValueString($_POST['especialista_ni'], "text"),
                       GetSQLValueString($_POST['nombre_oficina'], "text"),
                       GetSQLValueString($_POST['fecha_ingreso'], "text"),
                       GetSQLValueString($_POST['date_ingreso'], "date"),
                       GetSQLValueString($_POST['evento'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['especialista_curse'], "text"),
                       GetSQLValueString($_POST['territorial'], "text"),
                       GetSQLValueString($_POST['moneda_operacion'], "text"),
                       GetSQLValueString($_POST['monto_operacion'], "double"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['destino_fondos'], "text"),
                       GetSQLValueString($_POST['tipo_tasa'], "text"),
                       GetSQLValueString($_POST['libor_tt'], "text"),
                       GetSQLValueString($_POST['algo_tt'], "double"),
                       GetSQLValueString($_POST['libor_tf'], "text"),
                       GetSQLValueString($_POST['algo_tf'], "double"),
                       GetSQLValueString($_POST['tasa_final'], "double"),
                       GetSQLValueString($_POST['spread'], "double"),
                       GetSQLValueString($_POST['tt'], "text"),
                       GetSQLValueString($_POST['date_preingreso'], "date"),
                       GetSQLValueString($_POST['date_espe'], "date"),
                       GetSQLValueString($_POST['date_espe'], "date"),
                       GetSQLValueString($_POST['reparo_obs'], "text"),
                       GetSQLValueString($_POST['estado_visacion'], "text"),
                       GetSQLValueString($_POST['especialista_curse'], "text"),
                       GetSQLValueString($_POST['mandato'], "text"),
                       GetSQLValueString($_POST['excepcion'], "text"),
                       GetSQLValueString($_POST['autorizacion_operaciones'], "text"),
                       GetSQLValueString($_POST['autorizacion_especilista'], "text"),
                       GetSQLValueString($_POST['responsable_excepcion'], "text"),
                       GetSQLValueString($_POST['tipo_excepcion'], "text"),
                       GetSQLValueString($_POST['solucion_excepcion'], "date"),
                       GetSQLValueString($_POST['urgente'], "text"),
					   GetSQLValueString($_POST['impedido_operar'], "text"),
                       GetSQLValueString($_POST['fuera_horario'], "text"),
                       GetSQLValueString($_POST['nro_folio'], "int"),
					   GetSQLValueString($_POST['cliente_passport'], "text"));
  mysqli_select_db($comercioexterior, $database_comercioexterior);
  $Result1 = mysqli_query($comercioexterior, $insertSQL) or die(mysqli_error($comercioexterior));
  $insertGoTo = "ingdet_m.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO envioop (rut_cliente, nombre_cliente, evento, estado, fecha_ingreso, moneda_operacion, monto_operacion, producto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['rut_cliente'], "text"),
                       GetSQLValueString($_POST['nombre_cliente'], "text"),
                       GetSQLValueString($_POST['evento'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['fecha_ingreso'], "text"),
                       GetSQLValueString($_POST['moneda_operacion'], "text"),
                       GetSQLValueString($_POST['monto_operacion'], "double"),
                       GetSQLValueString($_POST['producto'], "text"));
  mysqli_select_db($comercioexterior, $database_comercioexterior);
  $Result1 = mysqli_query($comercioexterior, $insertSQL) or die(mysqli_error($comercioexterior));
}
$colname_DetailRS1 = "1";
if (isset($_GET['rut_cliente'])) {
  $colname_DetailRS1 = $_GET['rut_cliente'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_DetailRS1 = sprintf("SELECT * FROM oppre nolock WHERE rut_cliente = %s", GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS1 = mysqli_query($comercioexterior, $query_DetailRS1) or die(mysqli_error($comercioexterior));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysqli_num_rows($DetailRS1);
$colname_envioop = "Apertura.";
if (isset($_GET['evento'])) {
  $colname_envioop = $_GET['evento'];
}
$colname1_envioop = "Prestamos Stand Alone";
if (isset($_GET['producto'])) {
  $colname1_envioop = $_GET['producto'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_envioop = sprintf("SELECT envioop.* FROM cliente INNER JOIN envioop ON cliente.rut_cliente=envioop.rut_cliente WHERE cliente.id = $recordID and evento = %s and producto = %s ORDER BY monto_operacion DESC", GetSQLValueString($colname_envioop, "text"),GetSQLValueString($colname1_envioop, "text"));
$envioop = mysqli_query($comercioexterior, $query_envioop) or die(mysqli_error($comercioexterior));
$row_envioop = mysqli_fetch_assoc($envioop);
$totalRows_envioop = mysqli_num_rows($envioop);
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;
$colname_DetailRS1 = "1";
if (isset($_GET['rut_cliente'])) {
  $colname_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['rut_cliente'] : addslashes($_GET['rut_cliente']);
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$recordID = $_GET['recordID'];
$query_DetailRS1 = sprintf("SELECT * FROM cliente nolock WHERE id = $recordID", $colname_ingape);
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
<title>Ingreso Multiple Instrucci&oacute;n - Detalle</title>
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
	color: #FFFFFF;
	font-size: 12px;
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
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
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
<link rel="shortcut icon" href="../../../../imagenes/barraweb/favicon.ico">
<link rel="icon" type="image/gif" href="../../../../imagenes/barraweb/animated_favicon1.gif">
<link href="../../../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../../../../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="MM_preloadImages('../../../../espcomex/imagenes/Botones/boton_volver_2.jpg','../../../../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr valign="middle">
    <td width="93%" align="left" class="Estilo3">INGRESO MULTIPLE INSTRUCCION - DETALLE </td>
    <td width="7%" rowspan="2" align="left" class="Estilo3"><img src="../../../../imagenes/GIF/erde016.gif" width="43" height="43" align="right"></td>
  </tr>
  <tr valign="middle">
    <td align="left" class="Estilo4">PR&Eacute;STAMOS</td>
  </tr>
</table>
<br>
<?php if ($totalRows_envioop > 0) { // Show if recordset not empty ?>
<table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
  <tr>
    <td colspan="6" align="left" valign="middle" bgcolor="#999999"><span class="titulocolumnas"><img src="../../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21"> <span class="titulo_menu"><span class="respuestacolumna"><span class="subtitulopaguina">Ordenes de Pago Enviadas a Curse</span></span></span></span></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#999999" class="titulocolumnas">Rut Cliente</td>
    <td valign="middle" bgcolor="#999999" class="titulocolumnas">Nombre Cliente</td>
    <td valign="middle" bgcolor="#999999" class="titulocolumnas">Estado</td>
    <td valign="middle" bgcolor="#999999" class="titulocolumnas">Fecha Ingreso</td>
    <td valign="middle" bgcolor="#999999" class="titulocolumnas">Fecha Curse</td>
    <td valign="middle" bgcolor="#999999" class="titulocolumnas">Moneda / Monto Operaci&oacute;n</td>
  </tr>
  <?php do { ?>
  <tr>
    <td valign="middle" class="respuestacolumna_rojo"><?php echo $row_envioop['rut_cliente']; ?></td>
    <td valign="middle"><?php echo $row_envioop['nombre_cliente']; ?></td>
    <td valign="middle"><?php echo $row_envioop['estado']; ?></td>
    <td valign="middle"><?php echo $row_envioop['fecha_ingreso']; ?></td>
    <td valign="middle"><?php echo $row_envioop['fecha_curse']; ?></td>
    <td align="right" valign="middle"><span class="respuestacolumna_rojo"><?php echo $row_envioop['moneda_operacion']; ?></span>&nbsp; <span class="respuestacolumna_azul"><?php echo number_format($row_envioop['monto_operacion'], 2, ',', '.'); ?></span></td>
  </tr>
  <?php } while ($row_envioop = mysqli_fetch_assoc($envioop)); ?>
</table>
<?php } // Show if recordset not empty ?>
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
  <table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr valign="middle" bgcolor="#999999">
      <td colspan="4" align="left"><img src="../../../../imagenes/GIF/notepad.gif" width="19" height="21" border="0"><span class="titulodetalle">Ingreso Multiple Instrucci&oacute;n</div>
      </span></td>
    </tr>
    <tr valign="middle">
      <td align="right">Nro Folio:</td>
      <td colspan="3" align="left"><span id="sprytextfield5">
      <input name="nro_folio" type="text" class="etiqueta12" id="nro_folio" size="15" maxlength="10">
      <span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span><span class="textfieldMinCharsMsg">No se cumple el m&iacute;nimo de caracteres requerido.</span><span class="textfieldMaxCharsMsg">Se ha superado el n&uacute;mero m&aacute;ximo de caracteres.</span><span class="textfieldMinValueMsg">El valor introducido es inferior al m&iacute;nimo permitido.</span><span class="textfieldMaxValueMsg">El valor introducido es superior al m&aacute;ximo permitido.</span><span class="textfieldRequiredMsg">Se necesita un valor.</span></span><span class="respuestacolumna_rojo">#</span></td>
    </tr>
    <tr valign="middle">
      <td align="right">Rut Cliente:</td>
      <td align="center">
          <input name="rut_cliente" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['rut_cliente']; ?>" size="17" maxlength="15" readonly="readonly">
          <span class="rojopequeno">Sin punto ni Guion</span></td>
      <td align="right">Fecha Ingreso:</div></td>
      <td align="center">
          <input name="fecha_ingreso" type="text" class="etiqueta12" value="<?php echo date("d-m-Y"); ?>" size="12" maxlength="10"> 
      <span class="rojopequeno">(dd-mm-aaaa)</span> </div></td>
    </tr>
    <tr valign="middle">
      <td align="right">Nombre Cliente:</td>
      <td colspan="3" align="left"><input name="nombre_cliente" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['nombre_cliente']; ?>" size="122" maxlength="120" readonly="readonly"></td>
    </tr>
    <tr valign="middle">
      <td align="right">Evento:</td>
      <td align="center">        
      <select name="evento" class="etiqueta12" id="evento">
            <option value="Apertura." selected>Apertura</option>
          </select>
      </div></td>
      <td align="right">Especilista Curse / Territorial:</div></td>
      <td align="center"><span id="sprytextfield8">
        <input name="especialista_curse" type="text" class="etiqueta12" id="especialista_curse" value="<?php echo $_SESSION['login'];?>" size="20" maxlength="20">
      <span class="textfieldRequiredMsg">Si este valor esta en Blanco ingrese nuevamente a la aplicaci&oacute;n.</span></span>        </div> <span class="rojopequeno">/</span>
      <input name="territorial" type="text" class="etiqueta12" id="territorial" value="<?php echo $row_DetailRS1['territorial']; ?>" size="30" maxlength="50" readonly="readonly"></td>
    </tr>
    <tr valign="middle">
      <td align="right">Observaci&oacute;n:</td>
      <td colspan="3" align="left"><span id="sprytextarea1">
        <textarea name="obs" cols="80" rows="4" class="etiqueta12"><?php echo (isset($row_DetailRS1['obs'])?$row_DetailRS1['obs']:""); ?></textarea>
      <span class="rojopequeno" id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Se ha superado el n�mero m�ximo de caracteres.</span></span></td>
    </tr>
    <tr valign="middle">
      <td align="right">Moneda<br> 
      Monto Operaci&oacute;n:</td>
      <td align="center">
          <select name="moneda_operacion" class="etiqueta12" id="moneda_operacion">
            <option value="CLP">CLP</option>
            <option value="DKK">DKK</option>
            <option value="NOK">NOK</option>
            <option value="SEK">SEK</option>
            <option value="USD" selected>USD</option>
            <option value="CAD">CAD</option>
            <option value="AUD">AUD</option>
            <option value="HKD">HKD</option>
            <option value="EUR">EUR</option>
            <option value="CHF">CHF</option>
            <option value="GBP">GBP</option>
            <option value="ZAR">ZAR</option>
            <option value="JPY">JPY</option>
          </select> 
          <span class="rojopequeno">/</span>        
          <input name="monto_operacion" type="text" class="etiqueta12" value="0.00" size="20" maxlength="20">
      </div></td>
      <td align="right">Mandato / Imp. Operar / Passport:</td>
      <td align="center"><input name="mandato" type="text" class="etiqueta12" id="mandato" value="<?php echo $row_DetailRS1['estado_mandato']; ?>" size="30" maxlength="25" readonly="readonly"> 
      / 
      <input name="impedido_operar" type="text" class="destadado" id="impedido_operar" value="<?php echo $row_DetailRS1['impedido_operar']; ?>" size="10" maxlength="10"> 
      / 
      <input name="cliente_passport" type="text" class="respuestacolumna_rojo" id="cliente_passport" value="<?php echo $row_DetailRS1['cliente_passport']; ?>" size="3" maxlength="2"></td>
    </tr>
    <tr valign="middle">
      <td align="right">Urgente:</td>
      <td align="center"><label>
        <input name="urgente" type="radio" class="etiqueta12" value="Si">
        Si
        <input name="urgente" type="radio" class="etiqueta12" value="No" checked>
No</label></td>
      <td align="right">Tipo Operaci&oacute;n:</td>
      <td align="center"><select name="tipo_operacion" class="etiqueta12" id="tipo_operacion">
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
      </select>        <br>
      </td>
    </tr>
    <tr valign="middle">
      <td align="right">Fuera Horario:</td>
      <td align="center"><label>
        <input name="fuera_horario" type="radio" class="etiqueta12" id="campana_comex_1" value="Si">
        Si</label>
        <input name="fuera_horario" type="radio" class="etiqueta12" id="campana_comex_0" value="No" checked>
No</td>
      <td align="right">Destino Fondos:</td>
      <td align="center"><select name="destino_fondos" class="etiqueta12" id="destino_fondos">
        <option value="N/A.">Seleccione una Opci&oacute;n</option>
        <option value="V.A.">V.A.</option>
        <option value="CTA. CTE.">CTA. CTE.</option>
        <option value="REMESA.">REMESA</option>
      </select></td>
    </tr>
    <tr valign="middle">
      <td align="right">Tipo Tasa:</td>
      <td align="center"><span id="spryradio1">
      <label>
        <input type="radio" name="tipo_tasa" value="Fija." id="tipo_tasa_0">
        Fija</label>
      <label>
        <input type="radio" name="tipo_tasa" value="Variable." id="tipo_tasa_1">
        Variable</label>
      <span class="radioRequiredMsg">Seleccione Tasa Fija o Variable.</span></span></td>
      <td align="right">Tasa Variable:</td>
      <td align="center"><select name="libor_tt" class="etiqueta12" id="libor_tt">
        <option value="N/A" selected>Libor a...</option>
        <option value="30">Libor 30</option>
        <option value="60">Libor 60</option>
        <option value="90">Libor 90</option>
        <option value="120">Libor 120</option>
        <option value="150">Libor 150</option>
        <option value="180">Libor 180</option>
        <option value="210">Libor 210</option>
        <option value="240">Libor 240</option>
        <option value="270">Libor 270</option>
        <option value="300">Libor 300</option>
        <option value="330">Libor 330</option>
        <option value="360">Libor 360</option>
      </select>
        <span class="rojopequeno">+</span>
        <input name="algo_tt" type="text" class="etiqueta12" id="algo_tt" value="0.00" size="10" maxlength="10">
        <span class="rojopequeno">= TT</span> <span class="respuestacolumna_azul">//</span>
        <select name="libor_tf" class="etiqueta12" id="libor_tf">
          <option value="N/A" selected>Libor a...</option>
          <option value="30">Libor 30</option>
          <option value="60">Libor 60</option>
          <option value="90">Libor 90</option>
          <option value="120">Libor 120</option>
          <option value="150">Libor 150</option>
          <option value="180">Libor 180</option>
          <option value="210">Libor 210</option>
          <option value="240">Libor 240</option>
          <option value="270">Libor 270</option>
          <option value="300">Libor 300</option>
          <option value="330">Libor 330</option>
          <option value="360">Libor 360</option>
        </select>
        <span class="rojopequeno">+</span>
        <input name="algo_tf" type="text" class="etiqueta12" id="algo_tf" value="0.00" size="10" maxlength="10">
      <span class="rojopequeno">= Tasa Final</span></td>
    </tr>
    <tr valign="middle">
      <td align="right">Tasas:</td>
      <td colspan="3" align="left"><span id="sprytextfield2"><span id="sprytextfield4"><span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="respuestacolumna_azul"><span class="respuestacolumna_rojo">TT</span></span></span><span class="textfieldInvalidFormatMsg">Formato debe ser 00.000000</span><span class="textfieldRequiredMsg">e necesita un valor.</span></span><span id="sprytextfield3">
        <label>
          <input name="tt" type="text" class="etiqueta12" id="tt" value="0.00" size="10" maxlength="10">
          <span class="respuestacolumna_rojo">SPREAD</span>
        </label>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><span id="sprytextfield7">
      <input name="spread" type="text" class="etiqueta12" id="spread" value="0.00" size="10" maxlength="10">
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><span class="respuestacolumna_rojo">TASA FINAL</span><span id="sprytextfield6">
      <input name="tasa_final" type="text" class="etiqueta12" id="tasa_final" value="0.00" size="10" maxlength="10">
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="left" bgcolor="#999999"><img src="../../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21" border="0"><span class="titulodetalle">Excepci&oacute;n</span><br>      </td>
    </tr>
    <tr valign="middle">
      <td rowspan="3" align="right">Excepci&oacute;n:</td>
      <td rowspan="3" align="center"><label>
        <input type="radio" name="excepcion" value="Si">
        Si</label>
        <label>
          <input name="excepcion" type="radio" value="No" checked>
      No</label></td>
      <td align="right">Auto. Opera.:</td>
      <td align="center"><input name="autorizacion_operaciones" type="text" class="etiqueta12" id="autorizacion_operaciones" value="" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right">Auto. Espe.:</td>
      <td align="center"><input name="autorizacion_especilista" type="text" class="etiqueta12" id="autorizacion_especilista" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right">Resp. Excepci&oacute;n:</td>
      <td align="center"><input name="responsable_excepcion" type="text" class="etiqueta12" id="responsable_excepcion" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right">Tipo Excepci&oacute;n:</td>
      <td align="left"><input name="tipo_excepcion" type="text" class="etiqueta12" id="tipo_excepcion" value="N/A" size="30" maxlength="50">
      <span class="rojopequeno">Max 50 Caracteres</span></td>
      <td align="right">Soluci&oacute;n Excepci&oacute;n:</td>
      <td align="center"><span id="sprytextfield">
      <input name="solucion_excepcion" type="text" class="etiqueta12" id="solucion_excepcion" value="<?php echo date("Y-m-d"); ?>" size="12" maxlength="10">
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span></span><span class="rojopequeno">(aaaa-mm-dd)</span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="left" bgcolor="#999999"><img src="../../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21" border="0"><span class="titulodetalle">Reparo</span></td>
    </tr>
    <tr valign="middle">
      <td align="right">Estado Operaci&oacute;n:</td>
      <td colspan="3" align="left"><label>
        <input name="estado" type="radio" id="estado_0" value="Pendiente." checked>
        Enviada a Curse</label>
        <label>
          <input name="estado" type="radio" class="respuestacolumna_rojo" id="estado_1" value="Reparada.">
      <span class="respuestacolumna_rojo">Reparada</span></label></td>
    </tr>
    <tr valign="middle">
      <td align="right">Observaci&oacute;n Reparo:</td>
      <td colspan="3" align="left"><span id="sprytextarea2">
      <textarea name="reparo_obs" cols="80" rows="6" class="etiqueta12" id="reparo_obs"></textarea>
      <span class="rojopequeno"><span id="countsprytextarea2">&nbsp;</span></span><span class="textareaMaxCharsMsg">Se ha superado el n&uacute;mero m&aacute;ximo de caracteres.</span></span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="center">
        <input type="submit" class="boton" value="Ingresar Instrucci&oacute;n">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="id">
  <input type="hidden" name="MM_insert" value="form1">
  <input type="hidden" name="date_ingreso" value="<?php echo date("Y-m-d"); ?>" size="32">
  <input name="date_preingreso" type="hidden" id="date_preingreso" value="<?php echo date("Y-m-d H:i:s"); ?>" size="32">
  <input name="date_espe" type="hidden" id="date_espe" value="<?php echo date("Y-m-d H:i:s"); ?>" size="32">
  <input name="estado_visacion" type="hidden" id="estado_visacion" value="Cursada.">
  <input name="ejecutivo_cuenta" type="hidden" id="ejecutivo_cuenta" value="<?php echo $row_DetailRS1['nombre_ejecutivo']; ?>">
  <input name="ejecutivo_ni" type="hidden" id="ejecutivo_ni" value="<?php echo $row_DetailRS1['ejecutivo']; ?>">
  <input name="especialista_ni" type="hidden" id="especialista_ni" value="<?php echo $row_DetailRS1['especialista']; ?>">
  <input name="producto" type="hidden" id="producto" value="Prestamos Stand Alone">
  <input name="nombre_oficina" type="hidden" id="nombre_oficina" value="<?php echo $row_DetailRS1['oficina']; ?>">
</form>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="ingmae_m.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image3" width="80" height="25" border="0"></a></div></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {isRequired:false, minChars:0, maxChars:255, validateOn:["blur"], counterId:"countsprytextarea1", counterType:"chars_remaining"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"], hint:"0.00"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"], hint:"0.00"});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], hint:"0.00"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"], hint:"0.00"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1", {validateOn:["blur"]});
var sprytextfield = new Spry.Widget.ValidationTextField("sprytextfield", "date", {format:"yyyy-mm-dd", validateOn:["blur"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {minChars:0, maxChars:450, counterId:"countsprytextarea2", counterType:"chars_remaining", isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {validateOn:["blur"], minChars:0, maxChars:10, minValue:0, maxValue:9999999999});
//-->
</script>
</body>
</html>
<?php
mysqli_free_result($DetailRS1);
mysqli_free_result($envioop);
?>