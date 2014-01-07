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
<title>Generar Recibo Banco - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
function DescargarFTP(Fichero){
	document.execCommand('SaveAs','',Fichero); 
	//var ftp_connect = "ftp://ac4358:M4rt1n3z_@ftp.englishconnection.es/public/www/GestorAcademia/FTP/"+Fichero;
	//window.location = ftp_connect;
}
function PasarCobro(){
	if(confirm('Se va a proceder a volcar los datos a Cobros ¿Seguro?')==1) document.form1.submit(); 
;
}
</script>
<!-- InstanceEndEditable -->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Generar Recibo Banco<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
	function rellenar($Texto,$Longi,$car,$Sent){
		if (strtolower($Sent)=='true' and strtolower($Sent)=='false') echo "---ERROR---";
		if (strtolower($Sent)=='true'){
			return str_pad($Texto, $Longi, $car, STR_PAD_RIGHT);
		}
		else{
			return str_pad($Texto, $Longi, $car, STR_PAD_LEFT);
		}
	}
	function String($Longi,$Car){
		return str_pad("", $Longi, $Car, STR_PAD_RIGHT);
	}
	function Redondear($Numero,$Decimales){
		return round($Numero*100)/100;
	}
	
	//Crear Variables
	$Banco="";
	$Legible="";
	$sumaimp = 0;
	$reg = 0;
	$regt = 0;
	$fec=$_POST['txtFechaCargo'];
	
	//Pasar a Array los Numeros de pagos a tratar
	$NumPagos = explode("," , $_POST['txtNumPagos']); 

	//Borrar el fichero anterior
	if (file_exists("../FTP/".$_SESSION['Centro']."Banco.dat")) unlink ("../FTP/".$_SESSION['Centro']."Banco.dat");
	if (file_exists("../FTP/".$_SESSION['Centro']."Legible.dat")) unlink ("../FTP/".$_SESSION['Centro']."Legible.dat");
	
	//Abrir Ficheros
	$FicBanco=fopen("../FTP/".$_SESSION['Centro']."Banco.dat","w");
	$FicLegible=fopen("../FTP/".$_SESSION['Centro']."Legible.dat","w");

	//Conectar con tablas de la BBDD	
	$poBD = new DB_mysql ;
	$poBD->conectar();
	$sql="SELECT * FROM Centros WHERE Codigo='".$_SESSION['Centro']."'";
	$poBD->consulta($sql);
	$po =mysql_fetch_array($poBD->Consulta_ID);

	$his2BD = new DB_mysql ;
	$his2BD->conectar();
	$sql="SELECT * FROM Historico_Pagos WHERE Centro='".$_SESSION['Centro']."'";
	$his2BD->consulta($sql);
	$his2 =mysql_fetch_array($his2BD->Consulta_ID);

	$hismarcarBD = new DB_mysql ;
	$hismarcarBD->conectar();

//Cabecera Presentador
	$resto = "5180";			//Escribe Cod. Registro y Cod. Dato
  $regt = $regt + 1;
  $resto = $resto.rellenar($po['NIF_Presentador'],9,"0",'False');			//Lee la Entidad y Oficina
  $resto = $resto.rellenar($po['Sufijo_Presentador'], 3, "0", 'False'); //PARA FUENLABRADA EL SUFIJO ES 000
  $resto = $resto.date("dmy");
	$resto = $resto.String(6, " ");
	$resto = $resto.rellenar($po['Nombre_Presentador'], 40, " ", 'True');
	$resto = $resto.String(20, " ");
	$resto = $resto.rellenar($po['Entidad_Presentador'],4,"0",'False');
	$resto = $resto.rellenar($po['Oficina_Presentador'],4,"0",'False');
	$resto = $resto.String(12, " ").String(40, " ").String(14, " ");
   
	$Banco=$Banco.$resto;
  fwrite($FicBanco, $resto);		// y los escribe

	$Legible="Fecha de Cargo: ".$fec.chr(13).chr(10);
  $Legible=$Legible."Fecha Actual: ".date("d-F-Y").chr(13).chr(10);
  $Legible=$Legible.chr(13).chr(10);
  $Legible=$Legible."Presentador:".chr(13).chr(10);
  $Legible=$Legible."   Nombre:".$po['Nombre_Presentador'].chr(13).chr(10);
  $Legible=$Legible."   N.I.F.:".$po['NIF_Presentador'].chr(13).chr(10);
  $Legible=$Legible."   Banco: ".rellenar($po['Entidad_Presentador'], 4, "0", 'False')."/".rellenar($po['Oficina_Presentador'], 4, "0", 'False').chr(13).chr(10);
	
