<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
?>
<?php
	$IngReales=0;
	$IngBanco=0;
	$GasMetalico=0;
	$DevCobradasCaja=0;
	$DevAnotadasCB=0;
	$TotalCobros1=0;
	$TotalCobros2=0;
	
	// Obtiene los Ingresos Reales
	$sql="SELECT Sum(Cuota+Dto+Materiales+Matricula) AS Expr1 FROM Cobros WHERE Centro='".$_SESSION['Centro']."' AND (Fecha_Cobro Between '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."') AND Pagado='YES' AND Fecha_De='0000-00-00'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	$IngReales=$row['Expr1'];//$row['sCuota']+$row['sDto']+$row['sMateriales']+$row['sMatricula'];

	//Obtiene los ingresos Banco
	$sql="SELECT Sum(Haber-Debe) AS Expr1 FROM Movimientos WHERE Centro='".$_SESSION['Centro']."' AND idCuenta Like '".$_SESSION['Centro']."CB%' AND (idTipo='IN' Or idTipo='DE') AND (Fecha Between '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."')";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	$IngBanco=$row['Expr1'];
	
	// Obtiene "Gastos Metalico"
	$sql="SELECT Sum(Debe) AS Expr1 FROM Movimientos WHERE Centro='".$_SESSION['Centro']."' AND idTipo<>'IN' AND idCuenta='".$_SESSION['Centro']."CAJA' AND (Fecha Between '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."')";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	$GasMetalico=$row['Expr1'];

	//Obtiene "Devolucion cobradas en Caja"
	//=DSuma("[haber]";"Movimientos";"[idtipo]='de'")
	$sql="SELECT SUM(Haber) AS Expr1 FROM Movimientos WHERE Centro='".$_SESSION['Centro']."' AND idTipo='DE' AND (Fecha BETWEEN '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."')";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	$DevCobradasCaja=$row['Expr1'];

	// Obtiene "Devoluciones anotadas CB"
	$sql="SELECT Sum(Debe) AS Expr1 FROM Movimientos WHERE Centro='".$_SESSION['Centro']."' AND idCuenta Like '".$_SESSION['Centro']."CB%' AND idTipo='DE' AND (Fecha Between '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."')";
	//	$sql="SELECT SUM(Importe) AS Simporte FROM Movimientos WHERE Centro='".$_SESSION['Centro']."' AND Metalico='YES' AND (Fecha_Cobro BETWEEN '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."') ORDER BY Fecha_Cobro ASC";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	$DevAnotadasCB=$row['Expr1'];
	
	// Obtiene "Total devoluciones cobradas en cobros"
	$sql="SELECT Sum(Dto+Cuota+Materiales+Matricula) AS Expr2 FROM Cobros WHERE Centro='".$_SESSION['Centro']."' AND Fecha_De<>'0000-00-00' AND (Fecha_Cobro Between '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."')";
	//$sql="SELECT SUM(Importe) AS Simporte FROM Cobros WHERE Centro='".$_SESSION['Centro']."' AND Fecha_De<>'0000-00-00' AND (Fecha_Cobro BETWEEN '".cambiarfecha($_GET['FecInicial'])."' AND '".cambiarfecha($_GET['FecFinal'])."') ORDER BY Fecha_Cobro ASC";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	$TotalCobros1=$row['Expr2'];
	
	//Calcular Total 
	$TotalCobros2=$DevAnotadasCB-$TotalCobros1;
	//$Total=$Total-floatval($GasMetalico);//$IngBanco+$TotalCobros2+$GasMetalico+$DevCobradasCaja;
	//ing. reales-ingban-gameta-(caja ini-caja fin)
	// +(ImporteTablaFinal-ImporteTablaInicio)
	//=([ingresos en banco]![expr1]+[Texto38]+[gastos en metalico]![EXPR1]+[GASTOS EN METALICO].[Formulario]![Texto5]+([ferango1]![caja]-[ferango]![caja]))-[expr1]		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Balance - Gestor Academia</title>
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

<script type="text/javascript">
function render_edit(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit1' value='Edit1' id='Edit1'"+rowNo+" />";
}
function render_edit2(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit2' value='Edit2' id='Edit2'"+rowNo+" />";
}

var dsOption= {
    fields :[
			{name : "Edit"},
			{name : "id"},
			{name : "Fecha"},
			{name : "Caja"},
			{name : "Centro"}
    ],
    recordType : 'object'
} 

