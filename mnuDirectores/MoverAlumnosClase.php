<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
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
<!-- InstanceBeginEditable name="head" -->
<link rel="stylesheet" type="text/css" href="../grid/gt_grid.css" />  
<link rel="stylesheet" type="text/css" href="../grid/gt_grid_height.css" />
<script type="text/javascript" src="../grid/gt_msg_sp.js"></script>
<script type="text/javascript" src="../grid/gt_const.js"></script>
<script type="text/javascript" src="../grid/gt_grid_all.js"></script>
<script type="text/javascript" src="../grid/flashchart/fusioncharts/FusionCharts.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-setup.js"></script>

<!-- InstanceEndEditable -->
<style type="text/css">
<!--
.Titulo {
	font-size: 36px;
	font-weight: bold;
}
.Error{
	width: 300px;
	display: block;
	background-color: #FF3333;
	border-top: 1px solid #333333;
	border-bottom: 1px solid #333333;
	border-left: 0px;
	border-right: 0px;
	padding-top: 7px;
	padding-bottom: 7px;
	padding-left: 20px;
	font-weight: bold;
}
.Correcto{
	width: 300px;
	display: block;
	background-color: #22FF22;
	border-top: 1px solid #333333;
	border-bottom: 1px solid #333333;
	border-left: 0px;
	border-right: 0px;
	padding-top: 7px;
	padding-bottom: 7px;
	padding-left: 20px;
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Mover alumnos de Clase<!-- InstanceEndEditable --></div></td>
    </tr>
	</table>
	<!-- InstanceBeginEditable name="Codigo" -->
	<hr />
<?php
	if(isset($_POST['boton'])){
		if($_POST['cmbActualCurso']=='' || $_POST['txtNuevoCurso']==''){
			echo "<fieldset class='Error'>";
			echo "Rellena todos los campos.";
			echo "</fieldset>";
		}
		else{
			$sql="INSERT INTO gruposcuotas (Grupo, Centro, Programa, HorasSemana, Horarios, Profesor, Matriculas, Materiales, CuotasMes, CuotasTrim, CuotasCuat, CuotasAno) "
			."SELECT '".$_SESSION['Centro'].$_POST['txtNuevoCurso']."', Centro, Programa, HorasSemana, Horarios, Profesor, Matriculas, Materiales, CuotasMes, CuotasTrim, CuotasCuat, CuotasAno FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' AND Grupo='".$_POST['cmbActualCurso']."'";
			$miconexion->consulta($sql);
			if($miconexion->Error!=""){
				echo "<fieldset class='Error'>";
				echo "Error al insertar el nuevo grupo.";
				echo "</fieldset>";
			}
			else{
				$sql="UPDATE alumnos SET Grupo='".$_SESSION['Centro'].$_POST['txtNuevoCurso']."' WHERE Grupo='".$_POST['cmbActualCurso']."' AND Centro='".$_SESSION['Centro']."'";
				$miconexion->consulta($sql);
				if($miconexion->Error!=""){
					echo "<fieldset class='Error'>";
					echo "Error al mover a los alumnos al nuevo grupo.";
					echo "</fieldset>";
				}
				else{
					$sql="DELETE FROM alumnos WHERE Grupo='".$_POST['cmbActualCurso']."' AND Centro='".$_SESSION['Centro']."'";
					$miconexion->consulta($sql);
					if($miconexion->Error!=""){
						echo "<fieldset class='Error'>";
						echo "Error al eliminar los alumnos.";
						echo "</fieldset>";
					}
					else{
						$sql="DELETE FROM gruposcuotas WHERE Grupo='".$_POST['cmbActualCurso']."' AND Centro='".$_SESSION['Centro']."'";
						$miconexion->consulta($sql);
						if($miconexion->Error!=""){
							echo "<fieldset class='Error'>";
							echo "Error al eliminar grupo viejo.";
							echo "</fieldset>";
						}
						else{
							echo "<fieldset class='Correcto'>";
							echo "Modificado correctamente.";
							echo "</fieldset>";
						}
					}
				}
			}
		}
	}
?>
	<br />
	<center>
	<form ACTION="MoverAlumnosClase.php" METHOD=POST>
		<table width="70%" border="0">
			<tr>
				<td><strong>Escoja curso actual:</strong>&nbsp;&nbsp;
					<select name="cmbActualCurso" id="cmbActualCurso">
					<option value=''>----</option>
<?php
	$sql="SELECT Grupo FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "					<option value='".$row['Grupo']."'";
		if ($_POST['cmbActualCurso']==$row['Grupo']) echo " selected ";
		echo "size=20 tabindex=0>".substr($row['Grupo'],3)."</option>\n";
	}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Escoja curso nuevo:</strong>&nbsp;&nbsp;<?php echo $_SESSION['Centro'] ?>
					<input name="txtNuevoCurso" type="text" id="txtNuevoCurso" tabindex="1" value="<?php echo $_POST['txtNuevoCurso'] ?>" size="10" maxlength="7" />
				</td>
			</tr>
			<tr>
				<td>
					<br />
					<br />
					<center><INPUT NAME="boton" TYPE="SUBMIT" VALUE="Aceptar"></center>
				</td>
			</tr>
		</table>
	</form>
	</center>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
