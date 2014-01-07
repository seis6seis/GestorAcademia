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
<title>Generar Recibo Banco - Gestor Academia</title>
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
<div>
  <script type="text/javascript">
function SelMensuales(){
	var cont=0;
	while(mygrid.getColumnValue('Pago',cont)!=null){
		if(mygrid.getColumnValue('Pago',cont)=='ME_B') 	document.getElementById('Edit'+cont).checked=!document.getElementById('Edit'+cont).checked;
		cont++;
	}
}
function SelTrimestrales(){
	var cont=0;
	while(mygrid.getColumnValue('Pago',cont)!=null){
		if(mygrid.getColumnValue('Pago',cont)=='TR_B') 	document.getElementById('Edit'+cont).checked=!document.getElementById('Edit'+cont).checked;
		cont++;
	}
}
function SelCuatrimestrales(){
	var cont=0;
	while(mygrid.getColumnValue('Pago',cont)!=null){
		if(mygrid.getColumnValue('Pago',cont)=='CU_B') 	document.getElementById('Edit'+cont).checked=!document.getElementById('Edit'+cont).checked;
		cont++;
	}
}
function SelAnual(){
	var cont=0;
	while(mygrid.getColumnValue('Pago',cont)!=null){
		if(mygrid.getColumnValue('Pago',cont)=='AN_B') 	document.getElementById('Edit'+cont).checked=!document.getElementById('Edit'+cont).checked;
		cont++;
	}
}
function SelTodo(){
	var cont=0;
	while(mygrid.getColumnValue('Pago',cont)!=null){
		document.getElementById('Edit'+cont).checked=!document.getElementById('Edit'+cont).checked;
		cont++;
	}
}
function SelGrabar(){
	var FCargo=document.getElementById('txtFechaCargo').value;
	if (FCargo.length==6){
		var cont=0;
		var cont1=0;
		var ret=new Array();
		
		document.getElementById('divGenerar').style.visibility="visible";
		while(mygrid.getColumnValue('Pago',cont)!=null){
			if(document.getElementById('Edit'+cont).checked==true){
				ret[cont1]=mygrid.getColumnValue('Numero_Pago',cont);
				//alert(mygrid.getColumnValue('Numero_Pago',cont));
				cont1++;
			}
			cont++;
		}
		document.getElementById('divGenerar').style.visibility="hidden";
		document.form1.txtNumPagos.value=ret;
		document.form1.submit(); 
	}
	else{
		alert("Se necesita rellenar la <Fecha de Cargo> en formato 'DDMMAA'");
	}
}

var dsOption= {
    fields :[
			{name : "Edit"},
			{name : "Numero_Pago"},
			{name : "Nombre_Alumno"},
			{name : "Pago"},
			{name : "Pagado"},
			{name : "Titular"},
			{name : "Importe"},
			{name : "Matricula"},
			{name : "Dto"},
			{name : "Cuota"},
			{name : "Materiales"},
			{name : "Fecha_Ge"},
			{name : "Codi"}
    ],
    recordType : 'object'
}
function render_edit(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='checkbox' name='Edit"+rowNo+"' value='"+rowNo+"' id='Edit' />";
}
function render_pagado(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Pagado' value='"+rowNo+"' id='Pagado' onclick='this.checked = !this.checked' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id : "Edit" , header: "Edit" , width :30, align: 'center', readonly:false, renderer:render_edit},
	{id : "Numero_Pago" , header: "Numero Pago" , width :150, align: 'right', readonly:false},
	{id : "Nombre_Alumno" , header: "Nombre Alumno" , width :200, readonly:false},
	{id : "Pago" , header: "Pago" , width :40, align: 'center', readonly:false},
	{id : "Pagado" , header: "Pagado" , width :50, align: 'center', readonly:false, renderer:render_pagado},
	{id : "Titular" , header: "Titular" , width :200, readonly:false},
	{id : "Importe" , header: "Importe" , width :60, align: 'right', readonly:false},
	{id : "Matricula" , header: "Matricula" , width :60, align: 'right', readonly:false},
	{id : "Dto" , header: "Dto" , width :60, align: 'right', readonly:false},
	{id : "Cuota" , header: "Cuota" , width :60, align: 'right', readonly:false},
	{id : "Materiales" , header: "Materiales" , width :70, align: 'right', readonly:false},
	{id : "Fecha_Ge" , header: "Fecha Ge" , width :80, readonly:false},
	{id : "Codi" , header: "Codi" , width :80, readonly:false}
];
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Permite Añadir movimiento de cuenta.',
		action : function(event,grid) { popup('ApunteNuevo0.php?Centro=<?php echo $_SESSION['Centro'] ?>', 500, 250,"no") }
	}
);
Sigma.ToolFactroy.register(
	'btnedit',  
	{
		cls : 'clsEdit',  
		toolTip : 'Permite Editar movimiento de cuenta.',
		action : function(event,grid) {
			if (gridRow!=-1){
				popup("ApunteModificar0.php?Codigo="+mygrid.getColumnValue('idMovi',gridRow)+"&Centro=<?php echo $_SESSION['Centro'] ?>",500,250,"no");
			}
			else{
				alert("Necesita seleccionar un alumno a modificar.");
			}
		}
	}
);
Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { Debe=0;Haber=0;grid.reload(); }
	}
);

var gridOption={
	id : "mygrid1",
	width: "770",
	height: "400", //400
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDReciboBanco0.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | filter | print | state',
	pageSize : 50000,
	onComplete:function(grid){
		FiltroAutomatico=true;
	},
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		if (colNO==0) gridRow=rowNO;
	}
};
var gridRow=-1;
var Debe=0;
var Haber=0;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
</script>
</div>  
<style type="text/css">
<!--
 .clsAdd { 
		background : url(../Imagenes/Iconos/form_add.png) no-repeat center center; 
		}
 .clsEdit { 
		background : url(../Imagenes/Iconos/form_edit.png) no-repeat center center; 
		}
	.clsRefresh { 
		background : url(../grid/skin/default/images/tool_reload.gif) no-repeat center center; 
		}

.gt-head-div {
  height:20px;
}
.gt-inner {
	height:18px;
}
.inputText{
text-align:right;
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Generar Recibo Banco<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
 	<form id="form1" name="form1" method="post" action="GenerarReciboBanco1.php">
    <div align="center">
      <strong><br />
        <a href="javascript:SelMensuales()">Mensuales</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:SelTrimestrales()">Trimestrales</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:SelCuatrimestrales()">Cuatrimestrales</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:SelAnual()">Anual</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:SelTodo()">Todo</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Fecha Cargo:
        <input name="txtFechaCargo" type="text" id="txtFechaCargo" value="<?php echo date("dmy") ?>" size="6" maxlength="6" />
        </label>
        <a href="javascript:SelGrabar()">Grabar</a>       </strong>
      <br />
    </div>
		<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:790;" >	</div>
	  <div id="BoxBanco" style="position:absolute; width:770px; height:400px; top:92px; left:5px; background-color:gray; visibility:hidden; z-index: 0;">
      <div align="center"><font color="#FFFFFF">
        <textarea name="txtNumPagos" id="txtNumPagos" cols="52" rows="10"></textarea>
      </div>
	  </div>
    <div id="divGenerar" style="position:absolute; width:410px; height:50px; top:257px; left:169px; background-color:gray; visibility:hidden; z-index: 2;">
    	<p align="center" class="TituloPrincipal"><br />Generando Recibos, Espere ...</p>
    </div>

 	</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
