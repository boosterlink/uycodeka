<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">



function pon_prefijo(pref,nombre) {
parent.pon_prefijo(pref,nombre);
parent.$('idOfDomElement').colorbox.close();
}

function limpiar() {
	parent.document.form_busqueda.nombre.value="";
	parent.document.form_busqueda.codproveedor.value="";
}


</script>
<?php include ("../conectar.php"); ?>
<body>
Verificando
<?php
	$codproveedor=$_GET["codproveedor"];
	$consulta="SELECT * FROM proveedores WHERE codproveedor='$codproveedor' AND borrado=0";
	$rs_tabla = mysql_query($consulta);
	if (mysql_num_rows($rs_tabla)>0) {
		$nombre = mysql_result($rs_tabla,0,'nombre');
		$pref= mysql_result($rs_tabla,0,'codproveedor');
		?>
		<script languaje="javascript">
		pon_prefijo("<?php echo $pref;?>","<?php echo $nombre;?>");
		</script>
		<?php 
	} else { ?>
	<script>
	alert ("No existe ningun proveedor con ese codigo");
	limpiar();
	</script>
	<?php }
?>
</div>
</body>
</html>
