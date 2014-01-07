<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	if ($_GET['IDCuenta']==""){
		$_SESSION['SQL']=" WHERE Centro='".$_SESSION['Centro']."'";
	}
	else{
		$_SESSION['SQL']=" WHERE Centro='".$_SESSION['Centro']."' AND idCuenta='".$_GET['IDCuenta']."'";
	}

	$miconexion = new DB_mysql ;
	$miconexion->conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="Spain" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Fco. Javier Martinez Ramirez" />
  <meta name="description" content="Gestor Academia" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Gestor Academia</title>
  <!-- InstanceEndEditable -->
<link href="/GestorAcademia/CSS/Estilo.css" rel="stylesheet" type="text/css" />
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
function ActualizarTotal(){
	var TotalRegistros=mygrid.getPageInfo().endRowNum;
	var Saldo=0;
	var Haber=0;
	var Debe=0;
	for (var Reg=0;Reg<=TotalRegistros-1;Reg++){
		Haber=Haber+parseFloat(mygrid.getColumnValue("Haber",Reg));
		Debe=Debe+parseFloat(mygrid.getColumnValue("Debe",Reg));
	}
	Saldo=Haber-Debe;
 	document.getElementById('txtHaber').value =Haber.toFixed(2) + " €";
 	document.getElementById('txtDebe').value =Debe.toFixed(2) + " €";
	document.getElementById('txtSaldo').value =Saldo.toFixed(2) + " €";

}
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
			//{name : "Edit"},
		{name : "idMovi"},
		{name : "Fecha",type:'date'},
		{name : "idCuenta"},
		{name : "idTipo"},
		{name : "Descripcion"},
		{name : "Haber"},
		{name : "Debe"}
    ],
    recordType : 'object'
}

