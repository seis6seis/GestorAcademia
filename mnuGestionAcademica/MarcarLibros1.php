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
<title>Gestor Academia - Marcar libros de alumnos</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Marcar libros de alumnos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
  <br  />
  <br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="UPDATE Alumnos SET Materiales='YES' WHERE Fecha_Ba='0000-00-00' AND Centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	else {
		echo "<br /><br /><br />\n";
		echo "<div align=center><b><strong>Se ha modificado con exito.</strong></b><div>\n";
	}

?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