//   Cabecera de Ordenante
	$resto = "";
  $cabe = "";
  $resto = "5380";              //Escribe Cod. Registro y Cod. Dato
  $regt = $regt + 1;
  $cabe = rellenar($po['NIF_Ordenante'],9,"0",'False');          //Lee el NIF
  $cabe = $cabe.rellenar($po['Sufijo_Ordenante'], 3, "0", 'False');       //PARA FUENLABRADA EL SUFIJO ES 000
  $resto = $resto.$cabe;
  $resto = $resto.date("dmy"); //Escribe la fecha de confeción
  $resto = $resto.$fec;
  $resto = $resto.rellenar($po['Nombre_Ordenante'], 40, " ", 'True');
  $resto = $resto.rellenar($po['Entidad_Ordenante'],4,"0",'False');
  $resto = $resto.rellenar($po['Oficina_Ordenante'],4,"0",'False');
  $resto = $resto.rellenar($po['DC_Ordenante'],2,"0",'False');
  $resto = $resto.rellenar($po['N_Cuenta_Ordenante'],10,"0",'False');
  $resto = $resto.String(8, " ");
  $resto = $resto."01";
  $resto = $resto.String(10, " ").String(40, " ").String(14, " ");
	$Banco=$Banco.$resto;
  fwrite($FicBanco, $resto);		// y los escribe
	        
  $Legible=$Legible.chr(13).chr(10);
  $Legible=$Legible."Ordenante:".chr(13).chr(10);
  $Legible=$Legible."   Nombre:".$po['Nombre_Ordenante'].chr(13).chr(10);
  $Legible=$Legible."   N.I.F.:".$po['NIF_Ordenante'].chr(13).chr(10);
  $Legible=$Legible."   Banco: ".rellenar($po['Entidad_Ordenante'], 4, "0", 'False')."/".rellenar($po['oficina_ordenante'], 4, "0", 'False')."/".rellenar($po['DC_Ordenante'], 2, "0", 'False')."/".rellenar($po['N_Cuenta_Ordenante'], 10, "0", 'False').chr(13).chr(10);
	
	$hisBD = new DB_mysql ;
	$hisBD->conectar();
	$sql="SELECT Historico_Pagos.Pagado, Historico_Pagos.Cod, Alumnos.Nombre_Alumno, Alumnos.Direccion, Alumnos.Ciudad, Alumnos.Codigo_Postal, Historico_Pagos.Fecha_Ge, Banco.Titular, Historico_Pagos.Matricula, Historico_Pagos.Materiales, Historico_Pagos.Importe, Historico_Pagos.Cuota, Alumnos.Descuento, Historico_Pagos.Dto, Alumnos.Motivo_Dto, Banco.Codigo_Banco, Banco.Codigo_Oficina, Banco.Digito_Control, Banco.Numero_Cuenta, Alumnos.Pago, Historico_Pagos.Numero_Pago";
	$sql=$sql." FROM (Alumnos INNER JOIN Historico_Pagos ON Alumnos.Codi = Historico_Pagos.Cod) INNER JOIN Banco ON Alumnos.Codi = Banco.Cod";
	$sql=$sql." WHERE (Historico_Pagos.Pagado='NO')"; // AND Alumnos.Centro='".$_SESSION['Centro']."')";
	$sql=$sql." ORDER BY Alumnos.Nombre_Alumno, Historico_Pagos.Fecha_Ge";

	$hisBD->consulta($sql);
	$numrec = 0;
	while ($his =mysql_fetch_array($hisBD->Consulta_ID)) {
//   Individual Obligatorio
	 	for ($a=0;$a<=count($NumPagos)-1;$a+=1){
      if ($his[20] == $NumPagos[$a]){
      	$numrec = $numrec + 1;
        $resto = "";
        $resto = "5680";
        $regt = $regt + 1;
        $resto = $resto.$cabe;
        $reg = $reg + 1;
            
        $resto = $resto.rellenar($his['Cod'], 12, "0", 'False'); //--------------Codigo de referencia
        $resto = $resto.rellenar($his['Titular'], 40, " ", 'True');
        $resto = $resto.rellenar($his['Codigo_Banco'], 4, "0", 'False');
        if ($his['Digito_Control'] == "" or !isset($his['Digito_Control'])) $his['Digito_Control']=0;
        $resto = $resto.rellenar($his['Codigo_Oficina'], 4, "0", 'False');
        $resto = $resto.rellenar($his['Digito_Control'], 2, "0", 'False');
	      $resto = $resto.rellenar($his['Numero_Cuenta'], 10, "0", 'False');
				
				$sumaimp = Redondear($sumaimp + ($his['Matricula'] + $his['Materiales'] + $his['Cuota'] + $his['Dto']), 2);
        $resto = $resto.rellenar(Redondear($his['Matricula'] + $his['Materiales'] + $his['Cuota'] + $his['Dto'], 2) * 100, 10, "0", 'False');
        $resto = $resto.String(6, "0");  //Codigo Devolucion
        $resto = $resto.rellenar($his['Cod'], 10, "0", 'False');
            
				$resto = $resto."Clases:   ".rellenar($his['Cuota'], 28, " ", 'False')."  ";
        $resto = $resto.String(8, " ");
				
				$Banco=$Banco.$resto;
			  fwrite($FicBanco, $resto);		// y los escribe
            
				$Legible=$Legible.chr(13).chr(10);
        $Legible=$Legible."Codigo:".$his['Cod'].chr(13).chr(10);
        $Legible=$Legible."   Nombre Alumno:".$his['Nombre_Alumno'].chr(13).chr(10);
        $Legible=$Legible."   Direccion:".$his['Direccion'].chr(13).chr(10);
        $Legible=$Legible."   Ciudad:".$his['Ciudad'].chr(13).chr(10);
        $Legible=$Legible."   Codigo Postal:".$his['Codigo_Postal'].chr(13).chr(10);
				$Legible=$Legible.chr(13).chr(10);
        $Legible=$Legible."   Titular de Cuenta:".$his['Titular'].chr(13).chr(10);
        $Legible=$Legible."   Cuenta:".rellenar($his['Codigo_Banco'], 4, "0", 'False')."/".rellenar($his['Codigo_Oficina'], 4, "0", 'False')."/".rellenar($his['Digito_Control'], 2, "0", 'False')."/".rellenar($his['Numero_Cuenta'], 10, "0", 'False').chr(13).chr(10);
				$Legible=$Legible.chr(13).chr(10);
        $Legible=$Legible."Total:".($his['Matricula'] + $his['Materiales'] + $his['Cuota'] + $his['Dto']).chr(13).chr(10);
        $Legible=$Legible."   Matricula:".$his['Matricula'].chr(13).chr(10);
        $Legible=$Legible."   Material: ".$his['Materiales'].chr(13).chr(10);
        $Legible=$Legible."   Clases:".$his['Cuota'].chr(13).chr(10);
        if ($his['Dto']!=0){
        	$Legible=$Legible."   Descuento:".$his['Motivo_Dto'].chr(13).chr(10);
          $Legible=$Legible."   Cantidad de Descuento:".$his['Dto'].chr(13).chr(10);
				}
				
// Primero Opcional
				$resto = "";
        $resto = "5681";
        $regt = $regt + 1;
        $resto = $resto.$cabe;
        $resto = $resto.rellenar($his['Cod'], 12, "0", 'False');   //--------------Codigo de referencia
        $resto = $resto."Matricula:".rellenar(($his['Matricula']), 28, " ", 'False')."  ";
        $resto = $resto."Material: ".rellenar(($his['Materiales']), 28, " ", 'False')."  ";
            
        $resto = $resto.String(40, " ");
        $resto = $resto.String(14, " ");
				$Banco=$Banco.$resto;
			  fwrite($FicBanco, $resto);		// y los escribe

// Segundo Opcional
				$resto = "";
				$resto = "5682";
				$regt = $regt + 1;
				$resto = $resto.$cabe;
				$resto = $resto.rellenar($his['Cod'], 12, "0", 'False');	//--------------Codigo de referencia
				if ($his['Dto']!=0){
					$resto = $resto."Descuento:".rellenar($his['Dto'], 28, " ", 'False')."  ";
				}
				else{
					$resto = $resto.String(40, " ");
				}
				$resto = $resto.String(40, " ").String(40, " ").String(14, " ");
				$Banco=$Banco.$resto;
			  fwrite($FicBanco, $resto);		// y los escribe

// Sexto Opcional (El final)
				$resto = "";
				$resto = "5686";
				$regt = $regt + 1;
				$resto = $resto.$cabe;
										
				$resto = $resto.rellenar($his['Cod'], 12, "0", 'False');	//--------------Codigo de referencia
				$resto = $resto.rellenar($his['Nombre_Alumno'], 40, " ", 'True');
				$resto = $resto.rellenar($his['Direccion'], 40, " ", 'True');
				$resto = $resto.rellenar($his['Ciudad'], 35, " ", 'True');
				$resto = $resto.rellenar($his['Codigo_Postal'], 5, "0", 'False');
				$resto = $resto.String(14, " ");
				$Banco=$Banco.$resto;
			  fwrite($FicBanco, $resto);		// y los escribe

				//$sql="UPDATE Historico_Pagos SET Pagado='YES' WHERE Numero_Pago='".$NumPagos[$a]."'";
				//$hismarcarBD->consulta($sql);
			}
		}
	}
