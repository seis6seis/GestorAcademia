<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
//pageno starts with 1 instead of 0
/*$sql="SELECT historico_pagos.Cod, historico_pagos.Nombre_Alumno, Alumnos.Pago, Alumnos.Telefono, historico_pagos.Matricula, historico_pagos.Materiales, historico_pagos.Importe, historico_pagos.Pagado, Banco.Titular, Banco.Codigo_Banco, Banco.Codigo_Oficina, Banco.Digito_Control, Banco.Numero_Cuenta, Alumnos.Fecha_Ba";
$sql=$sql." FROM (Alumnos INNER JOIN historico_pagos ON Alumnos.Codi = historico_pagos.Cod) LEFT JOIN Banco ON Alumnos.Codi = Banco.Cod";
$sql=$sql." WHERE ((Alumnos.Pago Like '%B') AND historico_pagos.Pagado='NO' AND (Banco.Titular is NULL) AND Alumnos.Fecha_Ba='0000-00-00' AND historico_pagos.Centro='".$_SESSION['Centro']."')";
$sql=$sql." ORDER BY historico_pagos.Nombre_Alumno";
*/

$sql="SELECT Codi, Nombre_Alumno, Telefono, Centro FROM Alumnos WHERE (Alumnos.Centro='".$_SESSION['Centro']."' AND Fecha_Ba='0000-00-00' AND Pago LIKE '%_B')AND Alumnos.Codi NOT IN (SELECT Alumnos.Codi FROM Alumnos INNER JOIN Banco ON Alumnos.Codi=Banco.Cod)";
$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
//	$row->Cod=substr($row->Cod,3);
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>