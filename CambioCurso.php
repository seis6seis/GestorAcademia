<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php
	if ($_GET['Curso']=="Actual"){
		$_SESSION['CursoEscolar']="";
	}
	if ($_GET['Curso']=="Proximo"){
		$_SESSION['CursoEscolar']="2";
	}
?>
<script>
window.history.go(-1);
</script>
</body>
</html>