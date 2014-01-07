<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");

	if(isset($_GET['txtBuscarCodigo'])==true){
		$CodigoAlumno=$_SESSION['Centro'].strtoupper($_GET['txtBuscarCodigo']);
	}
	else{
		$CodigoAlumno="----";
	}
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$miconexion1 = new DB_mysql ;
	$miconexion1->conectar();

	$sql="SELECT * FROM alumnos WHERE Codi='".$CodigoAlumno."'";
	$miconexion->consulta($sql);
	$rowAlumnos =mysql_fetch_array($miconexion->Consulta_ID);
		
	$sql="SELECT * FROM gruposcuotas WHERE Grupo='".$rowAlumnos['Grupo']."'";
	$miconexion1->consulta($sql);
	$rowGruposCuotas =mysql_fetch_array($miconexion1->Consulta_ID);
	
	$Matricula=$rowGruposCuotas['Matriculas'];
	
	//Cuota
	if($rowAlumnos['Pago']=="ME_M" || $rowAlumnos['Pago']=="ME_B"){
		$Cuota=$rowGruposCuotas['CuotasMes'];
	}
	else{
		$Cuota=$rowGruposCuotas['CuotasTrim'];
	}
	$Cuota=round($Cuota * 100) / 100;
		
	//Importe
	if($rowAlumnos['Pago']=="ME_M" || $rowAlumnos['Pago']=="ME_B"){
		if($rowAlumnos['Descuento']=='YES'){
			$Importe=($rowGruposCuotas['CuotasMes']-($rowGruposCuotas['CuotasMes']*0.03));
		}
		else{
			$Importe=$rowGruposCuotas['CuotasMes'];
		}
	}
	else{
		if($rowAlumnos['Descuento']=='YES'){
			$Importe=($rowGruposCuotas['CuotasTrim']-($rowGruposCuotas['CuotasTrim']*0.03));
		}
		else{
			$Importe=$rowGruposCuotas['CuotasTrim'];
		}
	}
	$Importe=round($Importe * 100) / 100;
	$_SESSION['SQL']=" WHERE Cod='".$CodigoAlumno."'";

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
function popup(mylink, w, h){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars=no,fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

function NoImprimir(){
	var F_Cobro=prompt("Teclee Fecha Cobro:","<?php echo date("d-m-Y") ?>");
	if (F_Cobro!=null){
		popup ("Confecionar1Recibo_NoImprimir.php?NumPago=<?php echo $_GET['NumPago'] ?>&F_Cobro="+F_Cobro,700,300);
	}
	else{
		alert("No se puede volcar ya que no se a especificado la fecha de cobro");
	}
}
/*var myDialogEditorCreater = new Sigma.DialogEditor({
			id: "myDialogEditor1",
			gridId : "mygrid1" ,
			width: 150,
			height:100 ,
			title : 'Editor',
			body : ["<center><input type='text' id='my_name_input' rows='5' cols='20' style='width:50%'></center><br/>",
					'<center><input type="button" value="OK" onclick="Sigma.$grid(\'mygrid1\').activeDialog.confirm()"/></center>'].join(''),
	
			getValue : function(){
				var resultado = Sigma.$("my_name_input").value.replace(',', '.');
				switch(colSelec){
				case 2:	//F. Cobro
					window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Fecha_Cobro=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
					break;
				case 3:	//Fecha_De
					window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Fecha_De=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
					break;
				case 4:	//Cuota
					window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Cuota=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
					break;
				case 5:	//Dto
					window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Dto=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
					break;
				case 6:	//Matricula
					window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Matricula=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
					break;
				case 7:	//Materiales
					window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Materiales=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
					break;
				}
				return resultado;
			},
			setValue : function(value){
				if (mygrid.getColumnValue('Numero_Pago',rowSelec)==null && colSelec==4){
					window.location.href="Confecionar1Recibo1.php?Codigo=<?php echo $CodigoAlumno ?>&Cuota=<?php echo $Cuota ?>&NombreAlumno=<?php echo $rowAlumnos['Nombre_Alumno'] ?>&Centro=<?php echo $_SESSION['Centro'] ?>";
					value2=<?php echo $Cuota ?>;
				}
				else{
					if(mygrid.getColumnValue(colSelec,rowSelec)==0){
						switch(colSelec){
						case 4:	//Cuota
							value2=<?php echo $Cuota ?>;
							break;
						case 6:	//Matricula
							value2=<?php if (isset($rowGruposCuotas['Matriculas'])==true){ echo $rowGruposCuotas['Matriculas']; }else{ echo 0; }?>;
							break;
						case 7:	//Materiales
							value2=<?php if (isset($rowGruposCuotas['Materiales'])==true){ echo $rowGruposCuotas['Materiales']; }else{ echo 0; } ?>;
							break;
						default:
							value2=value;
							break;
						}
					}
					else{
						value2=mygrid.getColumnValue(colSelec,rowSelec);
					}
				}
				Sigma.$("my_name_input").value=value2;
			},
			active : function(){
				Sigma.U.focus(Sigma.$("my_name_input"));
			}
		// Developer could do validation, formating work by overwritting event handler beforeShow, afterShow, beforeHide, afterHide of dialog 
});
*/
var dsOption= {
    fields :[
		{name : 'Numero_Pago'},
		{name : 'Cod'},
		{name : 'Fecha_Cobro'},
		{name : 'Fecha_De'},
		{name : 'Cuota'},
		{name : 'Dto'},
		{name : 'Matricula'},
		{name : 'Materiales'},
		{name : 'Periodo'},
		{name : 'Pagado'},
		{name : 'Nombre_Alumno'}/*,
		{name : 'total_avg',
					initValue : function(record){
						var avg =(parseFloat(record[4])+parseFloat(record[5])+parseFloat(record[6])+parseFloat(record[7]));
						avg = parseFloat(avg*100)/100;
						return avg;
					}
			}*/
    ],
    recordType : 'object'
} 

function render_pagado(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Pagado' value='"+rowNo+"' id='Pagado' onclick='this.checked = !this.checked'  ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}

var colsOption = [
	{id : "Numero_Pago", header: "Num.Pago" , width :165},
	{id : "Cod" , header: "Cod" , width :50, align : 'center'},
	{id : "Fecha_Cobro" , header: "F. Cobro" , width: 70, editor:{type:"text"}},
	{id : "Fecha_De" , header: "F. De" , width :70, editor:{type:"text"}},
	{id : "Cuota" , header: "Cuota" , width :55, align : 'right', editor:{type:"text"}},
	{id : "Dto" , header: "Dto" , width :38, align : 'right', editor:{type:"text"}},
	{id : "Matricula" , header: "Matricula" , width :80, align : 'right',editor:{type:"text"}},
	{id : "Materiales" , header: "Materiales" , width :80, align : 'right', editor:{type:"text"}},
	//{id : "total_avg" , header: "Total" , width :60, align : 'right'},
	{id : "Periodo" , header: "Periodo" , width :60, align : 'center'},
	{id : "Pagado" , header: "Pagado" , width :60, align : 'center', renderer:render_pagado},
	{id : "Nombre_Alumno" , header: "Nombre Alumno" , width :130}
];
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
		}
	}
);

