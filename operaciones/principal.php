<?php require_once('../Connections/comercioexterior.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "ADM,SUP,OPE,TATA";
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
  //$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($comercioexterior, $theValue) : mysqli_escape_string($comercioexterior, $theValue);
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
$colname_usuario = "-1";
if (isset($_SESSION['login'])) {
  $colname_usuario = $_SESSION['login'];
}
mysqli_select_db($comercioexterior, $database_comercioexterior);
$query_usuario = sprintf("SELECT * FROM usuarios WHERE usuario = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysqli_query($comercioexterior, $query_usuario) or die(mysqli_error($comercioexterior));
$row_usuario = mysqli_fetch_assoc($usuario);
$totalRows_usuario = mysqli_num_rows($usuario);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Comercio Exterior</title>
<style type="text/css">
<!--
@import url("../estilos/estilo12.css");
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000FF;
}
body {
	background-image: url(../imagenes/JPEG/edificio_corporativo.jpg);
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
.Estilo4 {color: #0000FF; font-weight: bold; font-size: 10px; }
.Estilo5 {
	font-size: 24px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo13 {font-size: 9px}
.Estilo14 {
	color: #000000;
	font-weight: bold;
}
.Estilo15 {
	color: #0000FF;
	font-weight: bold;
	font-size: 12px;
}
.Estilo16 {font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
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
<!--
//Script original de KarlanKas para forosdelweb.com 
var segundos=1200
var direccion='http://pdpto38:8303/comex/' 
milisegundos=segundos*1000 
window.setTimeout("window.location.replace(direccion);",milisegundos);
//-->
</script>
</head>
<link rel="shortcut icon" href="../imagenes/barraweb/favicon.ico">
<link rel="icon" type="image/gif" href="../imagenes/barraweb/animated_favicon1.gif">
<body onLoad="MM_preloadImages('../imagenes/Botones/boton_volver_2.jpg')">
<table width="95%"  border="1" align="center" bordercolor="#FF0000" bgcolor="#FF0000">
  <tr align="left" valign="middle">
    <td width="43"><img src="../imagenes/GIF/erde016.gif" width="43" height="43" align="left"></td>
    <td width="700" align="left" class="Estilo5">OPERACIONES COMEX</td>
    <td width="251" rowspan="2">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="250" height="60" align="right">
          <param name="movie" value="../imagenes/SWF/reloj_3.swf">
          <param name="quality" value="high">
          <embed src="../imagenes/SWF/reloj_3.swf" width="250" height="60" align="right" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
      </object>
    </div></td>
  </tr>
  <tr align="left" valign="middle">
    <td colspan="2"><span class="Estilo16">OPERADOR:(<?php echo strtoupper($row_usuario['nombre']);?>) &Aacute;REA:(<?php echo strtoupper($row_usuario['segmento']);?>)</span></td>
  </tr>
</table>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"></div>      <span class="Estilo4"><img src="../imagenes/ICONOS/lupa.jpg" width="15" height="15" border="0"> <span class="Estilo13">Administraci&oacute;n Comex</span>
        <select name="menu1" class="etiqueta12" onChange="MM_jumpMenu('parent',this,1)">
          <option value="principal.php">Seleccione Una Opci&oacute;n</option>
          <option value="../archivos/negexport/negexport.php">Archivos Neg. Export.</option>
          <option value="../archivos/msgswift/msgswift.php">Archivos L/C Import.</option>
          <option value="pagareparagua/principal.php">Pagare Paragua</option>
          <option value="convenioweb/principal.php">Convenio WEB</option>
          <option value="mandatos/mandatos.php">Aministracion Mandatos</option>
          <option value="custodia_doctos/custodia.php">Administracion de Custodia</option>
          <option value="excepciones/excepciones.php">Control y Mant. Excepciones</option>
      </select>
    </span></td>
  </tr>
</table>
<link rel="shortcut icon" href="../favicon.ico">
<link rel="icon" type="image/gif" href="../animated_favicon1.gif">
<table width="95%"  border="1" align="center" bordercolor="#000000">
  <tr>
    <td><br>
      <table width="90%"  border="0" align="center">
        <tr>
          <td width="32%"><a href="opcci/carcreimp.php"><img src="../imagenes/Botones/ccimportacion.jpg" width="150" height="40" border="0"></a></div></td>
          <td width="2%">&nbsp;</td>
          <td width="32%"><a href="opcce/carcreexp.php"><img src="../imagenes/Botones/ccexportacion.jpg" width="150" height="40" border="0"></a></div></td>
          <td width="2%"></div></td>
          <td width="31%"><a href="opcdpa/cedeypaant.php"><img src="../imagenes/Botones/cd_pa.jpg" width="150" height="40" border="0"></a></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></div></td>
          <td>&nbsp;</td>
          <td></div></td>
        </tr>
        <tr>
          <td><a href="opcbi/cobimport.php"><img src="../imagenes/Botones/cbi_opi.jpg" width="150" height="40" border="0"></a></div></td>
          <td>&nbsp;</td>
          <td><a href="opcbe/cobexport.php"><img src="../imagenes/Botones/cobexportacion.jpg" width="150" height="40" border="0"></a></div></td>
          <td></div></td>
          <td><a href="oppre/prestamos.php"><img src="../imagenes/Botones/prestamos.jpg" width="150" height="40" border="0"></a></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></div></td>
          <td>&nbsp;</td>
          <td></div></td>
        </tr>
        <tr>
          <td><a href="opcam/cambio.php"><img src="../imagenes/Botones/cambio.jpg" width="150" height="40" border="0"></a></td>
          <td>&nbsp;</td>
          <td><a href="opmec/meco.php"><img src="../imagenes/Botones/meco.jpg" width="150" height="40" border="0"></a></td>
          <td>&nbsp;</td>
          <td><a href="clientes/clientes.php"><img src="../imagenes/Botones/cliente.jpg" width="150" height="40" border="0"></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><a href="cajaseca/cajaseca.php"><img src="../imagenes/Botones/cajaseca.jpg" width="150" height="40" border="0" align="middle"></a>            </div></td>
          <td>&nbsp;</td>
          <td></div>
          <a href="clavebcos/clavebcos.php"><img src="../imagenes/Botones/bcos_con_clave.jpg" width="150" height="40" border="0"></a></td>
          <td></div></td>
          <td></div>
          <a href="estadistica/estadistica.php"><img src="../imagenes/Botones/cuadrodemando.jpg" width="150" height="40" border="0"></a></td>
        </tr>
      </table>
    <br></td>
  </tr>
</table>
<br>
<table width="95%"  border="0" align="center">
  <tr>
    <td align="right" valign="middle"><a href="../ingreso.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','../imagenes/Botones/boton_volver_2.jpg',1)"><img src="../imagenes/Botones/boton_volver_1.jpg" alt="Volver" name="Image15" width="80" height="25" border="0"></a></div></td>
  </tr>
</table>
</body>
</html>
<?php
mysqli_free_result($usuario);
?>