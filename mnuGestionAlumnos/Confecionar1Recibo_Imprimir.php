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
<title>Imprimir Recibo - Gestor Academia</title>
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	window.onunload = top.opener.location.reload();
</script>
</head>
<body>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	//Actualizar la tabla de pagos
	$sql="UPDATE historico_pagos SET pagado='YES', metalico='YES', fecha_Cobro='".date('Y-m-d')."' WHERE numero_pago=".$_GET['NumPago'];
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al actualizar Historico de Pagos: ".$miconexion->Error."<br />";
		echo $sql."<br />";
	}
	
	//Vuelca el recibo a la tabla movimientos en el apartado caja
	$sql="INSERT INTO movimientos (Descripcion, Haber, Fecha, idcuenta, idTipo, Centro) ";
	$sql=$sql."SELECT historico_pagos.Nombre_Alumno, historico_pagos.matricula+historico_pagos.materiales+historico_pagos.cuota+historico_pagos.dto, historico_pagos.Fecha_Cobro, '".$_SESSION['Centro']."CAJA', 'IN', '".$_SESSION['Centro']."' ";
	$sql=$sql."FROM historico_pagos WHERE historico_pagos.numero_pago=".$_GET['NumPago'];
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar movimiento: ".$miconexion->Error."<br />";
		echo $sql;
	}
	
	//Vuelca en cobros
	$sql="INSERT INTO cobros (Cod, Fecha_Cobro,Fecha_De, Importe, Matricula, Dto, Cuota, Materiales, Pagado, Metalico, Periodo, Centro) ";
	$sql=$sql."SELECT historico_pagos.Cod, historico_pagos.Fecha_Cobro, historico_pagos.Fecha_De, historico_pagos.Importe, historico_pagos.Matricula, historico_pagos.Dto, historico_pagos.Cuota, historico_pagos.Materiales, historico_pagos.Pagado, historico_pagos.Metalico, historico_pagos.Periodo, '".$_SESSION['Centro']."' ";
	$sql=$sql."FROM historico_pagos ";
	$sql=$sql."WHERE historico_pagos.Pagado='YES' AND historico_pagos.Fecha_Cobro!='0000-00-00' AND centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar Cobro: ".$miconexion->Error."<br />";
		echo $sql;
	}
	
	//Imprimir recibo
	$sql="SELECT * FROM Centros WHERE Codigo='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	$rowCentros=mysql_fetch_array($miconexion->Consulta_ID);
	
	$miconexion2 = new DB_mysql ;
	$miconexion2->conectar();
	$sql="SELECT * FROM historico_pagos WHERE Numero_Pago='".$_GET['NumPago']."'";
	$miconexion2->consulta($sql);
	$rowRecibo=mysql_fetch_array($miconexion2->Consulta_ID);
?>
<table width="632" height="291" border="1">
  <tr>
    <td width="622" height="285" align="left" valign="top"><table width="100%" border="0">
        <tr>
          <td width="111">
          	<img src="../Imagenes/logo_blanco.png" width="111" height="49" />
          </td>
          <td align="right" valign="top"><table width="217" border="1" bordercolor="#000000">
            <tr>
              <td width="207">
              	<table width="208" border="0">
                  <tr>
                    <td width="65"><strong>Recibo Nº</strong></td>
                    <td width="133"><div align="right"><?php echo $rowRecibo['Numero_Pago'] ?></div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#CCCCCC"><strong>Mes</strong></td>
                    <td bgcolor="#CCCCCC"><div align="right"><?php echo $rowRecibo['Periodo']."  de  ".substr($rowRecibo['Fecha_Ge'],0,4) ?></div></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
          	<font size="1">
<?php
	echo $rowCentros['Direccion']."  ".$rowCentros['Poblacion']."  ".$rowCentros['Provincia']."<br />\n";
	echo "Tfno ".$rowCentros['Telefono']."  ".$rowCentros['email']."<br />\n";
?>
          	</font>
          </td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td height="30" colspan="4" align="left" valign="top">Recibo por gastos de formación según los siguientes conceptos correspondientes al alumno:</td>
        </tr>
        <tr>
          <td width="48" align="left" valign="top">&nbsp;</td>
          <td width="125" align="left" valign="top"><strong>NOMBRE ALUMNO:</strong></td>
          <td colspan="2" align="left" valign="top"><div align="left"><?php echo $rowRecibo['Nombre_Alumno'] ?></div></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IMPORTE:</td>
          <td width="94" align="left" valign="top"><div align="right"><?php echo number_format($rowRecibo['Cuota'],2,",",".") ?>&nbsp;&#8364;</div></td>
          <td width="360" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DTO:</td>
          <td align="left" valign="top"><div align="right"><?php echo number_format($rowRecibo['Dto'],2,",",".") ?>&nbsp;&#8364;</div></td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MATERIALES</td>
          <td align="left" valign="top"><div align="right"><?php echo number_format($rowRecibo['Materiales'],2,",",".") ?>&nbsp;&#8364;</div></td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MATRICULA:</td>
          <td align="left" valign="top"><div align="right"><?php echo number_format($rowRecibo['Matricula'],2,",",".") ?>&nbsp;&#8364;</div></td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL:</strong></td>
          <td align="left" valign="top"><div align="right"><?php echo number_format($rowRecibo['Cuota']+$rowRecibo['Materiales']+$rowRecibo['Matricula']+$rowRecibo['Dto'],2,",",".") ?>&nbsp;&#8364;</div></td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="17" colspan="3" align="left" valign="top">&nbsp;<?php echo $rowCentros['Poblacion']."  ".date('d-m-Y')."<br />\n" ?></td>
          <td height="17" align="left" valign="top"><div align="right"><?php echo $rowCentros['NombreDirector'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        </tr>
      </table>      
		</td>
  </tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recuerde las ventajas al domiciliar sus pagos.<br />
<?php
//Elimina los reistros volcados
$sql="DELETE FROM historico_pagos ";
$sql=$sql."WHERE ((Not Fecha_Cobro='0000-00-00') AND Pagado='YES' AND Centro='".$_SESSION['Centro']."')";
$miconexion->consulta($sql);
if (!empty($miconexion->$Error)){
	echo "Error al elimina los reistros volcados: ".$miconexion->Error."<br />";
	echo $sql;
}

$miconexion->desconectar();
$miconexion2->desconectar();
?>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>
