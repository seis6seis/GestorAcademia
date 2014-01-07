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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Pasar Alumnos de Información<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p>
    <?php
		require ("../Connections/DB_mysql.class.php");
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM Informacion WHERE ID_Informacion='".$_POST['ID']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);

		$sql="INSERT INTO Alumnos (Codi,Fecha_Al,Nombre_Alumno,Direccion,Telefono,Edad,Profesion_Estudios,Observaciones,Materiales,Descuento,Grupo,Centro) ";
		$sql=$sql."VALUES ('".$_SESSION['Centro'].$_POST['txtCodigo']."','".$row['Fecha']."','".$row['Nombre']."','".$row['Direccion']."','".$row['Telefono']."','".$row['F_Nacimiento']."','".$row['Estudia']."','".$row['Observaciones']."','NO','NO','".$_POST['cmbGrupo']."','".$row['Centro']."')";


		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo $miconexion->Error."<br />";
			echo $sql;
		}
		else {
			echo "<br /><br /><br />\n";
			echo "<div align=center><b>La informacion del alumno &#8220;".$row['Nombre']."&#8221; ha sido movido a la tabla alumnos.</b><div>\n";		
		}
		$miconexion->desconectar();
?>
</p>
  <p align="center"><a href="ModificarAlumno0.php?Codigo=<?php echo $_SESSION['Centro'].$_POST['txtCodigo'] ?>&amp;Centro=<?php echo $_SESSION['Centro'] ?>"><strong>Editar alumno    </strong></a></p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