// Total Ordenante
	$resto = "";
	$resto = "5880";
	$regt = $regt + 1;
	$resto = $resto.$cabe;
	$resto = $resto.String(12, " ").String(40, " ").String(20, " ");
	$resto = $resto.rellenar(Redondear($sumaimp, 2) * 100, 10, "0", 'False');
	$resto = $resto.String(6, " ");
	$resto = $resto.rellenar(($reg), 10, "0", 'False');							
	$resto = $resto.rellenar(($regt - 1), 10, "0", 'False');							
	$resto = $resto.String(20, " ").String(18, " ");
	$Banco=$Banco.$resto;
	fwrite($FicBanco, $resto);		// y los escribe
		
// Total General
	$resto = "";
	$resto = "5980";
	$regt = $regt + 1;
	$resto = $resto.rellenar($po['NIF_Presentador'],9,"0",'False');          //Lee la Entidad y Oficina
	$resto = $resto.rellenar($po['Sufijo_Presentador'], 3, "0", 'False'); 	//PARA FUENLABRADA EL SUFIJO ES 000
	$resto = $resto.String(12, " ").String(40, " ");
	$resto = $resto."0001";
	$resto = $resto.String(16, " ");
	$resto = $resto.rellenar(Redondear($sumaimp, 2) * 100, 10, "0", 'False');
	$resto = $resto.String(6, " ");
	$resto = $resto.rellenar(($reg), 10, "0", 'False');
	$resto = $resto.rellenar(($regt), 10, "0", 'False');
	$resto = $resto.String(20, " ").String(18, " ");
			
	$Banco=$Banco.$resto;
	fwrite($FicBanco, $resto);		// y los escribe
							
	$Legible=$Legible."Total:".Redondear($sumaimp, 2).chr(13).chr(10);
	$Legible=$Legible."Nº Registro:".$numrec.chr(13).chr(10);
	fclose($FicBanco);
  fwrite($FicLegible, $Legible);		// y los escribe
	fclose($FicLegible);
	
