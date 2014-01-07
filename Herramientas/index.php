<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Herramientas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();

	$sql="UPDATE Alumnos SET Alumnos.Fecha_Ba = '0000-00-00' WHERE ((Alumnos.Fecha_Ba) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Fecha_Al = '0000-00-00' WHERE ((Alumnos.Fecha_Al) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";
	
	$sql="UPDATE Alumnos SET Alumnos.Fecha_Co = '0000-00-00' WHERE ((Alumnos.Fecha_Co) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			
	
	$sql="UPDATE Alumnos SET Alumnos.Reserva = '' WHERE ((Alumnos.Reserva) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";
		
	$sql="UPDATE Alumnos SET Alumnos.Movil = '' WHERE ((Alumnos.Movil) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			
	$sql="UPDATE Alumnos SET Alumnos.Motivo_Dto = '--' WHERE ((Alumnos.Motivo_Dto) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Procedencia = 'OT' WHERE ((Alumnos.Procedencia) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Materiales = 'NO' WHERE ((Alumnos.Materiales) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Descuento = 'NO' WHERE ((Alumnos.Descuento) Is Null)";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			



	$sql="UPDATE Alumnos SET Alumnos.Fecha_Ba = '0000-00-00' WHERE (Alumnos.Fecha_Ba='')";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Fecha_Al = '0000-00-00' WHERE ((Alumnos.Fecha_Al=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";
	
	$sql="UPDATE Alumnos SET Alumnos.Fecha_Co = '0000-00-00' WHERE ((Alumnos.Fecha_Co=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			
	
	$sql="UPDATE Alumnos SET Alumnos.Reserva = '' WHERE ((Alumnos.Reserva=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";
		
	$sql="UPDATE Alumnos SET Alumnos.Movil = '' WHERE ((Alumnos.Movil=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			
	$sql="UPDATE Alumnos SET Alumnos.Motivo_Dto = '--' WHERE ((Alumnos.Motivo_Dto=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Procedencia = 'OT' WHERE ((Alumnos.Procedencia=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Materiales = 'NO' WHERE ((Alumnos.Materiales=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			

	$sql="UPDATE Alumnos SET Alumnos.Descuento = 'NO' WHERE ((Alumnos.Descuento=''))";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	echo $sql."<br><br>";			


?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
