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

<script type="text/javascript">
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
       {name : "Grupo"},
       {name : "Centro"},
       {name : "Programa"},
       {name : "HorasSemana"},
       {name : "Horarios"},
       {name : "Profesor"},
       {name : "Matriculas"},
       {name : "Materiales"},
       {name : "CuotasMes"},
       {name : "CuotasTrim"},
       {name : "CuotasCuat"},
       {name : "CuotasAno"}
    ],
    recordType : 'object'
} 
function render_edit(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit' value='"+rowNo+"' id='Edit' />";
}
function render_materiales(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Materiales' value='"+rowNo+"' id='Materiales' onclick='this.checked = !this.checked' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
function render_descuento(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Descuento' value='"+rowNo+"' id='Descuento' onclick='this.checked = !this.checked'  ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id : "Centro" , header: " " , width :1, readonly:false},
	{id: 'Grupo' , header: "Grupo" , width :45, editor:{type:"text"}},
	{id : "Programa" , header: "Programa" , width :60, editor:{type:"text"}},
	{id : "HorasSemana" , header: "H. Semana" , width :80, editor:{type:"text"}},
	{id : "Horarios" , header: "Horarios" , width :80, editor:{type:"text"}},
	{id : "Profesor" , header: "Profesor" , width :80, editor:{type:'select', options:{
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Usuario, NombreCompleto FROM Usuarios WHERE Centro='".$_SESSION['Centro']."' AND Permisos='3'";
	$miconexion->consulta($sql);
	$Pos=0;
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		if ($Pos!=0){ echo ", "; }
		echo "'".$row['Usuario']."': '".$row['NombreCompleto']."'";
		$Pos=1;
	}
?>
	}}},
	{id : "Matriculas" , header: "Matriculas" , width :80, editor:{type:"text"}},
	{id : "Materiales" , header: "Materiales" , width :80, editor:{type:"text"}},
	{id : "CuotasMes" , header: "Cuotas Mes" , width :80, editor:{type:"text"}},
	{id : "CuotasTrim" , header: "Cuotas Trim" , width :80, editor:{type:"text"}},
	{id : "CuotasCuat" , header: "Cuotas Cuat." , width :80, editor:{type:"text"}},
	{id : "CuotasAno" , header: "Cuotas Año" , width :80, editor:{type:"text"}}
];

// Para el segundo Grid (Recibos Cobrados
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Anadir',
		action : function(event,grid) {
			grid.add();
		}
	}
);

Sigma.ToolFactroy.register(
	'btndel',  
	{
		cls : 'clsDelete',  
		toolTip : 'Borrar.',
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

var gridOption={
	id : "mygrid1",
	width: "99%",
	height: "320",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDListaGrupos.php",
	saveURL : "BD/BDListaGrupos.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | btnadd btndel btnsave | filter | print',
	pageSize : 50000,
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		if (colNO==0) gridRow=rowNO;
	}
};

var gridRow=-1;
var FiltroAutomatico=false;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Grupos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:300px;width:100%;" ></div>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
