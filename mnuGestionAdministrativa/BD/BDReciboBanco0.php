<?php
session_start();

header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
//pageno starts with 1 instead of 0
$sql = "SELECT historico_pagos.Numero_Pago, Alumnos.Nombre_Alumno, Alumnos.Pago, historico_pagos.Pagado, Banco.Titular, historico_pagos.Importe, historico_pagos.Matricula, historico_pagos.Dto, historico_pagos.Cuota, historico_pagos.Materiales, historico_pagos.Fecha_Ge, Alumnos.Codi";
$sql=$sql." FROM Alumnos INNER JOIN (historico_pagos INNER JOIN Banco ON historico_pagos.Cod = Banco.Cod) ON Alumnos.Codi = historico_pagos.Cod";
$sql=$sql." WHERE Alumnos.Pago LIKE '%B' AND historico_pagos.Pagado='NO' AND historico_pagos.Centro='".$_SESSION['Centro']."' ORDER BY Alumnos.Nombre_Alumno LIMIT 0,2000";
$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>