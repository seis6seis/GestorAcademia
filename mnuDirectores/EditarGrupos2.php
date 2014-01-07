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
<title>Editar Grupos - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Grupos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
<div align="center">
  <p><br />
    <br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT * FROM Alumnos WHERE Grupo='".$_GET['Codigo']."'";
	$miconexion->consulta($sql);
	if ($miconexion->numregistros()!=0){
		echo "Hay Alumnos en la clase, y no se puede eliminar el Grupo. <br>";
		while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
			echo "'".$row['Grupo']."'<br>";
		}
		echo "Cambie el Grupo de dichos Alumnos.";
	}
	else{
		$sql="DELETE FROM GruposCuotas WHERE Grupo='".$_GET['Codigo']."'";
	
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo "Error al borrar Grupo: ".$miconexion->Error."<br />";
			echo $sql;
		}
		else{
			echo "	    <strong>Se ha borrado el Grupo'".$_GET['Codigo']."', <a href='EditarGrupos0.php?Codigo=Nuevo'>pulsar para volver</a>.</strong></div>";
		}
	}
?>
  </p>
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
