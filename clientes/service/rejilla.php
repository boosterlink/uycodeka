<?php
include ("../../conectar.php");
include ("../../funciones/fechas.php");

	$e=$_POST['e'];

$query="SELECT * FROM clientes WHERE codcliente='$e'";
$rs_query=mysql_query($query);


$where="1=1";
if ($e <> "") { $where.=" AND service.codcliente='$e'"; }

$where.=" ORDER BY fecha DESC";
$query_busqueda="SELECT count(*) as filas FROM service,clientes WHERE service.borrado=0 AND service.codcliente=clientes.codcliente AND ".$where;
$rs_busqueda=mysql_query($query_busqueda);
$filas=mysql_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Services</title>
		<link href="../../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script src="../js/jquery.min.js"></script>
		<link rel="stylesheet" href="../js/colorbox.css" />
		<script src="../js/jquery.colorbox.js"></script>
		<script language="javascript">
		
		function ver_service(codservice) {
			var url="ver_service.php?codservice=" + codservice;
			window.parent.OpenNote(url);
		}
		function ver_service_horas(codservice) {
			var url="ver_service_horas.php?codservice=" + codservice;
			window.parent.OpenNote(url);
		}
		
		function modificar_service(codservice) {
			var url="modificar_service.php?codservice=" + codservice;
			window.parent.OpenNote(url);
		}
		function modificar_service_horas(codservice) {
			var url="modificar_service_horas.php?codservice=" + codservice;
			window.parent.OpenNote(url);
		}
		
		function eliminar_service(codservice) {
			if (confirm("Atencion va a proceder a la eliminacion de una service. Desea continuar?")) {
			var url="eliminar_service.php?codservice=" + codservice;
			window.parent.OpenNote(url);
			}
		}

		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (parseInt(indi)>parseInt(numfilas)) { 
				indi=1; 
			}
			if (parseInt(numfilas) <= 10) {
					parent.document.getElementById("nextdisab").style.display = 'block';
					parent.document.getElementById("lastdisab").style.display = 'block';
					parent.document.getElementById("last").style.display = 'none';
					parent.document.getElementById("next").style.display = 'none';
			}			
			parent.document.form_busqueda.filas.value=numfilas;
			parent.document.form_busqueda.paginas.innerHTML="";

			parent.document.getElementById("prevpagina").value = contador-10;
			parent.document.getElementById("currentpage").value = indice+1;
			parent.document.getElementById("nextpagina").value = contador + 10;

			while (contador<=numfilas) {

				texto=contador + " al " + parseInt(contador+9);
				if (parseInt(indi)==parseInt(contador)) {
					if (indi==1) {
					parent.document.getElementById("first").style.display = 'none';
					parent.document.getElementById("prev").style.display = 'none';
					parent.document.getElementById("firstdisab").style.display = 'block';
					parent.document.getElementById("prevdisab").style.display = 'block';
					} else {
					parent.document.getElementById("first").style.display = 'block';
					parent.document.getElementById("prev").style.display = 'block';
					parent.document.getElementById("firstdisab").style.display = 'none';
					parent.document.getElementById("prevdisab").style.display = 'none';
					}
					parent.document.getElementById("prevpagina").value = contador-10;
					parent.document.getElementById("currentpage").value = indice + 1;
					parent.document.getElementById("nextpagina").value = contador + 10;

					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
					indiaux=	indice;				
					
				} else {

					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.getElementById("lastpagina").value = contador;
				}
				indice++;
				contador=contador+10;
			}	

					if (parseInt(indiaux) == parseInt(indice)-1 ) {
					parent.document.getElementById("nextdisab").style.display = 'block';
					parent.document.getElementById("lastdisab").style.display = 'block';
					parent.document.getElementById("last").style.display = 'none';
					parent.document.getElementById("next").style.display = 'none';
					} else {
					parent.document.getElementById("nextdisab").style.display = 'none';
					parent.document.getElementById("lastdisab").style.display = 'none';
					parent.document.getElementById("last").style.display = 'block';
					parent.document.getElementById("next").style.display = 'block';
					}

		}
		</script>
	
	</head>

	<body onload="inicio();">	
		<div id="pagina">
			<div id="zonaContenido">
			<div align="center">
			<div class="header" style="width:100%;position: fixed;">	Listado de Services </div>

 			
 
<div class="fixed-table-container">
      <div class="header-background cabeceraTabla"> </div>      			