Sigma.ToolFactroy.register(
	'btnsave',  
	{
		cls : 'clsSave',  
		toolTip : 'Grabar cambios.',
		action : function(event,grid) {
			grid.save();
		}
	}
);

Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Añadir Recibo.',
		action : function(event,grid) {
			window.location.href="Confecionar1Recibo1.php?Codigo=<?php echo $CodigoAlumno ?>&Matricula=<?php echo $Matricula ?>&Cuota=<?php echo $Cuota ?>&NombreAlumno=<?php echo $rowAlumnos['Nombre_Alumno'] ?>&Centro=<?php echo $_SESSION['Centro'] ?>";
		}
	}
);

var gridOption={
	id : "mygrid1",
	width: "870",
	height: "100",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BD1Recibo0.php",
	saveURL : "BD/BD1Recibo1.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnadd btndel btnsave | filter | print',
	pageSize : 50000,
	onDblClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		//Columna Num. Pago
		switch(colNO) {
		case 0:
			window.location.href="Confecionar1Recibo0.php?txtBuscarCodigo=<?php echo strtoupper($_GET['txtBuscarCodigo']) ?>&NumPago="+mygrid.getColumnValue('Numero_Pago',rowSelec);
			break;
/*		case 2:	//F. Cobro
			window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Fecha_Cobro=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
			break;
		case 3:	//Fecha_De
			window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Fecha_De=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
			break;
		case 4:	//Cuota
			window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Cuota=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
			break;
		case 5:	//Dto
			window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Dto=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
			break;
		case 6:	//Matricula
			window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Matricula=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
			break;
		case 7:	//Materiales
			window.location.href="Confecionar1Recibo2.php?Codigo=<?php echo $CodigoAlumno ?>&SQL=Materiales=~"+resultado+"~&SQL2=Numero_Pago=~"+mygrid.getColumnValue('Numero_Pago',rowSelec)+"~";
			break;*/
		}
	},
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		rowSelec=rowNO;
		colSelec=colNO;
	}
};

