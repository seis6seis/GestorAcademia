<?php
	readfile($_GET['Fichero']);
?>
<script type="text/javascript">
	document.execCommand('SaveAs','','<?php echo $_GET['Nombre'] ?>'); 
</script>