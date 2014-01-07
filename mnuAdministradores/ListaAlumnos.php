<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	$_SESSION['SQL']="";
	$_SESSION['SQL']=$_GET['Centro'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado de Alumnos - Gestor Academia</title>
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
       {name : "Codi"},
       {name : "Reserva"},
       {name : "Fecha_Al",type:'date'},
       {name : "Fecha_Co",type:'date'},
       {name : "Fecha_Ba",type:'date'},
       {name : "Nombre_Alumno"},
       {name : "Direccion"},
       {name : "Ciudad"},
       {name : "Codigo_Postal"},
       {name : "Telefono"},
       {name : "Movil"},
       {name : "Pago"},
       {name : "Grupo"},
       {name : "Materiales"},
       {name : "Descuento"},
       {name : "Motivo_Dto"},
       {name : "Procedencia"},
       {name : "Profesion_Estudios"},
       {name : "Necesidad"},
       {name : "Edad"},
       {name : "IDColegio"},
       {name : "Correo"},
       {name : "Cambios"},
       {name : "Observaciones"},
			 {name : "Centro"}
    ],
    recordType : 'object'
}

var colsOption = [
	{id : "Codi" , header: "Codigo" , width :70,readonly:false},
	{id : "Reserva" , header: "Reserva" , width :60, align : 'center',readonly:false},
	{id : "Fecha_Al" , header: "Fecha Alta" , width :80,readonly:false},
	{id : "Fecha_Co" , header: "Fecha Comienzo" , width :80,readonly:false},
	{id : "Fecha_Ba" , header: "Fecha Baja" , width :80,readonly:false},
	{id : "Nombre_Alumno" , header: "Nombre Alumnos" , width :200,readonly:false},
	{id : "Direccion" , header: "Direccion" , width :160,readonly:false},
	{id : "Ciudad" , header: "Ciudad" , width :90,readonly:false},
	{id : "Codigo_Postal" , header: "C. Postal" , width :60,readonly:false},
	{id : "Telefono" , header: "Telefono" , width :80,readonly:false},
	{id : "Movil" , header: "Movil" , width :80,readonly:false},
	{id : "Pago" , header: "Pago" , width :60, align : 'center',readonly:false},
	{id : "Grupo" , header: "Grupo" , width :80,readonly:false},
	{id : "Materiales" , header: "Materiales" , width :60, align : 'center',readonly:false},
	{id : "Descuento" , header: "Descuento" , width :60, align : 'center',readonly:false},
	{id : "Motivo_Dto" , header: "Motivo Dto." , width :60, align : 'center',readonly:false},
	{id : "Procedencia" , header: "Procedencia" , width :60, align : 'center',readonly:false},
	{id : "Profesion_Estudios" , header: "Profesion" , width :60,readonly:false},
	{id : "Necesidad" , header: "Necesidad" , width :60, align : 'center',readonly:false},
	{id : "Edad" , header: "Edad" , width :60,readonly:false},
	{id : "IDColegio" , header: "id Colegio" , width :80,readonly:false},
	{id : "Correo" , header: "Correo" , width :60,readonly:false},
	{id : "Cambios" , header: "Cambios" , width :60,readonly:false},
	{id : "Observaciones" , header: "Observaciones" , width :260,readonly:false},
	{id : "Centro" , header : "Centro",width :100, readonly:false, hidden:true}
];

var gridOption={
	id : "mygrid1",
	width: "95%",
	height: "300",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDListaAlumnos.php",
	saveURL : "BD/BDListaAlumnos.php",
	exportURL : "BD/BDListaAlumnos.php?export=true",
	exportFileName : 'ListaAlumnos',
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | nav | print xls',
	pageSize : 100
};
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Listado de Alumnos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<table width="100%" border="0">
  <tr>
    <td>
<?php
	if ($_SESSION['NombrePermiso']=="Administrador"){
?>
      <strong>Centro:</strong>
      <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <option value="ListaAlumnos.php">-- Totos los Centros --</option>
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT Codigo, NombreCentro FROM Centros";
		$miconexion->consulta($sql);
		while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
			echo "          <option value='ListaAlumnos.php?Centro=".$row['Codigo']."'";
			if ($_GET['Centro']==$row['Codigo']) echo " selected ";
			echo ">".$row['NombreCentro']."</option>\n";
		}
?>
      </select>
<?php
	}
?>
			&nbsp;
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
