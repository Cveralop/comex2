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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO opcci (rut_cliente, nombre_cliente, fecha_ingreso, date_ingreso, evento, estado, asignador, operador, obs, moneda_operacion, monto_operacion, nro_cuotas, pais, banco_destino, sub_estado, date_visa, date_asig, forward, reparo_obs, estado_visacion, visador, mandato, excepcion, autorizacion_operaciones, autorizacion_especialista, responsable_excepcion, tipo_excepcion, solucion_excepcion, urgente, fuera_horario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['rut_cliente'], "text"),
                       GetSQLValueString($_POST['nombre_cliente'], "text"),
                       GetSQLValueString($_POST['fecha_ingreso'], "text"),
                       GetSQLValueString($_POST['date_ingreso'], "date"),
                       GetSQLValueString($_POST['evento'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['visador'], "text"),
                       GetSQLValueString($_POST['operador'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['moneda_operacion'], "text"),
                       GetSQLValueString($_POST['monto_operacion'], "double"),
                       GetSQLValueString($_POST['nro_cuotas'], "int"),
                       GetSQLValueString($_POST['pais'], "text"),
                       GetSQLValueString($_POST['banco_destino'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['date_visa'], "date"),
                       GetSQLValueString($_POST['date_visa'], "date"),
                       GetSQLValueString($_POST['forward'], "text"),
                       GetSQLValueString($_POST['reparo_obs'], "text"),
                       GetSQLValueString($_POST['estado_visacion'], "text"),
                       GetSQLValueString($_POST['visador'], "text"),
                       GetSQLValueString($_POST['mandato'], "text"),
                       GetSQLValueString($_POST['excepcion'], "text"),
                       GetSQLValueString($_POST['autorizacion_operaciones'], "text"),
                       GetSQLValueString($_POST['autorizacion_especilista'], "text"),
                       GetSQLValueString($_POST['responsable_excepcion'], "text"),
                       GetSQLValueString($_POST['tipo_excepcion'], "text"),
                       GetSQLValueString($_POST['solucion_excepcion'], "date"),
                       GetSQLValueString($_POST['urgente'], "text"),
                       GetSQLValueString($_POST['fuera_horario'], "text"));
  mysqli_select_db($comercioexterior, $database_comercioexterior);
  $Result1 = mysqli_query($comercioexterior, $insertSQL) or die(mysqli_error($comercioexterior));
  $insertGoTo = "ingmae.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
$colname_DetailRS1 = "1";
if (isset($_GET['rut_cliente'])) {
  $colname_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['rut_cliente'] : addslashes($_GET['rut_cliente']);
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_DetailRS1 = sprintf("SELECT * FROM opcci WHERE rut_cliente = '%s'", $colname_DetailRS1);
$DetailRS1 = mysqli_query($comercioexterior, $query_DetailRS1) or die(mysqli_error($comercioexterior));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysqli_num_rows($DetailRS1);
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
$query_DetailRS1 = sprintf("SELECT * FROM cliente WHERE id = $recordID", $colname_ingape);
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
<title>Ingreso Visaci&oacute;n - Detalle</title>
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
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<script src="../../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' debe ser numerico.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
  } if (errors) alert('El(los) siguiente(s) error(es) ha(n) occurrido:\n'+errors);
  document.MM_returnValue = (errors == '');
}
</script>
<script>
var segundos=1200
var direccion='http://pdpto38:8303/comex/index.php' 
milisegundos=segundos*1000 
window.setTimeout("window.location.replace(direccion);",milisegundos);
</script> 
<link href="../../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
<link rel="shortcut icon" href="../../../imagenes/barraweb/favicon.ico">
<link rel="icon" type="image/gif" href="../../../imagenes/barraweb/animated_favicon1.gif">
<body onLoad="MM_preloadImages('../../../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr>
    <td width="93%" align="left" valign="middle" class="Estilo3">INGRESO VISACI&Oacute;N - DETALLE</td>
    <td width="7%" rowspan="2" align="left" valign="middle" class="Estilo3"><img src="../../../imagenes/GIF/erde016.gif" width="43" height="43" align="right"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="Estilo4">CARTAS DE CR&Eacute;DITO DE IMPORTACI&Oacute;N</td>
  </tr>
</table>
<br>
<table width="95%" border="0" align="center">
  <tr>
    <td align="right"><a href="../../certificado_matrimonio/consulta_certifi_matri.php" target="_blank"><img src="../../../imagenes/Botones/ver_avales.jpg" alt="" width="80" height="25" border="0" align="middle"></a></td>
  </tr>
</table>
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" onSubmit="MM_validateForm('monto_operacion','','RisNum');return document.MM_returnValue">
  <table width="95%" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
    <tr valign="middle" bgcolor="#999999">
      <td colspan="4" align="left" valign="middle"><img src="../../../imagenes/GIF/notepad.gif" width="19" height="21" border="0"><span class="titulodetalle">Ingreso Visaci&oacute;n</div>
      </span></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Rut Cliente:</td>
      <td align="center" valign="middle">
          <input name="rut_cliente" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['rut_cliente']; ?>" size="17" maxlength="15" readonly="readonly">
      <span class="rojopequeno">Sin puntos ni Guion</span></div></td>
      <td align="right" valign="middle">Fecha Ingreso:</div></td>
      <td align="center" valign="middle">
          <input name="fecha_ingreso" type="text" class="etiqueta12" value="<?php echo date("d-m-Y"); ?>" size="12" maxlength="10"> 
      <span class="rojopequeno">(dd-mm-aaaa)</span> </div></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Nombre Cliente:</td>
      <td colspan="3" align="left" valign="middle"><input name="nombre_cliente" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['nombre_cliente']; ?>" size="122" maxlength="120" readonly="readonly"></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Evento:</td>
      <td align="center" valign="middle">        
      <select name="evento" class="etiqueta12" id="evento">
            <option value="Apertura." selected>Apertura</option>
            <option value="Pagare Paragua.">Pagare Paragua</option>
            <option value="Pre Swift.">Pre Swift</option>
          </select>
      </div></td>
      <td align="right" valign="middle">Operador:</td>
      <td align="center" valign="middle"><select name="operador" class="etiqueta12" id="operador">
        <option value="AVENEGC">Ana M. Venegas Casta&ntilde;eda</option>
        <option value="HRAMIRZ">Hernan Ramirez Ramirez</option>
        <option value="JAVELLO">Juan Avello Poblete</option>
        <option value="EVALENZU">Eliza Valenzuela</option>
        <option value="CURRUTP">Claudia Urrutia</option>
        <option value="EROBLES">Elizabeth Robles</option>
        <option value="HURIBEC">Hernan Uribe</option>
        <option value="JMALDON">Jaime Maldonado</option>
        <option value="LCELISD">Luis Celis</option>
        <option value="PGODOY">Patricia Godoy</option>
        <option value="MCORCOVA">Matias Cordova</option>
        <option value="PMOSCOA">Pamela Moscoso</option>
        <option value="MTOROB">Veronica Toro</option>
	<option value="RTOBARC">Romuald Tobar Caro</option>
        <option value="FESPINOZ">Franco Espinoza</option>
        <option value="MPALACIO">Manuel Palacios Gutierrez</option>
        <option value="JSANTIBA">Jose Santiba�ez Pe�a</option>        
        <option value="FMABELP">Francisca Mabel Perez</option>
        <option value="XMAGANA">Ximena Maga�a Gonzalez</option>
        <option value="YPARRA">Yanadet Parra Trincado</option>
        <option value="JROMAN">Juan Roman Diaz</option>
        <option value="PCCI1">Practica CCI 1</option>
        <option value="PCCI2">Practica CCI 2</option>
        <option value="PCCI3">Practica CCI 3</option>
      </select></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Observaci&oacute;n:</td>
      <td colspan="3" align="left" valign="middle"><span id="sprytextarea1">
        <textarea name="obs" cols="80" rows="4" class="etiqueta12"></textarea>
      <span class="rojopequeno" id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Se ha superado el n�mero m�ximo de caracteres.</span></span></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Moneda / <br>
Monto Operaci&oacute;n:</td>
      <td align="center" valign="middle"><select name="moneda_operacion" class="etiqueta12" id="moneda_operacion">
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
        <option value="CNY">CNY</option>
      </select>
        <span class="rojopequeno">/</span>
      <input name="monto_operacion" type="text" class="etiqueta12" value="0.00" size="20" maxlength="20"></td>
      <td align="right" valign="middle">Mandato:</td>
      <td align="center" valign="middle"><input name="mandato" type="text" class="etiqueta12" id="mandato" value="<?php echo $row_DetailRS1['estado_mandato']; ?>"></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Forward:</td>
      <td align="center" valign="middle"><input name="forward" type="text" class="destadado" id="forward" size="20" maxlength="20"></td>
      <td align="right" valign="middle">Urgente:</td>
      <td align="center" valign="middle">     
        <label>          </label>
        <label>
          <input name="urgente" type="radio" class="etiqueta12" value="Si">
          Si</label>
        <label>
          <input name="urgente" type="radio" class="etiqueta12" value="No" checked>
          No</label>
      </td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Fuera Horario:</td>
      <td align="center" valign="middle"><label>
        <input type="radio" name="fuera_horario" value="Si">
        Si</label>
        <label>
          <input name="fuera_horario" type="radio" value="No" checked>
      No</label></td>
      <td align="right" valign="middle">Pais:</td>
      <td align="center" valign="middle"><input name="pais" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['pais']; ?>" size="25" maxlength="20"></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle" bgcolor="#CCCCCC">Banco Destino:</td>
      <td colspan="3" align="left" valign="middle" bgcolor="#CCCCCC"><input name="banco_destino" type="text" class="etiqueta12" value="<?php echo $row_DetailRS1['banco_destino']; ?>" size="55" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle" bgcolor="#CCCCCC">Nro Cuotas:</td>
      <td colspan="3" align="left" valign="middle" bgcolor="#CCCCCC"><input name="nro_cuotas" type="text" class="etiqueta12" id="nro_cuotas" value="1" size="5" maxlength="4">
      <span class="rojopequeno">1 al 9999</span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="left" valign="middle" bgcolor="#999999"><img src="../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21"><span class="titulodetalle">Excepci&oacute;n Operaci&oacute;n        </span><br>
      </div></td>
    </tr>
    <tr valign="middle">
      <td rowspan="3" align="right" valign="middle">Excepci&oacute;n:</td>
      <td rowspan="3" align="center" valign="middle"><label>
        <input type="radio" name="excepcion" value="Si">
        Si</label>
        <label>
          <input name="excepcion" type="radio" value="No" checked>
      No</label></td>
      <td align="right" valign="middle">Auto. Opera.:</td>
      <td align="center" valign="middle"><input name="autorizacion_operaciones" type="text" class="etiqueta12" id="autorizacion_operaciones" size="30" maxlength="50"></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Auto. Espe.:</td>
      <td align="center" valign="middle"><input name="autorizacion_especilista" type="text" class="etiqueta12" id="autorizacion_especilista" size="30" maxlength="50"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle">Resp. Excepci&oacute;n:</td>
      <td align="center" valign="middle"><input name="responsable_excepcion" type="text" class="etiqueta12" id="responsable_excepcion" size="30" maxlength="50">        </div></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Tipo Excepci&oacute;n:</td>
      <td colspan="3" align="left" valign="middle">
      <select name="tipo_excepcion" class="etiqueta12" id="tipo_excepcion">
        <option value="N/A." selected>N/A</option>
            <option value="Art 85 Vencido.">Art 85 Vencido</option>
            <option value="Linea de Credito sobregirada.">Linea de Credito sobregirada</option>
            <option value="Falta Autorizacion de Riesgos.">Falta Autorizacion de Riesgos</option>
            <option value="Aprobaci&oacute;o puntual de Riesgos no incluye tolerancia.">Aprobacion puntual de Riesgos no incluye tolerancia</option>
            <option value="Falta minuta de Credito.">Falta minuta de Credito</option>
            <option value="Firma disconforme.">Firma disconforme</option>
            <option value="Falta VB&ordm; poderes y firmas.">Falta VB&ordm; poderes y firmas</option>
            <option value="Falta mail Sucursal por pagare en custodia.">Falta mail Sucursal por pagare en custodia</option>
            <option value="Pagare sin llenar.">Pagare sin llenar</option>
            <option value="Pagare no corresponde.">Pagare no corresponde</option>
            <option value="Pagare version antigua.">Pagare version antigua</option>
            <option value="Falta pagare para aumento de valor de operacion.">Falta pagare para aumento de valor de operacion</option>
            <option value="Falta informe de fiscalia para avales sociedad anonima.">Falta informe de fiscalia para avales sociedad anonima</option>
            <option value="Avales no corresponde en pagare seg&uacute;n lo solicitado por riesgo.">Avales no corresponde en pagare seg&uacute;n lo solicitado por riesgo</option>
            <option value="Certificado de matrimonio avales vencidos o no se encuentra en nuestros archivos.">Certificado de matrimonio avales vencidos o no se encuentra en nuestros archivos</option>
            <option value="Falta constitucion de garantias.">Falta constitucion de garantias</option>
</select>
      </div></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Soluci&oacute;n Excepci&oacute;n:</td>
      <td colspan="3" align="left" valign="middle"><span id="sprytextfield1">
      <input name="solucion_excepcion" type="text" class="etiqueta12" id="solucion_excepcion" value="<?php echo date("Y-m-d"); ?>" size="12" maxlength="10">
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v�lido.</span></span><span class="rojopequeno">(aaaa-mm-dd)</span></td>
    </tr>
    <tr valign="middle">
      <td colspan="4" align="left" valign="middle" bgcolor="#999999"><img src="../../../imagenes/GIF/notepad.gif" alt="" width="19" height="21" border="0"><span class="titulodetalle">Reparo</span></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Estado Visaci&oacute;n: </div></td>
      <td colspan="3" align="left" valign="middle"></div>
        <label>
          <input name="estado" type="radio" id="estado_0" value="Pendiente." checked>
        Enviada a Curse</label>
      <label>
        <input name="estado" type="radio" class="respuestacolumna_rojo" id="estado_1" value="Reparada.">
      <span class="respuestacolumna_rojo">Reparada</span></label></td>
    </tr>
    <tr valign="middle">
      <td align="right" valign="middle">Observaci&oacute;n Reparo:</div></td>
      <td colspan="3" align="left" valign="middle"><span id="sprytextarea2">
        <textarea name="reparo_obs" cols="80" rows="6" class="etiqueta12" id="reparo_obs"></textarea>
      <span class="rojopequeno" id="countsprytextarea2">&nbsp;</span><span class="textareaMaxCharsMsg">Se ha superado el n�mero m�ximo de caracteres.</span></span></div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" valign="middle">
        <input type="submit" class="boton" value="Ingresar Visaci&oacute;n">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="id">
  <input type="hidden" name="MM_insert" value="form1">
  <input type="hidden" name="date_ingreso" value="<?php echo date("Y-m-d"); ?>" size="32">
  <input name="date_visa" type="hidden" id="date_visa" value="<?php echo date("Y-m-d H:i:s"); ?>" size="32">
  <input name="visador" type="hidden" class="etiqueta12" id="visador" value="<?php echo $_SESSION['login'];?>" size="20" maxlength="20">
  <input name="estado_visacion" type="hidden" id="estado_visacion" value="Cursada.">
</form>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="ingmae.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../../../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../../../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image3" width="80" height="25" border="0"></a></div></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {isRequired:false, minChars:0, maxChars:255, validateOn:["blur"], counterId:"countsprytextarea1", counterType:"chars_remaining"});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {isRequired:false, minChars:0, maxChars:450, validateOn:["blur"], counterId:"countsprytextarea2", counterType:"chars_remaining"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"yyyy-mm-dd", validateOn:["blur"]});
//-->
</script>
</body>
</html><?php
mysqli_free_result($DetailRS1);
?>