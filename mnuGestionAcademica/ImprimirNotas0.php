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
<title>Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Imprimir Notas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
  <form action="ImprimirNotas1.php" method="get" name="form" target="_blank" id="form">
    <div align="center"><strong> Grupo:</strong> 
    <select name="Grupo" id="Grupo">
			<option value='' id='formulario'></option>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Grupo, Centro FROM GruposCuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "			<option value='".$row['Grupo']."' id='formulario'>".substr($row['Grupo'],3)."</option>\n";
	}
?>
    </select>
    <strong>Parcial Actual:</strong>
    <label>
    <input name="Parcial" type="text" id="Parcial" size="5" maxlength="1" 
<?php
	if (date('m')=='12'){
		echo "value='1'";
	}
	else{
		if (date('m')=='06' || date('m')=='6'){
			echo "value='3'";
		}
		else{
			echo "value='2'";
		}
	}
?>
    	/>
    </label>
    <br />
    <br />
    <label>
    <input type="submit" name="button" id="button" value="Enviar" />
    </label>
</div>
  </form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
