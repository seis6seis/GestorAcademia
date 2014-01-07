<?php 
  session_start();
  include("../login.class.php");
  $login=new login();
  $login->inicia();
  $_SESSION['SQL']="";
  require ("../Connections/DB_mysql.class.php");
  $miconexion = new DB_mysql;
  $miconexion->conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado General - Gestor Academia</title>
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

var dsOption= {
    fields :[
       {name : "Grupo"},
       {name : "Horarios"},
       {name : "Profesor"},
       {name : "PlazasOcupadas"}
    ],
    recordType : 'object'
} 

var colsOption = [
  {id : "Grupo" , header: "Grupo" , width :150, readonly:false},
  {id : "Horarios" , header: "Horario" , width :200, readonly:false},
  {id : "Profesor" , header: "Profesor" , width :200, readonly:false},
  {id : "PlazasOcupadas" , header: "Plazas Ocupadas" , width :120, readonly:false}
];

Sigma.ToolFactroy.register(
  'btnrefresh',  
  {
    cls : 'clsRefresh',  
    toolTip : 'Actualiza la lista.',
    action : function(event,grid) { location.reload() }
  }
);

var gridOption={
  id : "mygrid1",
  width: "98%",
  height: "500",
  replaceContainer : true,
  resizable : true,
  pageSize : 50000,
  loadURL : "BD/BDRelacionGrupos.php",
  saveURL : "BD/BDRelacionGrupos.php",
  container : 'gridbox',
  dataset : dsOption ,
  columns : colsOption,
  toolbarPosition : 'top',
  toolbarContent : 'btnrefresh | filter | print'
};
/*ar context = {
  sequence:false,checkBox:false,radioBox:true,selectRowWhenClick:true,paintMode:"all"
};*/
var gridRow=-1;
var FiltroAutomatico=false;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
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
    background : url(../Imagenes/Iconos/form_delete.png) no-repeat center center; 
    }
.gt-head-div {
  height:20px;
}
.gt-inner {
  height: 20px;
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Listado General<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
  <!-- InstanceBeginEditable name="Codigo" -->
  <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>