<div class="fixed-table-container-inner">
			
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
				<thead>
						<tr>
							<th width="8%"> <div class="th-inner">FECHA</div></th>
							<th width="8%"><div class="th-inner">&nbsp;EQUIPO/Otro</div></th>							
							<th width="8%"><div class="th-inner">&nbsp;TIPO</div></th>
							<th width="34%"><div class="th-inner">&nbsp;DETALLE</div></th>
							<th width="8%"><div class="th-inner">&nbsp;SOL. POR</div></th>
							<th width="8%"><div class="th-inner">HORAS</div></th>
							<th width="8%"><div class="th-inner">ESTADO</div></th>
							<th width="8%"><div class="th-inner">IMPORTE</div></th>
							<th width="8%"><div class="th-inner">FACTURADO</div></th>
							<th colspan="3"><div class="th-inner">ACCIÓN</div></th>
						</tr>
				</thead>
          <tbody>				

			<input type="hidden" id="e" name="e" value="<?php echo $e?>">
			<input type="hidden" name="numfilas" id="numfilas" value="<?php echo $filas?>">
				<?php $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) {
						$Tipo = array( 0=>"Llamada", 1=>"Service", 2=>"Mantenimiento", 3=>"Consulta");
						$estadoarray = array(0=>"Pendiente", 1=>"Asignado", 2=>"Terminado");
						$estadocolor = array(0=>"red", 1=>"blue", 2=>"green");

						 $sel_resultado="SELECT * FROM service,clientes WHERE service.borrado=0 AND service.codcliente=clientes.codcliente AND ".$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysql_query($sel_resultado);
						   $contador=0;
						   while ($contador < mysql_num_rows($res_resultado)) { 
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td width="8%" class="aDerecha"><div align="center"><?php echo implota(mysql_result($res_resultado,$contador,"fecha"));?></div></td>
							<td width="8%" ><div align="left"><?php
							if ( mysql_result($res_resultado,$contador,"codequipo")!=0){
								$codequipo= mysql_result($res_resultado,$contador,"codequipo");
									$consulta="SELECT * FROM equipos WHERE borrado=0 AND `codequipo`='".$codequipo."'";
									$rs_tabla = mysql_query($consulta);
									echo mysql_result($rs_tabla,0,"alias");
							} else {
								echo 'Horas';
							}
							?></div></td>
							<td width="8%" ><div align="left">
							<?php 
							
							 if (is_numeric(mysql_result($res_resultado,$contador,"tipo") )) {
								echo $Tipo[mysql_result($res_resultado,$contador,"tipo")];
							 } else {
								echo mysql_result($res_resultado,$contador,"tipo");
							 }							
							?>
							
							</div></td>							
							<td width="34%"><div align="left"><?php
							if(!empty(mysql_result($res_resultado,$contador,"detalles"))){
								echo mysql_result($res_resultado,$contador,"detalles");
							} else {
								echo mysql_result($res_resultado,$contador,"realizado");
							}
						?></div></td>							
							<td width="8%"><div align="left"><?php echo mysql_result($res_resultado,$contador,"solicito");?></div></td>							
							<td width="8%"><div align="center"><?php echo number_format(mysql_result($res_resultado,$contador,"horas"),2,",",".");?></div></td>
							<td width="8%" style="background-color:<?php echo $estadocolor[mysql_result($res_resultado,$contador,"estado")];?>"><div align="center">
							<?php echo $estadoarray[mysql_result($res_resultado,$contador,"estado")];?></div></td>							
							<td width="8%"><div align="center"><?php echo number_format(mysql_result($res_resultado,$contador,"importe"),2,",",".");?></div></td>
							<td width="8%"><div align="left"><?php echo implota(mysql_result($res_resultado,$contador,"facturado"));?></div></td>
							<?php
							if ( mysql_result($res_resultado,$contador,"codequipo")!=0){
							?>
							<td ><div align="center"><a href="#"><img id="botonBusqueda" src="../../img/modificar.png" width="16" height="16" border="0" onClick="modificar_service(<?php echo mysql_result($res_resultado,$contador,"codservice")?>)" title="Modificar"></a></div></td>
							<td ><div align="center"><a href="#"><img id="botonBusqueda" src="../../img/ver.png" width="16" height="16" border="0" onClick="ver_service(<?php echo mysql_result($res_resultado,$contador,"codservice")?>)" title="Visualizar"></a></div></td>
							<td ><div align="center"><a href="#"><img id="botonBusqueda" src="../../img/eliminar.png" width="16" height="16" border="0" onClick="eliminar_service(<?php echo mysql_result($res_resultado,$contador,"codservice")?>)" title="Eliminar"></a></div></td>
							<?php
							} else {
							?>
							<td ><div align="center"><a href="#"><img id="botonBusqueda" src="../../img/modificar.png" width="16" height="16" border="0" onClick="modificar_service_horas(<?php echo mysql_result($res_resultado,$contador,"codservice")?>)" title="Modificar"></a></div></td>
							<td ><div align="center"><a href="#"><img id="botonBusqueda" src="../../img/ver.png" width="16" height="16" border="0" onClick="ver_service_horas(<?php echo mysql_result($res_resultado,$contador,"codservice")?>)" title="Visualizar"></a></div></td>
							<td ><div align="center"><a href="#"><img id="botonBusqueda" src="../../img/eliminar.png" width="16" height="16" border="0" onClick="eliminar_service(<?php echo mysql_result($res_resultado,$contador,"codservice")?>)" title="Eliminar"></a></div></td>
							<?php
							}
							?>														
						</tr>
						<?php $contador++;
							}
						?>	
						</tbody>		
					</table>
					<?php } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ningun service registrado para este cliente";?></td>
					    </tr>
					   </tbody>
					</table>					
					<?php } ?>	
					</div>				
   </div>
   			</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
