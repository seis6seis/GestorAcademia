<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contrato - Gestor Academia</title>
<link href="../TinyMCE/css/content.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM Documentos WHERE Titulo='".$_GET['Tipo']."'";
		$miconexion->consulta($sql);
		$row=mysql_fetch_array($miconexion->Consulta_ID);
		$Contenido= $row['Contenido'];
		
//Sustituye el campo "Nombre Alumno"
		$sql="SELECT * FROM alumnos WHERE Codi='".$_GET['Codigo']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
		$Contenido= str_replace ('~NOMBRE_ALUMNO~', $row['Nombre_Alumno'], $Contenido); 
		
//sUSTITUYE LOS DATOS DEL GRUPO CUOTAS
		$sql="SELECT * FROM gruposcuotas WHERE Grupo='".$row['Grupo']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
		$Contenido= str_replace ('~GRUPO~', $row['Grupo'], $Contenido);  
		$Contenido= str_replace ('~MATRICULA~', $row['Matriculas'], $Contenido);  
		$Contenido= str_replace ('~MATERIALES~', $row['Materiales'], $Contenido);  
		$Contenido= str_replace ('~CUOTAS_MES~', $row['CuotasMes'], $Contenido);  
		$Contenido= str_replace ('~CUOTAS_TRIM~', $row['CuotasTrim'], $Contenido);  
		$Contenido= str_replace ('~CUOTAS_CUAT~', $row['CuotasCuat'], $Contenido);  
		$Contenido= str_replace ('~CUOTAS_ANO~', $row['CuotasAno'], $Contenido);  
		
//Sustituye el campo "Nombre Director"
		$sql="SELECT * FROM Centros WHERE Codigo='".$_SESSION['Centro']."'";
		$miconexion->consulta($sql);	
		$row =mysql_fetch_array($miconexion->Consulta_ID);
		$Contenido= str_replace ('~NOMBRE_DIRECTOR~', $row['NombreDirector'], $Contenido);  
//Sustituye el campo "Nombre Centro"
		$Contenido= str_replace ('~NOMBRE_CENTRO~', $row['NombreCentro'], $Contenido);		
		$Contenido= str_replace ('~POBLACION_CENTRO~', $row['Poblacion'], $Contenido);  
		$Contenido= str_replace ('~DIRECCION_CENTRO~', $row['Direccion'], $Contenido);  
		$Contenido= str_replace ('~CP_CENTRO~', $row['CP'], $Contenido);  
		$Contenido= str_replace ('~PROVINCIA_CENTRO~', $row['Provincia'], $Contenido);  
		$Contenido= str_replace ('~CURSO_ESCOLAR~', $row['Curso_Escolar'], $Contenido);  
		$Contenido= str_replace ('~TELEFONO_CENTRO~', $row['Telefono'], $Contenido);  

//Sustituye el campo "Fecha Actual Corta"
		$Contenido= str_replace ('~FECHA_ACTUAL_CORTA~', date ( "d/m/Y" ), $Contenido);  
		
//Sustituye el campo "Fecha Actual Larga"
		$Contenido= str_replace ('~FECHA_ACTUAL_LARGA~', date ( "w, d del m de Y" ), $Contenido);
		
//Sustituye el campo "Hora Actual"
		$Contenido= str_replace ('~HORA_ACTUAL~',  date ( "H:i" ), $Contenido);  

?>
<table width="650" border="0">
  <tr>
    <td><?php echo $Contenido ?></td>
  </tr>
</table>
</body>
</html>
