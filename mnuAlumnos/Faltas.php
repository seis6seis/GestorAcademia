<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	$miconexion = new DB_mysql ;
	$miconexion->conectar();

	if (isset($_POST['txtCodigo'])){
		$_SESSION['SQL']=" AND Codigo='".$_SESSION['Centro'].$_POST['txtCodigo']."'";
	}
	else{
		$_SESSION['SQL']=" AND Codigo='--------'";
	}
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
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { location.reload() }
	}
);
function renderJustificada(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Justificada' value='Ma"+rowNo+"' id='Justificada' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ " onClick='this.checked= !this.checked' />";
	return Frase;
}

var dsOption2= {
    fields :[
			{name : "Fecha_Falta"},
			{name : "Fecha_Contacto"},
			{name : "Justificada"}
    ],
    recordType : 'object'
}

var colsOption2 = [
	{id : "Fecha_Falta" , header: "Fecha Falta" , width :150,readonly:false},
	{id : "Fecha_Contacto" , header: "Fecha Contacto" , width :150,readonly:false},
	{id : "Justificada" , header: "Justificada" , width :100, align : 'center', renderer:renderJustificada}
];

var gridOption2={
	id : "mygrid2",
	width: "405",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDFaltas1.php",
	container : 'gridbox2',
	dataset : dsOption2 ,
	columns : colsOption2,
	toolbarPosition : 'top',
	pageSize : 50000,
	toolbarContent : 'btnrefresh | state filter | print'
};
var FiltroBool=-1;
var CodigoSelec='-';
var gridRow=-1;
var rowSelec=-1;
var colSelec=-1;

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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Faltas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
	$sql="SELECT * FROM alumnos WHERE Codi='".$_SESSION['Centro'].$_POST['txtCodigo']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
	<form action="Faltas.php" method="post">
		<table width="300px" border="0" align="center">
      <tr>
        <td>
          &nbsp;&nbsp;&nbsp;
          <strong>Teclee codigo: </strong>&nbsp;
          <input name="txtCodigo" type="text" id="txtCodigo" value="<?php echo $_POST['txtCodigo'] ?>" size="8" maxlength="7" />
          &nbsp;
          <input type="submit" name="button" id="button" value="Enviar" />
      	</td>
      </tr>
      <tr>
      	<td>
        	<hr />
          &nbsp;&nbsp;&nbsp;<strong>Nombre:</strong>&nbsp;<?php echo $row['Nombre_Alumno'] ?>
          <br />
        	&nbsp;&nbsp;&nbsp;<strong>Grupo: </strong>&nbsp;<?php echo $row['Grupo'] ?>
          <hr  />
      	</td>
      </tr>
      <tr>
        <td height="322">
        <div id="gridbox2" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:260px;" ></div>        </td>
      </tr>
    </table>
		<br />
	</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
