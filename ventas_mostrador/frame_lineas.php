<script>
function eliminar_linea(codfacturatmp,numlinea,importe)
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
		
		document.getElementById("frame_datos").src="eliminar_linea.php?codfacturatmp="+codfacturatmp+"&numlinea=" + numlinea;
}
</script>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
<?php 
include ("../conectar.php");
$codfacturatmp=$_POST["codfacturatmp"];
$retorno=0;
if ($modif<>1) {
		if (!isset($codfacturatmp)) { 
			$codfacturatmp=$_GET["codfacturatmp"]; 
			$retorno=1; }
		if ($retorno==0) {	
				$codbarras=$_POST["codbarras"];
				$sel_articulos="SELECT * FROM articulos WHERE codigobarras='$codbarras'";
				$rs_articulos=mysql_query($sel_articulos);			
				$codfamilia=mysql_result($rs_articulos,0,"codfamilia");
				$codarticulo=mysql_result($rs_articulos,0,"codarticulo");
				$cantidad=$_POST["cantidad"];
				$precio=$_POST["precio"];
				$importe=$_POST["importe"];
				$moneda=$_POST["moneda"];
				$descuento=$_POST["descuento"];
				
				$sel_insert="INSERT INTO factulineatmp (codfactura,numlinea,codigo,codfamilia,cantidad,moneda,precio,importe,dcto) VALUES ('$codfacturatmp','','$codarticulo','$codfamilia','$cantidad','$moneda','$precio','$importe','$descuento')";
				$rs_insert=mysql_query($sel_insert);
		}
}
?>
<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">

<?php
$tipomon = array( 0=>"Selecione uno", 1=>"Pesos", 2=>"U\$S");
$sel_lineas="SELECT factulineatmp.*,articulos.*,familias.nombre as nombrefamilia FROM factulineatmp,articulos,familias WHERE factulineatmp.codfactura='$codfacturatmp' AND factulineatmp.codigo=articulos.codarticulo AND factulineatmp.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY factulineatmp.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
	$numlinea=mysql_result($rs_lineas,$i,"numlinea");
	$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
	$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
	$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
	$referencia=mysql_result($rs_lineas,$i,"referencia");
	$descripcion=mysql_result($rs_lineas,$i,"descripcion");
	$cantidad=mysql_result($rs_lineas,$i,"cantidad");
	$precio=mysql_result($rs_lineas,$i,"precio");
	$importe=mysql_result($rs_lineas,$i,"importe");
	$moneda=$tipomon[mysql_result($rs_lineas,$i,"moneda")];
	
	$descuento=mysql_result($rs_lineas,$i,"dcto");
	if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
			<tr class="<?php echo $fondolinea?>">
				<td width="3%"><?php echo $i+1?></td>
				<td width="12%"><?php echo $nombrefamilia?></td>
				<td width="14%"><?php echo $referencia?></td>
				<td width="30%"><?php echo $descripcion?></td>
				<td width="8%" class="aCentro"><?php echo $cantidad?></td>
				<td width="8%" class="aCentro"><?php echo $precio?></td>
				<td width="7%" class="aCentro"><?php echo $descuento?></td>
				<td width="6%" class="aCentro"><?php echo $moneda?></td>
				<td width="8%" class="aCentro cajaTotales" ><?php echo $importe?></td>
				<td width="4%"><a href="javascript:eliminar_linea(<?php echo $codfacturatmp?>,<?php echo $numlinea?>,<?php echo $importe ?>)"><img id="botonBusqueda" src="../img/eliminar.png" border="0"></a></td>
			</tr>
<?php } ?>
</table>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
<script>parent.document.getElementById("codbarras").focus();</script>
