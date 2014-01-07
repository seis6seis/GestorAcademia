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
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
			{name : "Nombre_Alumno"},
			{name : "Si"},
			{name : "Fecha_Co"},
			{name : "Fecha_Ba"},
			{name : "PrecioLibro"},
			{name : "MaterialCobrada"}
    ],
    recordType : 'object'
}
function render_edit(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit' value='"+rowNo+"' id='Edit' />";
}
function render_Haber(value ,record,columnObj,grid,colNo,rowNo){
	var Saldo=0;

	Haber=Haber+parseFloat(value);
	document.getElementById('txtHaber').value =Haber.toFixed(2)+ " €";//(Math.round(value*100)/100,2);
	Saldo=Haber-Debe;
	document.getElementById('txtSaldo').value =Saldo.toFixed(2) + " €";
	return value;
}
function render_Debe(value ,record,columnObj,grid,colNo,rowNo){
	var Saldo=0;
	
	Debe=Debe+parseFloat(value);
	document.getElementById('txtDebe').value =Debe.toFixed(2)+ " €";
	Saldo=Haber-Debe;
	document.getElementById('txtSaldo').value =Saldo.toFixed(2) + " €";
	return value;
}

var colsOption = [
	{id : "Nombre_Alumno",header: "Nombre Alumno",width:100,readonly:false,hidden:true},
	{id : "Si",header: "Si",width:80,readonly:false,hidden:true},
	{id : "Fecha_Co" , header: "Fecha Co" , width :79, readonly:false},
	{id : "Fecha_Ba" , header: "Fecha Ba" , width :79, readonly:false},
	{id : "PrecioLibro",header: "PrecioLibro ",width:80,readonly:false,align: 'left'},
	{id : "MaterialCobrada" , header: "MaterialCobrada" , width :80,readonly:false,align: 'left'}
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
	width: "545",
	height: "300",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDCobroLibros.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnadd<?php if($_SESSION['Permiso']==1) echo " btnedit" ?> | filter | print',
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Control Cobro Libros<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:100%;" >
  </div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