?>
  <hr />
  <br />
  <form id="form1" name="form1" method="post" action="GenerarReciboBanco3.php">
    <table width="80%" border="0" align="center">
      <tr>
      	<td colspan="3">
          <strong>Total Registros:</strong> <?php echo count($NumPagos)  ?> <br  />        </td>
     	</tr>
      <tr>
        <td><div align="center"><strong>Para enviar al BANCO</strong></div></td>
        <td><div align="center">
          <input name="txtFechaCargo" type="hidden" id="txtFechaCargo" value="<?php echo $_POST['txtFechaCargo'] ?>" />
          <input type="hidden" name="txtNumPagos" id="txtNumPagos" value="<?php echo $_POST['txtNumPagos'] ?>"/>
        </div></td>
        <td><div align="center"><strong>Copia legible</strong></div></td>
      </tr>
      <tr>
        <td width="45%"><label>
          <div align="center">
            <textarea name="txtBanco" id="txtBanco" cols="45" rows="20"><?php echo $Banco ?></textarea>
          </div>
        </label></td>
        <td width="4%"><div align="center"></div></td>
        <td width="51%"><label>
          <div align="center">
            <textarea name="txtLegible" id="txtLegible" cols="45" rows="20"><?php echo $Legible ?></textarea>
          </div>
        </label></td>
      </tr>
      <tr>
        <td>
        	<div align="center">
        		<strong>
            	<a href="../FTP/<?php echo $_SESSION['Centro'] ?>Banco.dat" target="_blank" title="Pulse botón derecho 'Guardar Como'">Guardar Como</a>
						</strong>
          </div>
        </td>
        <td><div align="center"></div></td>
        <td>
        	<div align="center">
        		<strong>
            	<a href="../FTP/<?php echo $_SESSION['Centro'] ?>Legible.dat" target="_blank" title="Pulse botón derecho 'Guardar Como'">Guardar Como</a>
						</strong>
          </div>
      </tr>
      <tr>
        <td colspan="3"><div align="center"><strong><a href="javascript:PasarCobro()" title="Pulse una vez descargado los ficheros, para confirmar que los recibos son correctos.">Volcar a Cobros</a></strong></div></td>
      </tr>
    </table>
  </form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
