<html>
<title></title>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
<script>
function eliminar_linea(codfacturatmp,numlinea,importe,codservice)
{
	if (confirm(" Desea eliminar esta linea ? "))
		parent.document.formulario_lineas.baseimponible.value=parseFloat(parent.document.formulario_lineas.baseimponible.value) - parseFloat(importe);
		var original=parseFloat(parent.document.formulario_lineas.baseimponible.value);
		var result=Math.round(original*100)/100 ;
		parent.document.formulario_lineas.baseimponible.value=result;

		parent.document.formulario_lineas.baseimpuestos.value=parseFloat(result * parseFloat(parent.document.formulario.iva.value / 100));
		var original1=parseFloat(parent.document.formulario_lineas.baseimpuestos.value);
		var result1=Math.round(original1*100)/100 ;
		parent.document.formulario_lineas.baseimpuestos.value=result1;
		var original2=parseFloat(result + result1);
		var result2=Math.round(original2*100)/100 ;
		parent.document.formulario_lineas.preciototal.value=result2;
		
		document.getElementById("frame_datos").src="eliminar_linea.php?codfacturatmp="+codfacturatmp+"&numlinea=" + numlinea+"&codservice=" + codservice;
}
</script>
</head>
<?php 
include ("../conectar.php");
$codfacturatmp=$_POST["codfacturatmp"];
$retorno=0;
$modif=$_POST["modif"];
if ($modif!=1) {
		if (!isset($codfacturatmp)) { 
			$codfacturatmp=$_GET["codfacturatmp"]; 
			$retorno=1; }
		if ($retorno==0) {	
				$codfamilia=$_POST["codfamilia"];
				$codarticulo=$_POST["codarticulo"];
				$cantidad=$_POST["cantidad"];
				$precio=$_POST["precio"];
				$importe=$_POST["importe"];
				$detalles=$_POST["detalles"];
				$descuento=$_POST["descuento"];
				$moneda=$_POST["moneda"];
				$codservice=$_POST["codservice"];
				
				$sel_insert="INSERT INTO factulineatmp (codfactura,numlinea,codfamilia,codigo,codservice,detalles,cantidad,moneda,precio,importe,dcto) 
				VALUES ('$codfacturatmp','','$codfamilia','$codarticulo','$codservice','$detalles','$cantidad','$moneda','$precio','$importe','$descuento')";
				$rs_insert=mysql_query($sel_insert);

		$sel_actualiza="UPDATE service SET factura='$codfacturatmp' WHERE codservice='$codservice'";
		$rs_actualiza = mysql_query($sel_actualiza);
		}
}
?>
<body>
<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
<?php
$tipomon = array( 0=>"&nbsp;", 1=>"Pesos", 2=>"U\$S");
$total_importe='';
$sel_lineas="SELECT factulineatmp.*,articulos.*,familias.nombre as nombrefamilia FROM factulineatmp,articulos,familias WHERE factulineatmp.codfactura='$codfacturatmp' AND factulineatmp.codigo=articulos.codarticulo AND factulineatmp.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY factulineatmp.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
	$numlinea=mysql_result($rs_lineas,$i,"numlinea");
	$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
	$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
	$referencia=mysql_result($rs_lineas,$i,"referencia");
	$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
	$descripcion=mysql_result($rs_lineas,$i,"descripcion");
	$detalles=mysql_result($rs_lineas,$i,"detalles");
	$cantidad=mysql_result($rs_lineas,$i,"cantidad");
	$precio=mysql_result($rs_lineas,$i,"precio");
	$codservice=mysql_result($rs_lineas,$i,"codservice");
	$moneda=$tipomon[mysql_result($rs_lineas,$i,"moneda")];
	$importe=mysql_result($rs_lineas,$i,"importe");
	$total_importe=$total_importe+$importe;
	$descuento=mysql_result($rs_lineas,$i,"dcto");
	if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
			<tr class="<?php echo $fondolinea?>">
				<td width="3%"><?php echo $i+1?></td>
				<?php if (trim($detalles)==''){ ?>
				<td width="56%" colspan="2"><?php echo $descripcion;?></td>
				<?php } else { ?>
				<td width="14%"><?php echo $descripcion;?></td>
				<td width="42%"><?php echo $detalles;?></td>
				<?php } ?>
				<td width="8%" class="aCentro"><?php echo $cantidad;?></td>
				<td width="8%" class="aCentro"><?php echo $precio;?></td>
				<td width="7%" class="aCentro"><?php echo $descuento;?></td>
				<td width="6%" class="aCentro"><?php echo $moneda;?></td>
				<td width="8%" class="aCentro cajaTotales" ><?php echo $importe;?></td>
				<td width="4%"><a href="javascript:eliminar_linea(<?php echo $codfacturatmp;?>,<?php echo $numlinea;?>,<?php echo $importe; ?>,<?php echo $codservice; ?>)">
				<img id="botonBusqueda" src="../img/eliminar.png" border="0"></a></td>
			</tr>
<?php }
 ?>
</table>
<script type="text/javascript">
parent.pon_baseimponible(<?php echo $total_importe;?>);
</script>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
</body>
</html>