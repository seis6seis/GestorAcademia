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
<title>Informacion - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Informacion - Gestor Academia<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <table width="34%" border="0" align="center">
      <tr>
        <td width="42%" align="left" valign="middle"><strong>Tipo de Informacion:</strong></td>
        <td width="58%" align="left" valign="middle"><form name="form" id="form">
          <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
          <option>&nbsp;</option>
<?php
					$miconexion = new DB_mysql ;
					$miconexion->conectar();
					$sql="SELECT * FROM Documentos WHERE Titulo LIKE'Informacion%'";
					$miconexion->consulta($sql);
					while($row=mysql_fetch_array($miconexion->Consulta_ID)){
						echo "        <option value='Informacion2.php?Tipo=".$row['Titulo']."'>".$row['Titulo']."</option>";
					}
?>
          </select>
        </form>        </td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><div align="center"><br />
        Para imprimir use <strong>&quot;Botón derecho -&gt; Imprimir&quot;</strong></div></td>
      </tr>
  </table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
