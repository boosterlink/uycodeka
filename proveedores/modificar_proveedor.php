<?php include ("../conectar.php"); 

$codproveedor=$_GET["codproveedor"];

$query="SELECT * FROM proveedores WHERE codproveedor='$codproveedor'";
$rs_query=mysql_query($query);

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<script language="javascript">
		
		function cancelar() {
			parent.$('idOfDomElement').colorbox.close();
		}
		
		var cursor;
		if (document.all) {
		/*/ Está utilizando EXPLORER*/
		cursor='hand';
		} else {
		/*/ Está utilizando MOZILLA/NETSCAPE*/
		cursor='pointer';
		}
		
		function limpiar() {
			document.getElementById("formulario").reset();
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">MODIFICAR PROVEEDOR </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_proveedor.php">
				<table class="fuente8" width="100%" border="0"><tr><td>
					<table class="fuente8" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td>C&oacute;digo</td>
							<td><?php echo $codproveedor?></td>
						    
						</tr>
						<tr>
							<td width="15%">Nombre</td>
						    <td width="43%"><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45" value="<?php echo mysql_result($rs_query,0,"nombre")?>"></td>
				        </tr>
						<tr>
						  <td>RUT</td>
						  <td><input id="nif" type="text" class="cajaPequena" NAME="anif" maxlength="15" value="<?php echo mysql_result($rs_query,0,"nif")?>"></td>
				      </tr>
						<tr>
						  <td>Direcci&oacute;n</td>
						  <td><input NAME="adireccion" type="text" class="cajaGrande" id="direccion" size="45" maxlength="45" value="<?php echo mysql_result($rs_query,0,"direccion")?>"></td>
				      </tr>
						<tr>
						  <td>Localidad</td>
						  <td><input NAME="alocalidad" type="text" class="cajaGrande" id="localidad" size="35" maxlength="35" value="<?php echo mysql_result($rs_query,0,"localidad")?>"></td>
				      </tr>
					  <?php
					  	$codprovincia=mysql_result($rs_query,0,"codprovincia");
					  	$query_provincias="SELECT * FROM provincias ORDER BY nombreprovincia ASC";
						$res_provincias=mysql_query($query_provincias);
						$contador=0;
					  ?>
						<tr>
							<td width="15%">Departamento</td>
							<td width="43%"><select id="cboProvincias" name="cboProvincias" class="comboGrande">
							<option value="0">Seleccione una provincia</option>
								<?php
								while ($contador < mysql_num_rows($res_provincias)) { 
									if ($codprovincia == mysql_result($res_provincias,$contador,"codprovincia")) {?>
								<option value="<?php echo mysql_result($res_provincias,$contador,"codprovincia")?>" selected="selected"><?php echo mysql_result($res_provincias,$contador,"nombreprovincia")?></option>
								<?php } else { ?>
									<option value="<?php echo mysql_result($res_provincias,$contador,"codprovincia")?>"><?php echo mysql_result($res_provincias,$contador,"nombreprovincia")?></option>
								<?php } $contador++;
								} ?>				
								</select>							</td>
				        </tr>						
						<?php
						$codentidad=mysql_result($rs_query,0,"codentidad");
					  	$query_entidades="SELECT * FROM entidades WHERE borrado=0 ORDER BY nombreentidad ASC";
						$res_entidades=mysql_query($query_entidades);
						$contador=0;
					  ?>
						<tr>
							<td width="15%" height="26">Entidad Bancaria</td>
							<td width="43%"><select id="cboBanco" name="cboBanco" class="comboGrande">
							<option value="0">Seleccione una Entidad Bancaria</option>
									<?php
								while ($contador < mysql_num_rows($res_entidades)) { 
									if ($codentidad == mysql_result($res_entidades,$contador,"codentidad")) { ?>
								<option value="<?php echo mysql_result($res_entidades,$contador,"codentidad")?>" selected="selected"><?php echo mysql_result($res_entidades,$contador,"nombreentidad")?></option>
								<?php } else { ?>
								<option value="<?php echo mysql_result($res_entidades,$contador,"codentidad")?>"><?php echo mysql_result($res_entidades,$contador,"nombreentidad")?></option>
								<?php } $contador++;
								} ?>
											</select>							</td>
				        </tr>
						<tr>
							<td>Cuenta&nbsp;bancaria</td>
							<td><input id="cuentabanco" type="text" class="cajaGrande" NAME="acuentabanco" maxlength="20" value="<?php echo mysql_result($rs_query,0,"cuentabancaria")?>"></td>
					    </tr>
						</table></td><td>					    
					    <table class="fuente8" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td>C&oacute;digo&nbsp;postal </td>
							<td><input id="codpostal" type="text" class="cajaPequena" NAME="acodpostal" maxlength="5" value="<?php echo mysql_result($rs_query,0,"codpostal")?>"></td>
					    </tr>
						<tr>
							<td>Tel&eacute;fono </td>
							<td><input id="telefono" name="atelefono" type="text" class="cajaPequena" maxlength="14" value="<?php echo mysql_result($rs_query,0,"telefono")?>"></td>
					    </tr>
						<tr>
							<td>M&oacute;vil</td>
							<td><input id="movil" name="amovil" type="text" class="cajaPequena" maxlength="14" value="<?php echo mysql_result($rs_query,0,"movil")?>"></td>
					    </tr>
						<tr>
							<td>Correo&nbsp;electr&oacute;nico  </td>
							<td><input NAME="aemail" type="text" class="cajaGrande" id="email" size="35" maxlength="35" value="<?php echo mysql_result($rs_query,0,"email")?>"></td>
					    </tr>
												<tr>
							<td>Direcci&oacute;n&nbsp;web </td>
							<td><input NAME="aweb" type="text" class="cajaGrande" id="web" size="45" maxlength="45" value="<?php echo mysql_result($rs_query,0,"web")?>"></td>
					    </tr>
					</table>
				</td></tr></table>
			  </div>
				<div>
					<img id="botonBusqueda" src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">
					<img id="botonBusqueda" src="../img/botonlimpiar.jpg" width="69" height="22" onClick="limpiar()" border="1" onMouseOver="style.cursor=cursor">
					<img id="botonBusqueda" src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
					<input id="accion" name="accion" value="modificar" type="hidden">
					<input id="id" name="id" value="<?php echo $codproveedor?>" type="hidden">
			  </div>
			  </form>
			  </div>
		  </div>
		</div>
		<div id="ErrorBusqueda" class="fuente8">
 <ul id="lista-errores" style="display:none; 
	clear: both; 
	max-height: 75%; 
	overflow: auto; 
	position:relative; 
	top: 85px; 
	margin-left: 30px; 
	z-index:999; 
	padding-top: 10px; 
	background: #FFFFFF; 
	width: 585px; 
	-moz-box-shadow: 0 0 5px 5px #888;
	-webkit-box-shadow: 0 0 5px 5px#888;
 	box-shadow: 0 0 5px 5px #888; 
 	bottom: 10px;"></ul>	
 
 	</div>			
	</body>
</html>