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
	<div align="center"><br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	if ($_POST['txtModificar']=='Nuevo'){
			$sql="SELECT Grupo FROM GruposCuotas WHERE Grupo='".$_SESSION['Centro'].$_POST['txtGrupo']."'";
			$miconexion->consulta($sql);
			if ($miconexion->numregistros()!=0){
				echo "El Grupo ".$_POST['txtGrupo']." ya existe. <a href='EditarGrupos0.php?Codigo=Nuevo'>pulsar para volver</a>.<br />";
			}
			else{
				$sql="INSERT INTO GruposCuotas (Grupo,Centro,Programa,HorasSemana,Horarios,Profesor,Matriculas,Materiales,CuotasMes,CuotasTrim,CuotasCuat,CuotasAno)";
				$sql=$sql." VALUES ('".$_SESSION['Centro'].$_POST['txtGrupo']."','".$_SESSION['Centro']."','".$_POST['txtPrograma']."','";
				$sql=$sql.$_POST['txtHorasSemana']."','".$_POST['txtHorarios']."','".$_POST['cmbProfesor']."','";
				$sql=$sql.$_POST['txtMatriculas']."','".$_POST['txtMateriales']."','".$_POST['txtCuotasMes']."','";
				$sql=$sql.$_POST['txtCuotasTrim']."','".$_POST['txtCuotasCuat']."','".$_POST['txtCuotasAno']."')";
			}
	}
	else{
			$sql="UPDATE GruposCuotas SET Grupo='".$_SESSION['Centro'].$_POST['txtGrupo']."',Centro='".$_SESSION['Centro']."',Programa='".$_POST['txtPrograma']."',";
			$sql=$sql."HorasSemana='".$_POST['txtHorasSemana']."',Horarios='".$_POST['txtHorarios']."',Profesor='".$_POST['cmbProfesor'];
			$sql=$sql."',Matriculas='".$_POST['txtMatriculas']."',Materiales='".$_POST['txtMateriales']."',CuotasMes='".$_POST['txtCuotasMes'];
			$sql=$sql."',CuotasTrim='".$_POST['txtCuotasTrim']."',CuotasCuat='".$_POST['txtCuotasCuat']."',CuotasAno='".$_POST['txtCuotasAno']."'";
			$sql=$sql." WHERE Grupo='".$_POST['txtModificar']."'";
	}
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar grupo: ".$miconexion->Error."<br />";
		echo $sql;
	}
	else{
		echo "	    <strong>Se ha modificador el grupo'".$_POST['txtGrupo']."', <a href='EditarGrupos0.php?Codigo=Nuevo'>pulsar para volver</a>.</strong></div>";
	}
?>
	    <br />
	    <br />
	    <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
