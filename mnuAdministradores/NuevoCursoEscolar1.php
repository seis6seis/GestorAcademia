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
<title>Nuevo Curso Escolar - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nuevo Curso Escolar<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	if($_POST['cmbCentro']!='' && $_POST['cmbCentro']!='Todos'){
		//Actualiza el Curso Escolar
		$sql="UPDATE Centros SET Curso_Escolar='".$_POST['txtCurso']."' WHERE Codigo='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
	
		//Vacia Notas
		$sql="DELETE FROM Notas WHERE Codi Like '".$_POST['cmbCentro']."%'";
		echo $sql;
		$miconexion->consulta($sql);

		// Vacia Apoyos
		$sql="DELETE FROM Apoyos WHERE idAlumno Like '".$_POST['cmbCentro']."%'";
		$miconexion->consulta($sql);
		
		// Vacia Balances
		$sql="DELETE FROM Balances WHERE Centro='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
		
		// Vacia Clases
		$sql="DELETE FROM Clases WHERE idGrupo Like '".$_POST['cmbCentro']."%'";
		$miconexion->consulta($sql);
		
		// Vacia Cobros
		$sql="DELETE FROM Cobros WHERE Centro='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
		
		// Vacia Faltas
		$sql="DELETE FROM Faltas WHERE Centro='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
		
		// Vacia Historico Bajas
		$sql="DELETE FROM Historico_Bajas WHERE Centro='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
		
		// Vacia Historico Pagos
		$sql="DELETE FROM Historico_Pagos WHERE Centro='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
		
		// Vacia Movimientos
		$sql="DELETE FROM Movimientos WHERE Centro='".$_POST['cmbCentro']."'";
		$miconexion->consulta($sql);
		
		// Vacia Registros Academicos
		$sql="DELETE FROM RegistrosAcademicos WHERE idAlumno Like '".$_POST['cmbCentro']."%'";
		$miconexion->consulta($sql);

		echo "Se ha borrado los datos del Grupo ".$_POST['cmbCentro'];
	}
	
	if($_POST['cmbCentro']=='Todos'){
		//Actualiza el Curso Escolar
		$sql="UPDATE Centros SET Curso_Escolar='".$_POST['txtCurso']."'";
		$miconexion->consulta($sql);
	
		//Vacia Notas
		$sql="DELETE FROM Notas";
		$miconexion->consulta($sql);
		
		// Vacia Apoyos
		$sql="DELETE FROM Apoyos";
		$miconexion->consulta($sql);
		
		// Vacia Balances
		$sql="DELETE FROM Balances";
		$miconexion->consulta($sql);
		
		// Vacia Clases
		$sql="DELETE FROM Clases";
		$miconexion->consulta($sql);
		
		// Vacia Cobros
		$sql="DELETE FROM Cobros";
		$miconexion->consulta($sql);
		
		// Vacia Faltas
		$sql="DELETE FROM Faltas";
		$miconexion->consulta($sql);
		
		// Vacia Historico Bajas
		$sql="DELETE FROM Historico_Bajas";
		$miconexion->consulta($sql);
		
		// Vacia Historico Pagos
		$sql="DELETE FROM Historico_Pagos";
		$miconexion->consulta($sql);
		
		// Vacia Movimientos
		$sql="DELETE FROM Movimientos";
		$miconexion->consulta($sql);
		
		// Vacia Registros Academicos
		$sql="DELETE FROM RegistrosAcademicos";
		$miconexion->consulta($sql);
		
		echo "Se ha borrado los datos de TODOS los Grupo.";
	}

?>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
