<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require("../Connections/funciones.php");
	
	$_SESSION['SQL']=" WHERE idAlumno='".$_SESSION['Centro'].$_GET['txtCodigo']."'";

	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT * FROM Alumnos WHERE Codi='".$_SESSION['Centro'].$_GET['txtCodigo']."' ORDER BY Codi ASC";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
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
<link rel="stylesheet" type="text/css" media="all" href="../grid/calendar/calendar-blue.css"  />
<script type="text/javascript" src="../grid/calendar/calendar.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-en.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../grid/gt_msg_sp.js"></script>
<script type="text/javascript" src="../grid/gt_const.js"></script>
<script type="text/javascript" src="../grid/gt_grid_all.js"></script>

<script type="text/javascript">
function Filtro(Registro){
	var filterInfo=[
		{
			fieldName : "idAlumno",
			logic : "startWith",
			value : Registro
		}
	]
	var grid2=Sigma.$grid("mygrid2");
	var rowNOs=grid2.filterGrid(filterInfo); 
}

var dsOption= {
    fields :[
      {name : 'idRegistro'},
			{name : 'idAlumno'},
			{name : 'Fecha'},
      {name : 'Interna'},
      {name : 'EnSuColegio'}
    ],
    recordType : 'object'
} 

var colsOption = [
	{id : "idRegistro", header : "idRegistro", width :150},
	{id : "idAlumno" , header: "idAlumno" , width :75},
	{id : "Fecha" , header: "Fecha" , width :100, editor:{type:"text"}},
	{id : "Interna" , header: "Interna" , width: 80, align : 'right', editor:{type:"text"}},
	{id : "EnSuColegio" , header: "En su Colegio" , width :80, align : 'right', editor:{type:"text"}}
];

Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Anadir Nota.',
		action : function(event,grid) {
			if (CodigoSelec!='<?php echo $_SESSION['Centro'] ?>') grid.add();	
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

var gridOption={
	id : "mygrid1",
	width: "99%",
	height: "230",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDRegistroAcademicos2.php",
	saveURL : 'BD/BDRegistroAcademicos2.php',
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnadd btndel btnsave | filter | print',
	pageSize : 50000,
	onClickCell  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (CodigoSelec!='<?php echo $_SESSION['Centro'] ?>' && colNO==1){
			var f=new Date();
			var dia=f.getDate();
			var mes=f.getMonth()+1;
			if (dia<10) dia='0'+dia;
			if (mes<10) mes='0'+mes;
			var fecha=dia + '-' + mes + '-' + f.getFullYear();
			record['idAlumno']=CodigoSelec;
			record['Fecha']=fecha;
			grid.save();
		}
	}
};

var CodigoSelec='<?php echo $_SESSION['Centro'].$_GET['txtCodigo'] ?>';
var gridRow=-1;
var rowSelec=-1;
var colSelec=-1;

var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

// Para el segundo Grid (Recibos Cobrados
var dsOption2= {
    fields :[
      {name : 'idApoyo'},
			{name : 'idAlumno'},
			{name : 'Fecha'},
      {name : 'Contenido'}
    ],
    recordType : 'object'
} 

var colsOption2 = [
	{id : "idApoyo", header : "idApoyo", width :150},
	{id : "idAlumno" , header: "idAlumno" , width :75},
	{id : "Fecha" , header: "Fecha" , width :100, editor:{type:"text"}},
	{id : "Contenido" , header: "Contenido" , width: 430, editor:{type:"text"}}
];

var gridOption2={
	id : "mygrid2",
	width: "99%",
	height: "230",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDApoyo.php",
	saveURL : 'BD/BDApoyo.php',
	container : 'gridbox2',
	dataset : dsOption2 ,
	columns : colsOption2,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnadd btndel btnsave | filter | print',
	onClickCell:function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (CodigoSelec!='<?php echo $_SESSION['Centro'] ?>' && colNO==1){
			var f=new Date();
			var dia=f.getDate();
			var mes=f.getMonth()+1;
			if (dia<10) dia='0'+dia;
			if (mes<10) mes='0'+mes;
			var fecha=dia + '-' + mes + '-' + f.getFullYear();
			record['idAlumno']=CodigoSelec;
			record['Fecha']=fecha;
			grid.save();
		}
	}
};
var FiltroBool=-1;
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
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Control de Apoyo<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <table width="100%" border="0">
    <tr>
      <td colspan="2" bgcolor="#CCCCCC">
				<form action="Apoyo0.php" method="get">
          <div align="center"><strong>&nbsp;&nbsp;Codigo: </strong>
            <input name="txtCodigo" type="text" id="txtCodigo" size="10" maxlength="10" value="<?php echo $_GET['txtCodigo'] ?>"/>
            <input type="submit" name="button" id="button" value="Enviar" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtNombreAlumno" type="text" id="txtNombreAlumno" size="20" readonly value="<?php echo $row['Nombre_Alumno'] ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtProfesion" type="text" id="txtProfesion" size="15" readonly value="<?php echo $row['Profesion_Estudios'] ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtNecesidad" type="text" id="txtNecesidad" size="15" readonly value="<?php echo $row['Necesidad'] ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtFechaAl" type="text" id="txtFechaAl" size="15" readonly value="<?php echo cambiarfecha($row['Fecha_Al']) ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtTelefono" type="text" id="txtTelefono" size="15" readonly value="<?php echo $row['Telefono'] ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtGrupo" type="text" id="txtGrupo" size="15" readonly value="<?php echo $row['Grupo'] ?>"/>
				  </div>
				</form>
      </td>
    </tr>
    <tr>
      <td width="100%" align="left" valign="top">
	    	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:100%;" ></div>
 
      </td>
    </tr>
		<tr>
    	<td width="100%" align="left" valign="top">
        	<div id="gridbox2" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:100%;" ></div>
      </td>
    </tr>
  </table>
  <br />

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