var colsOption = [
	{id: 'Edit' , header: "Edit" , width :27, filterable: false, exportable:false, renderer:render_edit},
	{id : "id" , header: "id" , width :180,readonly:false},
	{id : "Fecha" , header: "Fecha" , width :120, align : 'right', editor:{type:"text"}},
	{id : "Caja" , header: "Caja" , width :120,  align : 'right', editor:{type:"text"}},
	{id : "Centro" , header: " " , width :1,readonly:false}
];

var dsOption2= {
    fields :[
			{name : "Edit"},
			{name : "id"},
			{name : "Fecha"},
			{name : "Caja"},
			{name : "Centro"}
    ],
    recordType : 'object'
} 

var colsOption2 = [
	{id: 'Edit' , header: "Edit" , width :27, filterable: false, exportable:false, renderer:render_edit2},
	{id : "id" , header: "id" , width :180,readonly:false},
	{id : "Fecha" , header: "Fecha" , width :120, align : 'right', editor:{type:"text"}},
	{id : "Caja" , header: "Caja" , width :120,  align : 'right', editor:{type:"text"}},
	{id : "Centro" , header: " " , width :1,readonly:false}
];

Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Permite Añadir.',
		action : function(event,grid) {
			grid.add();
			grid.save();
			mygrid.reload();
			mygrid2.reload();
		}
	}
);
Sigma.ToolFactroy.register(
	'btnedit',  
	{
		cls : 'clsEdit',  
		toolTip : 'Permite Editar.',
		action : function(event,grid) {
		}
	}
);
Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { location.reload() }
	}
);
Sigma.ToolFactroy.register(
	'btndel',  
	{
		cls : 'clsDelete',  
		toolTip : 'Borrar.',
		action : function(event,grid) {
			grid.del();
			mygrid.reload();
			mygrid2.reload();
		}
	}
);

Sigma.ToolFactroy.register(
	'btnsave',  
	{
		cls : 'clsSave',  
		toolTip : 'Grabar Cambios.',
		action : function(event,grid) {
			grid.save();
			mygrid.reload();
			mygrid2.reload();
		}
	}
);

var gridOption={
	id : "mygrid1",
	width: "98%",
	height: "200",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDBalance.php",
	saveURL : "BD/BDBalance.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | btnadd btnsave | filter | print',
	pageSize : 50000,
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		if (colNO==0){
			Caja1=mygrid.getColumnValue('Caja',rowNO);
			Actualizar();
		}
	}
};

var gridOption2={
	id : "mygrid2",
	width: "98%",
	height: "200",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDBalance.php",
	saveURL : "BD/BDBalance.php",
	container : 'gridbox2',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | btnadd btnsave | filter | print',
	pageSize : 50000,
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		if (colNO==0){
			Caja2=mygrid2.getColumnValue('Caja',rowNO);
			Actualizar();
		}
	}
};
var Caja1=0;
var Caja2=0;

var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

