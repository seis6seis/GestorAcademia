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
<title>Imprimir Notas - Gestor Academia</title>
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<STYLE>
 H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }
</STYLE>
</head>
<body>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$miconexion2 = new DB_mysql ;
	$miconexion2->conectar();
	$miconexion3 = new DB_mysql ;
	$miconexion3->conectar();
	
	//Imprimir recibo
	$sql="SELECT * FROM Centros WHERE Codigo='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	$rowCentros=mysql_fetch_array($miconexion->Consulta_ID);
	
	$sql="SELECT Alumnos.Codi";
	$sql=$sql." FROM (Alumnos INNER JOIN Notas ON Alumnos.Codi = Notas.Codi)";
	$sql=$sql." WHERE Alumnos.Fecha_Ba='0000-00-00' AND Alumnos.Grupo='".$_GET['Grupo']."' AND Notas.Parcial='".$_GET['Parcial']."'";
	$sql=$sql." ORDER BY Alumnos.Codi ASC";
	$miconexion2->consulta($sql);
	while($Alumno=mysql_fetch_array($miconexion2->Consulta_ID)){	
		if ($_GET["chk".$Alumno['Codi']]=='on'){
			$NombreAlumno='';
			$Grupo=$rowNotas1['Grupo'];
			$Programa='';
			$Observaciones='';		
			$Nota11='';
			$Nota12='';
			$Nota13='';
			$Nota14='';
			$Nota15='';
			$Nota16='';
			$Faltas1='';
			$Nota21='';
			$Nota22='';
			$Nota23='';
			$Nota24='';
			$Nota25='';
			$Nota26='';
			$Faltas2='';
			$Nota31='';
			$Nota32='';
			$Nota33='';
			$Nota34='';
			$Nota35='';
			$Nota36='';
			$Faltas3='';
		
				$sql="SELECT Alumnos.Nombre_Alumno, Alumnos.Grupo, GruposCuotas.Programa, Notas.Parcial, Notas.Gram_y_Voc, Notas.E_Oral, Notas.E_Escrita, Notas.Compresion, Notas.Reading, Notas.Global, Notas.N_Faltas, Notas.Observaciones";
				$sql=$sql." FROM (Alumnos INNER JOIN Notas ON Alumnos.Codi = Notas.Codi) INNER JOIN GruposCuotas ON Alumnos.Grupo = GruposCuotas.Grupo";
				$sql=$sql." WHERE Alumnos.Codi='".$Alumno['Codi']."'";
				$sql=$sql." ORDER BY Notas.Parcial ASC";
				$miconexion3->consulta($sql);
				while($rowNotas1=mysql_fetch_array($miconexion3->Consulta_ID)){
					if($rowNotas1['Parcial']=='1'){
						$NombreAlumno=$rowNotas1['Nombre_Alumno'];
						$Grupo=$rowNotas1['Grupo'];
						$Programa=$rowNotas1['Programa'];
						$Nota11=$rowNotas1['Gram_y_Voc'];
						$Nota12=$rowNotas1['E_Oral'];
						$Nota13=$rowNotas1['E_Escrita'];
						$Nota14=$rowNotas1['Compresion'];
						$Nota15=$rowNotas1['Reading'];
						$Nota16=$rowNotas1['Global'];
						$Faltas1=$rowNotas1['N_Faltas'];
						$Observaciones=$rowNotas1['Observaciones'];
					}
					if($rowNotas1['Parcial']=='2'){
						$NombreAlumno=$rowNotas1['Nombre_Alumno'];
						$Grupo=$rowNotas1['Grupo'];
						$Programa=$rowNotas1['Programa'];
						$Nota21=$rowNotas1['Gram_y_Voc'];
						$Nota22=$rowNotas1['E_Oral'];
						$Nota23=$rowNotas1['E_Escrita'];
						$Nota24=$rowNotas1['Compresion'];
						$Nota25=$rowNotas1['Reading'];
						$Nota26=$rowNotas1['Global'];
						$Faltas2=$rowNotas1['N_Faltas'];
						$Observaciones=$rowNotas1['Observaciones'];
					}
					if($rowNotas1['Parcial']=='3'){
						$NombreAlumno=$rowNotas1['Nombre_Alumno'];
						$Grupo=$rowNotas1['Grupo'];
						$Programa=$rowNotas1['Programa'];
						$Nota31=$rowNotas1['Gram_y_Voc'];
						$Nota32=$rowNotas1['E_Oral'];
						$Nota33=$rowNotas1['E_Escrita'];
						$Nota34=$rowNotas1['Compresion'];
						$Nota35=$rowNotas1['Reading'];
						$Nota36=$rowNotas1['Global'];
						$Faltas3=$rowNotas1['N_Faltas'];
						$Observaciones=$rowNotas1['Observaciones'];
					}
				}
?>
      <table width="632" height="291" border="1">
        <tr>
          <td width="622" height="285" align="left" valign="top"><table width="100%" border="0">
              <tr>
                <td width="378">
                  <img src="../Imagenes/logo_blanco.png" width="111" height="49" />          </td>
                <td width="234" align="right" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <font size="1">
<?php
			echo $rowCentros['Direccion']."  ".$rowCentros['Poblacion']."  ".$rowCentros['Provincia']."<br />\n";
			echo "Tfno ".$rowCentros['Telefono']."  ".$rowCentros['email']."<br />\n";
?>
          	</font>          </td>
          <td><div align="right"><font size="1"><?php echo $rowCentros['Poblacion'].", ".date('d-m-Y') ?></font></div></td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td height="30" colspan="5" align="left" valign="top">
            <div align="center"><strong>Boletin de Notas de Inglés <?php echo $rowCentros['Curso_Escolar'] ?></strong></div>
						<hr />          </td>
        </tr>
        <tr>
          <td width="40" align="left" valign="top">&nbsp;</td>
          <td width="204" align="left" valign="top"><strong>ALUMNO:</strong></td>
          <td colspan="3" align="left" valign="top"><div align="left"><?php echo $NombreAlumno ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Grupo ?></div></td>
        </tr>
        <tr>
          <td width="40" align="left" valign="top">&nbsp;</td>
          <td width="204" align="left" valign="top">PROGRAMA:</td>
          <td colspan="3" align="left" valign="top"><div align="left"><?php echo $Programa ?></div></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><div align="center"><strong><u>1º PARCIAL</u></strong></div></td>
          <td align="left" valign="top"><div align="center"><strong><u>2º PARCIAL</u></strong></div></td>
          <td align="left" valign="top"><div align="center"><strong><u>3º PARCIAL</u></strong></div></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GRAMATICA Y VOCABULARIO:</td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota11 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota21 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota31 ?></div></td>
        </tr>
        <tr>
          <td height="20" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EXPRESION ORAL:</td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota12 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota22 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota32 ?></div></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EXPRESION ESCRITA:</td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota13 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota23 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota33 ?></div></td>
        </tr>
        <tr>
          <td height="20" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPRESION AUDITIVA:</td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota14 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota24 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota34 ?></div></td>
        </tr>
        <tr>
        	<td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPRESION LECTORA:</td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota15 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota25 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota35 ?></div></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top"><div align="center">&nbsp;</div></td>
          <td align="left" valign="top"><div align="center">&nbsp;</div></td>
        </tr>
        <tr>
          <td height="20" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTA GLOBAL:</strong></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota16 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota26 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Nota36 ?></div></td>
        </tr>
        <tr>
          <td height="20" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nº FALTAS:</strong></td>
          <td align="left" valign="top"><div align="center"><?php echo $Faltas1 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Faltas2 ?></div></td>
          <td align="left" valign="top"><div align="center"><?php echo $Faltas3 ?></div></td>
        </tr>
        <tr>
          <td height="35" colspan="5" align="right" valign="top">
            <hr />
            <strong>Firma de padres o tutores</strong>          </td>
        </tr>
        <tr>
          <td height="48" colspan="5" align="left" valign="top">
            <hr />
            <strong>OBSERVACIONES</strong><br />
            <?php echo $Observaciones ?>          </td>
        </tr>
      </table>      
		</td>
  </tr>
</table>
<H1 class=SaltoDePagina> </H1>
<?php
		}
	}
	$miconexion->desconectar();
	$miconexion2->desconectar();
?>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>
