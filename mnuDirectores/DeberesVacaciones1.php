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
<title>Deberes Vacaciones - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Deberes Vacaciones<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
	//$cuerpo= str_replace ('[Usuario]','$usuario', $cuerpo);

	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	
	$html=str_replace ( "'", "`", $_POST['html']);

	$sql="UPDATE deberesvacaciones SET Deberes='".$html."' WHERE Nivel='".$_POST['Nivel']."'";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar los deberes: ".$miconexion->Error."<br />";
		echo $sql;
	}
?>
  <p align="center">
  <strong>Se ha grabado exitosamente los deberes del Nivel <?php echo $_POST['Nivel'] ?>.</strong><br />
	<a href="DeberesVacaciones0.php"><strong>Retroceder</strong></a>  </p>
  <br />
  <table width="700" border="1">
    <tr>
      <td><?php echo htmlspecialchars_decode($_POST['html']); ?></td>
    </tr>
  </table>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
