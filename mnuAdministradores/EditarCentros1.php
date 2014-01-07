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
<title>Editar Centro - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Centros<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
	<div align="center"><br />
<?php
	if ($_POST['txtModificar']=='Nuevo'){
		$sql="INSERT INTO Centros (NombreCentro,Direccion,CP,Poblacion,Provincia,Telefono,email,NIF_Presentador,Nombre_Presentador,Sufijo_Presentador,Entidad_Presentador,Oficina_Presentador,NIF_Ordenante,Nombre_Ordenante,Sufijo_Ordenante,Entidad_Ordenante,Oficina_Ordenante,DC_Ordenante,N_Cuenta_Ordenante,URLCuadrante)";
		$sql=$sql." VALUES ('".$_POST['txt01']."','".$_POST['txt02']."','".$_POST['txt03']."','".$_POST['txt04']."','".$_POST['txt05']."','".$_POST['txt06']."','".$_POST['txt07']."','".$_POST['txt08']."','".$_POST['txt09']."','".$_POST['txt10']."','".$_POST['txt11']."','".$_POST['txt12']."','".$_POST['txt13']."','".$_POST['txt14']."','".$_POST['txt15']."','".$_POST['txt16']."','".$_POST['txt17']."','".$_POST['txt18']."','".$_POST['txt19']."','".$_POST['txt20']."')";
	}
	else{
		$sql="UPDATE Centros SET Codigo='".$_POST['txt00']."',NombreCentro='".$_POST['txt01']."',Direccion='".$_POST['txt02']."',";
		$sql=$sql."CP='".$_POST['txt03']."',Poblacion='".$_POST['txt04']."',Provincia='".$_POST['txt05']."',Telefono='".$_POST['txt06']."',";
		$sql=$sql."email='".$_POST['txt07']."',NIF_Presentador='".$_POST['txt08']."',Nombre_Presentador='".$_POST['txt09']."',";
		$sql=$sql."Sufijo_Presentador='".$_POST['txt10']."',Entidad_Presentador='".$_POST['txt11']."',Oficina_Presentador='".$_POST['txt12']."',";
		$sql=$sql."NIF_Ordenante='".$_POST['txt13']."',Nombre_Ordenante='".$_POST['txt14']."',Sufijo_Ordenante='".$_POST['txt15']."',";
		$sql=$sql."Entidad_Ordenante='".$_POST['txt16']."',Oficina_Ordenante='".$_POST['txt17']."',DC_Ordenante='".$_POST['txt18']."',";
		$sql=$sql."N_Cuenta_Ordenante='".$_POST['txt19']."',";
		$sql=$sql."URLCuadrante='".$_POST['txt20']."'";	
		$sql=$sql." WHERE Codigo='".$_POST['txtModificar']."'";
	}

	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar movimiento: ".$miconexion->Error."<br />";
		echo $sql;
	}
	else{
		echo "	    <strong>Se ha modificador el centro'".$_POST['txt01']."', <a href='EditarCentros0.php?Codigo=Nuevo'>pulsar para volver</a>.</strong></div>";
	}

?>
	    <br />
	    <br />
	    <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