var colsOption = [
	//{id: 'Edit' , header: "Edit" , width :27, filterable: false, exportable:false, renderer:render_edit},
	{id : "idMovi",header: " ",width:1,readonly:false,hidden:true},
	{id : "Fecha" , header: "Fecha" , width :79, editor:{type:"text"}},//, readonly:false},
	{id : "idTipo",header: "idTipo ",width:100,align: 'center', editor: { type :"select" ,options : {'----': '----'
<?php 
	$sql="SELECT * FROM Tipos ORDER BY ID ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo ", '".$row['Cod']."': '".$row['Descripcion']."'";
	}
?>
		} ,defaultText : '----'}},
	{id : "idCuenta",header: "idCuenta ",width:100,align: 'center', editor: { type :"select" ,options : {'----': '----'
<?php 
	$sql="SELECT IDCuenta, Descripcion FROM Cuentas WHERE Centro='".$_SESSION['Centro']."' ORDER BY IDCuenta ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo ", '".$row['IDCuenta']."': '".$row['Descripcion']."'";
	}
?>
		} ,defaultText : '----'}},
	{id : "Descripcion" , header: "Descripcion" , width :223, editor:{type:"text"}},//,readonly:false},
	{id : "Haber" , header: "Haber" , width :80,align: 'right', editor:{type:"text"}},//, renderer:render_Haber,readonly:false},
	{id : "Debe" , header: "Debe" , width :80,align: 'right', editor:{type:"text"}}//, renderer:render_Debe,readonly:false}
];
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Permite Añadir movimiento de cuenta.',
		action : function(event,grid) { 
			grid.add();
		}
	}
);
Sigma.ToolFactroy.register(
	'btnsave',  
	{
		cls : 'clsSave',  
		toolTip : 'Grabar Datos',
		action : function(event,grid) {
			grid.save();
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
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { Debe=0;Haber=0;grid.reload(); }
	}
);

var gridOption={
	id : "mygrid1",
	width: "670",
	height: "430",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDCuentas.php",
	saveURL : "BD/BDCuentas.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnadd <?php  if($_SESSION['Permiso']==1 or $_SESSION['Permiso']==4){ echo "btndel"; } ?> btnsave | filter | print',
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
.inputText{
text-align:right;
}
-->
</style>

<!-- InstanceEndEditable -->
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body>
  <table width="100%" border="0">
    <tr>
      <td width="140"><img src="../Imagenes/logo_blanco.png" alt="Logo EnglishConnection" width="111" height="49" /></td>
      <td align="right" valign="middle">
        <div align="right">
          <?php $usuario=$_COOKIE['idusuario'] ?> 
					<div align='right' class='usuario'><b>Usuario:</b> ( <?php echo $_SESSION['NombrePermiso'].") ".$_COOKIE['idusuario']  ?>
					| <a href='/GestorAcademia/SalirSession.php'>Cerrar session</a></div>
					<div align='right' class='usuario'>
          	<font size=4>
            <b>Centro:</b>&nbsp;
<?php
						echo $_SESSION['Centro']." - ";
						if($_SESSION['NombrePermiso']=="Administrador" || $_SESSION['NombrePermiso']=="Contable"){
							$miconexion_Centro = new DB_mysql;
							$miconexion_Centro->conectar();
							echo "<select name='cmbCentros' id='cmbCentros' onchange=\"MM_jumpMenu('parent',this,0)\" tabindex='0'>\n";
							$sql="SELECT Codigo, NombreCentro FROM centros ORDER BY Codigo ASC";
							$miconexion_Centro->consulta($sql);
							while ($row =mysql_fetch_array($miconexion_Centro->Consulta_ID)) {
								echo "<option value='../CambioCentroAdmin.php?Centro=".$row['Codigo']."' id='formulario'";
								if ($row['NombreCentro']==$_SESSION['NombreCentro']) echo " selected";
								echo ">".$row['NombreCentro']."</option>\n";
							}
							echo "</select>\n";
							$miconexion_Centro->desconectar();
						}
						else{
							echo $_SESSION['NombreCentro'];
						}
?>
            <b>Curso:</b>&nbsp;
						<select name='cmbCursoEscolar' id='cmbCursoEscolar' onchange="MM_jumpMenu('parent',this,0)" tabindex='1'>
            <option value='/GestorAcademia/CambioCurso.php?Curso=Actual' id='formulario' <?php if ($_SESSION['CursoEscolar']==""){ echo " selected"; } ?> >Curso Actual</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=Proximo' id='formulario' <?php if ($_SESSION['CursoEscolar']=="2"){ echo " selected"; } ?> >Curso Proximo</option>
            </select>
          	</font>
          </div>
        </div>
      </td>
    </tr>
  </table>

	<div id="container-navigation">
		<ul id="navigation">
<?php	if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director"){ ?>
			<li>
				<a href="/GestorAcademia/mnuGestionAlumnos/index.php">Gestion de Alumnos</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director"){
?>
			<li>
				<a href="/GestorAcademia/mnuGestionAcademica/index.php">Gestion Academica</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director" or $_SESSION['NombrePermiso']=="Contable"){
?>
			<li>
				<a href="/GestorAcademia/mnuGestionAdministrativa/index.php">Gestion Administrativa</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director"){
?>
			<li>
				<a href="/GestorAcademia/mnuDirectores/index.php">Directores</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director" or  $_SESSION['NombrePermiso']=="Profesor"){
?>
 			<li>
				<a href="/GestorAcademia/mnuProfesores/index.php">Profesores</a>			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador"){
?>
 			<li>
				<a href="/GestorAcademia/mnuAdministradores/index.php">Admnistradores</a>			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director" or  $_SESSION['NombrePermiso']=="Alumno"){
?>
 			<li>
				<a href="/GestorAcademia/mnuAlumnos/index.php">Alumnos</a>			</li>
<?php
			}
?>

		</ul>
	</div>
	<br />
	<table width="100%" border="0" align="left">
		<tr>
   		<td width="130" align="left" valign="top">
			<!-- InstanceBeginEditable name="SubMenu" -->
				<div id='SubMenu' style="width:130px;">
	      <p><a href="#" onclick="window.open('../mnuGestionAlumnos/Confecionar1Recibo0.php?txtBuscarCodigo='+mygrid.getColumnValue('Codi',gridRow))">Recibos y Cobros</a></p>
        <p><a href="#" onclick="popup('VolcadoRecibos0.php',600,300,'yes')">Generar Recibos</a></p>
        <p><a href="#" onclick="popup('GenerarReciboBanco0.php',800,500,'no')">Generar Fichero para Banco</a></p>
        <p><a href="#" onclick="popup('ControlBalance0.php',600,300,'yes')">Control y Balance</a></p>
        <p><a href="#" onclick="popup('PendientesCobro0.php',800,500,'no')">Pendientes de Cobro</a></p>
        <p><a href="#" onclick="popup('PendienteDatosBanco.php',800,500,'no')">Pendientes Datos Banco</a></p>
<?php
        if($_SESSION['NombrePermiso']=="Contable" or $_SESSION['NombrePermiso']=="Administrador"){
			echo'<p><a href="../mnuAdministradores/Test0.php" target="_blank">Editor Test</a></p>';
		}
?>
			</div>
      <!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
		<table width="100%" height="276" border="0">
        	<tr>
            <td height="21" align="left" valign="top" bgcolor="#CCCCCC"><span class="TituloPrincipal">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Apunte de movimientos de cuenta</span>
            </td>
          </tr>
          <tr>
            <td height="31" align="left" valign="top" bgcolor="#CCCCCC"><table width="100%" border="0">
              <tr>
                <td width="285%">
                	<div align="left"><strong>
                    IDcuenta:                    </strong>
               	    <select name="lstIDCuenta" id="lstIDCuenta" onchange="MM_jumpMenu('parent',this,0)" tabindex="4">
	 	                  <option value='' id='formulario'></option>
<?php
	$sql="SELECT IDCuenta,Descripcion FROM Cuentas WHERE Centro='".$_SESSION['Centro']."' ORDER BY IDCuenta ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "                  	<option value='index.php?IDCuenta=".$row['IDCuenta']."' id='formulario'";
		if ($row['IDCuenta']==$_GET['IDCuenta']) echo "selected ";
		echo " >".$row['Descripcion']."</option>\n";
	}
?>
             	      </select>
                	</div>                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
        	<td align="left" valign="top" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
           <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saldo:</strong> 
            <input name="txtSaldo" type="text" class="inputText" id="txtSaldo" size="7" readonly />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="txtHaber" type="text" class="inputText" id="txtHaber" size="7" readonly align= 'right'/>
            <input name="txtDebe" type="text" class="inputText" id="txtDebe" size="7" readonly />
            <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:100%;" >
            </div>
          </td>
        </tr>
			</table>
<script type="text/javascript">
	setInterval('ActualizarTotal()',500);
</script>
			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>