var mygrid2=new Sigma.Grid(gridOption2);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid2));
</script>  
<style type="text/css">
<!--
	 .clsAdd { 
		background : url(../Imagenes/Iconos/form_add.png) no-repeat center center; 
		}
	 .clsSave { 
		background : url(../Imagenes/Iconos/grabar.png) no-repeat center center; 
		}
	.clsRefresh { 
		background : url(../grid/skin/default/images/tool_reload.gif) no-repeat center center; 
		}
	.clsDelete{
		background : url(../Imagenes/Iconos/form_delete.png) no-repeat center center; {
		}
.gt-head-div {
  height:20px;
}
.gt-inner {
	height:18px;
}
-->
</style>

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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Comprobación del balance según fechas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<script type="text/javascript">
var Total=0;
function formatCurrency(num)
{
	num = num.toString().replace(/\$|\,/g,'');
	
	if (isNaN(num))
	num = 0;
	
	var signo = (num == (num = Math.abs(num)));
	num = Math.floor(num * 100 + 0.50000000001);
	centavos = num % 100;
	num = Math.floor(num / 100).toString();
	
	if (centavos < 10)
	centavos = '0' + centavos;
	
	for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
	num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
	
	return (((signo) ? '' : '-') +  num + ',' + centavos);
}

function Actualizar(){
	
	document.form1.txtIngReales.value='<?php echo number_format($IngReales, 2, ",", "."); ?> €';
	document.form1.txtIngBanco.value='<?php echo number_format($IngBanco, 2, ",", "."); ?> €';
	document.form1.txtGasMetalico.value='<?php echo number_format($GasMetalico, 2, ",", "."); ?> €';
	document.form1.txtDevCobradasCaja.value='<?php echo number_format($DevCobradasCaja, 2, ",", "."); ?> €';
	document.form1.txtDevAnotadasCB.value='<?php echo number_format($DevAnotadasCB, 2, ",", "."); ?> €';
	document.form1.txtTotalCobros1.value='<?php echo number_format($TotalCobros1, 2, ",", "."); ?> €';
	document.form1.txtTotalCobros2.value='<?php echo number_format($DevAnotadasCB-$TotalCobros1, 2, ",", "."); ?> €';
	//[devoluciones en CB].[Formulario]![Expr1]-[devoluciones en CB1].[Formulario]![Expr1]
	//ing. reales-ingban-gameta-(caja ini-caja fin)
	Total=<?php echo $IngReales-$IngBanco-$GasMetalico; ?>;
	document.form1.textfield2.value=formatCurrency(Total-(Caja2-Caja1))+" €";//Total+(Caja2-Caja1))+" €";
	//(parseInt(document.form1.txtIngBanco.value)+parseInt(document.form1.txtTotalCobros2.value)+parseInt(document.form1.txtGasMetalico.value)+parseInt(document.form1.txtDevCobradasCaja.value))+'€';
	//([ingresos en banco]![expr1]+[Texto38]+[gastos en metalico]![EXPR1]+[GASTOS EN METALICO].[Formulario]![Texto5]+([ferango1]![caja]-[ferango]![caja]))-[expr1];
}
</script>
  <hr />
<form name="form1" id="form1">
  <table width="95%" border="0" align="center">
    <tr>
      <td colspan="3">
        <input name="textfield" type="text" id="textfield" value="<?php echo "Balance entre las fechas ".$_GET['FecInicial']." y ".$_GET['FecFinal'] ?>" size="50" readonly />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="textfield2" type="text" id="textfield2" value="" style="text-align:right" readonly />
        <label></label></td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="15%">&nbsp;</td>
      <td width="60%">&nbsp;</td>
    </tr>
    <tr>
      <td>
      	<strong>Ingresos Reales:</strong>      </td>
      <td>
        <input name="txtIngReales" type="text" id="txtIngReales" size="10" style="text-align:right" />      </td>
      <td bordercolor="#000000" bgcolor="#00FFFF">
      	Es el resultado de sumar CUOTAS, DTO, MATRICULAs y MATERIALES en la tabla COBROS no considera los registros que poseer FECHA_DE      </td>
    </tr>
    <tr>
      <td>
      	<strong>Ingresos en Banco:</strong>      </td>
      <td>
        <input name="txtIngBanco" type="text" id="txtIngBanco" size="10" style="text-align:right" />      </td>
      <td bordercolor="#000000" bgcolor="#00FFFF">
      	Solo considera los codigos IN y los codigos  DE de cualquier cuenta bancaria      </td>
    </tr>
    <tr>
      <td><strong>Gastos Metalico:<br />
      Devoluciones Cobradas en caja:</strong></td>
      <td>
        <input name="txtGasMetalico" type="text" id="txtGasMetalico" size="10" style="text-align:right" />
        <br />
        <input name="txtDevCobradasCaja" type="text" id="txtDevCobradasCaja" size="10" style="text-align:right" />      </td>
      <td bordercolor="#000000" bgcolor="#00FFFF">
	      Considra todos los gastos excepto los codigos IN de la cuenta caja. Las devoluciones cobradas en caja tipificar como DE      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Devoluciones anotadas en CB:</strong></td>
      <td>
        <input name="txtDevAnotadasCB" type="text" id="txtDevAnotadasCB" size="10" style="text-align:right" />
      </td>
      <td>
        <strong>Total devo. cobradas en COBROS:</strong>
        <input name="txtTotalCobros1" type="text" id="txtTotalCobros1" size="10" style="text-align:right" />
        <input name="txtTotalCobros2" type="text" id="txtTotalCobros2" size="10" style="text-align:right" />
      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
		<td colspan="3">
        	<table width="98%">
       	  		<tr>
                	<td width="50%"><div align="center"><strong>Fechas e importes de Inicio</strong></div></td>
                	<td width="50%"><div align="center"><strong>Fechas e importes de Fin</strong></div></td>
       	  		</tr>
       	  		<tr>
                	<td width="50%">
                     	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>                    </td>
                	<td width="50%">
                    	<div id="gridbox2" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>                    </td>
       	  		</tr>
            </table>            
	  </td>
    </tr>
  </table>
<br />
	<div><script language="javascript">Actualizar();</script></div>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
