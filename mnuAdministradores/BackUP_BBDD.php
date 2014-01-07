<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Backup BBDD - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
.Titulo {
	font-size: 36px;
	font-weight: bold;
}
-->
</style>
<!-- InstanceParam name="Titulo" type="boolean" value="true" -->
</head>

<body>
  <table width="100%" border="0">
    <tr>
      <td width="111"><img src="../Imagenes/logo_blanco.png" alt="Logo EnglishConnection" width="111" height="49" /></td>
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Backup BBDD<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p>  Para realizar un Bacup en una Base de Datos de Access seguir los siguientes pasos:</p>
  <ul>
    <li>Primero tener descargado el<strong> Driver ODBC</strong> &quot;ODBC Driver for MySQL (Connector/ODBC)&quot; <a href="http://www.mysql.com/products/connector/odbc/">http://www.mysql.com/products/connector/odbc/</a></li>
    <li>Despues Con Access abierto crear una<strong> nueva Base de Datos</strong> en blanco.</li>
    <li>Para Importar una o varias tablas de MySQL a Access ir a <strong>Importar-&gt;Datos Externos-&gt;Mas-&gt;Base de Datos ODBC</strong>.</li>
    <li>Escoger la opcion<strong> Importar el origen de datos</strong>.</li>
    <li>En la seguiente pantalla ir a la pestaña <strong>Origen de Datos de Equipo</strong>.</li>
    <li>En el caso que no tenga ya asociado la Base de Datos MySQL crar una nueva asociacion.
      <ul>
        <li>Se pulsa al boton NUEVO.</li>
        <li>En la nueva pantalla escoger Origen de Datos de sistema.</li>
        <li>Luego buscar el Driver MySQL ODBC 5.1 Driver y Finalizar.</li>
        <li>Saldra la nueva pantalla del Driver para la conexion.
          <ul>
            <li>Data Source Name =&gt; el nombre que se usara para reconecer la asociacion.            </li>
          </ul>
        </li>
        <ul>
          <li>Server =&gt; hostingmysql56.amen.es</li>
          <li>Port =&gt; 3306</li>
          <li>User =&gt; 803689_Gestor</li>
          <li>Password =&gt; Nj64sG6eDY5mUhaf</li>
          <li>Database =&gt; Es la Base de Datos que se quiera utilizar (gestoracademia=&gt; es la Base de datos del curso actual; gestoracademia2=&gt; es la Base de datos del curso proximo).</li>
        </ul>
      </ul>
    </li>
    <li>Escoger de la lista el nombre puesto en Data Source Name.</li>
    <li>Escogemos la opcion Seleccionar Todo y Aceptar.</li>
    </ul>
  <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