var gridRow=-1;
var rowSelec=-1;
var colSelec=-1;
var FiltroAutomatico=false;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

// Para el segundo Grid (Recibos Cobrados
var dsOption2= {
    fields :[
      {name : 'Cod'},
      {name : 'Fecha_De'},
      {name : 'Fecha_Cobro'},
      {name : 'Importe'},
      {name : 'Matricula'},
      {name : 'Dto'},
      {name : 'Cuota'},
      {name : 'Materiales'},
			{name : 'Periodo'},
			{name : 'Pagado'},
			{name : 'Metalico'}
    ],
    recordType : 'object'
} 

function render_pagado2(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Pagado' value='"+rowNo+"' id='Pagado' onclick='this.checked = !this.checked'  ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}

var colsOption2 = [
	{id : "Cod" , header: "Cod" , width :100, align : 'center'},
	{id : "Fecha_De" , header: "F. De" , width :80},
	{id : "Fecha_Cobro" , header: "F. Cobro" , width: 80},
	{id : "Importe" , header: "Importe" , width :60, align : 'right'},
	{id : "Matricula" , header: "Matricula" , width :70, align : 'right'},
	{id : "Dto" , header: "Dto" , width :58, align : 'right'},
	{id : "Cuota" , header: "Cuota" , width :55, align : 'right'},
	{id : "Materiales" , header: "Materiales" , width :80, align : 'right'},
	{id : "Periodo" , header: "Periodo" , width :80, align : 'center'},
	{id : "Pagado" , header: "Pagado" , width :80, align : 'center', renderer:render_pagado2},
	{id : "Metalico" , header: "Metalico" , width: 80, renderer:render_pagado2}
];

var gridOption2={
	id : "mygrid2",
	width: "865",
	height: "330",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDCobros.php",
	container : 'gridbox2',
	dataset : dsOption2 ,
	columns : colsOption2,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | filter | print',
	onComplete:function(grid){
	}
};

var FiltroAutomatico2=false;
var mygrid2=new Sigma.Grid(gridOption2);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid2));

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
 	.clsSave { 
		background : url(../Imagenes/Iconos/grabar.png) no-repeat center center; 
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Gestion de Recibos y Cobros<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->

  <hr />
  <table width="100%" height="151" border="0">
    <tr>
      <td height="109" align="left" valign="top" bgcolor="#CCCCCC">
        <table width="100%" height="62" border="1" bordercolor="#000000">
          <tr>
          <td>
		      	<table width="100%" border="0" bordercolor="#000000">
							<form name="formulario" action="Confecionar1Recibo0.php" method="get">
                <tr>
                  <td>
                      <strong>Buscar por Cod.:</strong>
                      <input name="txtBuscarCodigo" type="text" id="txtBuscarCodigo" size="7" tabindex="13" />
                      <input name="btnEnviar" type="image" id="btnEnviar" value="Enviar" src="../Imagenes/Iconos/find.png" alt="Buscar" />
                      &nbsp;&nbsp;&nbsp;
                      <strong>Matriculas:</strong>
                      <input name="txtMatriculas" type="text" id="txtMatriculas" size="7" tabindex="2" value="<?php echo $rowGruposCuotas['Matriculas']." €" ?>" readonly="readonly" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <strong>Cuota:</strong>
                      <input name="txtCuota" type="text" id="txtCuota" size="7" tabindex="3" value="<?php echo $Cuota." €" ?>" readonly="readonly" />
                      &nbsp;&nbsp;
                      <strong>1/2 mes:</strong>
                      <input name="txtMedioMes" type="text" id="txtMedioMes" size="7" tabindex="4" value="<?php	echo (round(($Importe/6)*100)/100)." €" ?>" readonly="readonly" />
                  </td>
                </tr>
                <tr>
                  <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="txtGrupo" type="text" id="txtGrupo" tabindex="1" value="<?php echo substr($rowGruposCuotas['Grupo'],3) ?>" size="7" readonly="readonly" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>Materiales:</strong>
                    <input name="txtMateriales" type="text" id="txtMateriales" size="7" tabindex="5" value="<?php echo $rowGruposCuotas['Materiales']." €" ?>" readonly="readonly" />
                    &nbsp;&nbsp;
                    <strong>Importe:</strong>
                    <input name="txtImporte" type="text" id="txtImporte" size="7" tabindex="6" value="<?php echo $Importe." €" ?>" readonly="readonly" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>Dto:</strong>
                    <input name="txtDto" type="text" id="txtDto" size="7" tabindex="7" value="<?php echo (round(($Importe-$Cuota)*100)/100)." €" ?>" readonly="readonly" />								</td>
                </tr>
							</form>
            </table>
          </td>
        </tr>
      </table>
			<table width="100%" border="0">
				<tr>
					<td height="51"><table width="100%" border="0">
            <tr>
              <td><strong>&nbsp;Codigo:&nbsp;</strong>
                <input name="txtCodigo" type="text" id="txtCodigo" size="7" tabindex="8" value="<?php echo substr($rowAlumnos['Codi'],3) ?>" readonly="readonly" />
                &nbsp;&nbsp;
                <input type="text" name="txtNombreAlumno" id="txtNombreAlumno" tabindex="9" value="<?php echo $rowAlumnos['Nombre_Alumno'] ?>" readonly="readonly" />
                &nbsp;&nbsp;&nbsp;&nbsp;<strong>Dto:                </strong>
                <input name="chkDto" type="checkbox" id="chkDto" tabindex="10" readonly="readonly"<?php if ($rowAlumnos['Descuento']=='YES') echo "checked='checked'"; echo "onclick='this.checked = !this.checked'"?> />
                &nbsp;
                <input name="txtPago" type="text" id="txtPago" size="7" tabindex="11" value="<?php echo $rowAlumnos['Pago'] ?>" readonly="readonly" />
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;F. Comienzo:</strong>
                <input name="txtFechaComienzo" type="text" id="txtFechaComienzo" size="7" tabindex="12" value="<?php echo cambiarfecha($rowAlumnos['Fecha_Co']) ?>" readonly="readonly" />
              </td>
            </tr>
            <tr>
                <td>
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                	<input name="txtNumPago" type="text" id="txtNumPago" size="20" value="<?php echo $_GET['NumPago'] ?>"/>
                	&nbsp;&nbsp;
                	<strong><a href="Confecionar1Recibo_Imprimir.php?NumPago=<?php echo $_GET['NumPago'] ?>" target="_blank">Imprimir</a></strong>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <strong><a href="#" onclick="NoImprimir();">No Imprimir</a></strong>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <strong><a href="Contrato0.php?Codigo=<?php echo $rowAlumnos['Codi'] ?>">Contrato</a></strong>								</td>
            </tr>
          </table></td>
				</tr>
			</table>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top" bgcolor="#FFFFFF">
      	<strong>Pendientes</strong>
       	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:100%;" ></div>
        <strong>Cobrados</strong>
       	<div id="gridbox2" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100px;width:100%;" ></div>
      </td>
    </tr>
  </table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
