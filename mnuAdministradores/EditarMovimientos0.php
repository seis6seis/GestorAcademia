<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	$_SESSION['SQL']=$_GET['Codigo'];
	
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editar Movimientos - Gestor Academia</title>
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
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
       {name : "idMovi"},
       {name : "idCuenta"},
       {name : "idTipo"},
       {name : "Fecha"},
       {name : "Descripcion"},
       {name : "Haber"},
       {name : "Debe"},
       {name : "Centro"}
    ],
    recordType : 'object'
}


var colsOption = [
	{id : "idMovi" , header: "idMovi" , width :80, editor:{type:"text"}},
	{id : "idCuenta" , header: "idCuenta" , width :80, editor:{type:'select', options:{
<?php
	$sql="SELECT IDCuenta, Descripcion FROM Cuentas WHERE Centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	$Con=0;
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		if($Con!=0) echo ",";
		$Con=1;
		echo "'".$row['IDCuenta']."':'".$row['Descripcion']."'";
	}
	echo "}}},";
?>
	{id : "idTipo" , header: "idTipo" , width :80, editor:{type:'select', options:{
<?php
	$sql="SELECT Cod, Descripcion FROM Tipos";
	$miconexion->consulta($sql);
	$Con=0;
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		if($Con!=0) echo ",";
		$Con=1;
		echo "'".$row['Cod']."':'".$row['Descripcion']."'";
	}
	echo "}}},";
?>
	{id : "Fecha" , header: "Fecha" , width :80, editor:{type:"text"}},
	{id : "Descripcion" , header: "Descripcion" , width :80, editor:{type:"text"}},
	{id : "Haber" , header: "Haber" , width :80, editor:{type:"text"}},
	{id : "Debe" , header: "Debe" , width :80, editor:{type:"text"}},
	{id : "Centro" , header: "Centro" , width :80}
];

var gridOption={
	id : "mygrid1",
	width: "95%",
	height: "400",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDMovimientos.php",
	saveURL : "BD/BDMovimientos.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btndel btnsave | filter | print',
	pageSize : 50000
};
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

// Para el segundo Grid (Recibos Cobrados
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Anadir Nota.',
		action : function(event,grid) {
			grid.add();
		}
	}
);

Sigma.ToolFactroy.register(
	'btndel',  
	{
		cls : 'clsDelete',  
		toolTip : 'Borrar Nota.',
		action : function(event,grid) {
			grid.del();	
		}
	}
);

Sigma.ToolFactroy.register(
	'btnsave',  
	{
		cls : 'clsSave',  
		toolTip : 'Grabar cambios en las Notas.',
		action : function(event,grid) {
			grid.save();
		}
	}
);

Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { 
			grid.reload();
			grid.save();
		}
	}
);
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Movimientos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<table width="100%" border="0">
  <tr>
    <td>
      <strong>Centro a Editar:</strong>
      <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <option>&nbsp;</option>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Codigo, NombreCentro FROM Centros";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "          <option value='EditarMovimientos0.php?Codigo=".$row['Codigo']."'";
		if ($_GET['Codigo']==$row['Codigo']) echo " selected ";
		echo ">".$row['NombreCentro']."</option>\n";
	}
?>
      </select>
    </td>
  </tr>
  <tr>
    <td>
      <div id="bigbox" style="margin:15px;display:!none">
        <div id="mygrid1" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>
      </div>
    </td>
  </tr>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>