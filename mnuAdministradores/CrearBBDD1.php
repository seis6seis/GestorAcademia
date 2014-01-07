<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Mover BBDD - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script>
	function seleccionar(obj) {
		elem=document.getElementById(obj);
		for(i=0;i<elem.length;i++){
			elem[i].selected=true;
		}
	}
	function deseleccionar(obj) {
		elem=document.getElementById(obj);
		for(i=0;i<elem.length;i++) elem[i].selected=false;
	}
	
</script>
<!-- InstanceEndEditable -->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Mover BBDD<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<hr />
<font color="#FF0000">&nbsp;&nbsp;&nbsp;*</font> Use la tecla CTRL para marcar multiples opciones.<br />
<font color="#FF0000">&nbsp;&nbsp;&nbsp;*</font> Al borrar o Copiar tablas se veran afectadas los datos segun los centros marcados, excepto las tablas (Apoyos, Banco, Centro, Clases, Documentos, Tipos, Notas, Registros Academicos y Historico Bajas) que se veran afectados  todos los datos.<br />
<form id="form1" name="form1" method="post" action="CrearBBDD2.php">
    <table width="49%" border="0" align="center">
      <tr>
        <td><div align="center"><strong>Tablas</strong></div></td>
        <td><div align="center"><strong>Centros</strong></div></td>
      </tr>
      <tr>
        <td width="50%" height="114" align="center" valign="top">
        	<select name="selTabla[]" size="15" multiple="multiple" id="selTabla">
          <option value="centros">Centros</option>
          <option value="usuarios">Usuarios</option>
          <option value="colegios">Colegios</option>
          <option value="gruposcuotas">Grupos Cuotas</option>
          <option value="clases">Clases</option>
          <option value="tipos">Tipos</option>
          <option value="alumnos">Alumnos</option>
          <option value="apoyos">Apoyos</option>
          <option value="balances">Balances</option>
          <option value="banco">Banco</option>
          <option value="cobros">Cobros</option>
          <option value="cuentas">Cuentas</option>
          <option value="documentos">Documentos</option>
          <option value="faltas">Faltas</option>
          <option value="historico_bajas">Historico Bajas</option>
          <option value="historico_pagos">Historico Pagos</option>
          <option value="informacion">Informacion</option>
          <option value="movimientos">Movimientos</option>
          <option value="notas">Notas</option>
          <option value="pago">Pago</option>
          <option value="registroacademicos">Registro Academicos</option>
       		</select>
          <br /><br />
          <input type="button" name="btn01" id="btn01" value="Seleccionar Todo" onclick="seleccionar('selTabla')" />
          <input type="button" name="btn02" id="btn02" value="Quitar Seleccion" onclick="deseleccionar('selTabla')" />        </td>
        <td width="50%" align="center" valign="top">
          <select name="selCentros[]" size="15" multiple="multiple" id="selCentros">
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Codigo, NombreCentro FROM Centros";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "          <option value='".$row['Codigo']."'>".$row['Codigo']."--".$row['NombreCentro']."</option>";
	}
?>
          </select>
          <br /><br />
          <input type="button" name="btn03" id="btn03" value="Seleccionar Todo" onclick="seleccionar('selCentros')" />
          <input type="button" name="btn04" id="btn04" value="Quitar Seleccion" onclick="deseleccionar('selCentros')" />        </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <p align="left">
            <strong>Escoger opcion a realizar: 
              <select name="opOpciones" id="select">
                <option>--------------</option>
                <option value="M_A_P">Copiar Datos de Curso Actual a Curso Proximo</option>
                <option value="M_P_A">Copiar Datos de Curso Proximo a Curso Actual</option>
                <option value="E_A">Eliminar datos de Curso Actual</option>
                <option value="E_P">Eliminar datos de Curso Proximo</option>
            </select>
            </strong>
          </p>
        </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <label>
          <input type="submit" name="button" id="button" value="Aceptar" />
          </label>
        </div></td>
      </tr>
    </table>
</form>
<p>&nbsp;</p>
<script>
seleccionar('selTabla');
seleccionar('selCentros');
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
