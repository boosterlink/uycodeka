<html>
<head>
<title>Buscador de Clientes</title>
<script>
var cursor;
		if (document.all) {
		/*/ Está utilizando EXPLORER*/
		cursor='hand';
		} else {
		/*/ Está utilizando MOZILLA/NETSCAPE*/
		cursor='pointer';
		}


function buscar() {
	if (document.getElementById("iniciopagina").value=="") {
		document.getElementById("iniciopagina").value=1;
	} else {
		document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
	}
	document.getElementById("form1").submit();
	document.getElementById("tabla_resultado").style.display="";
}

function enviar() {
	document.getElementById("form1").submit();
}

</script>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<?php include ("../conectar.php"); ?>
<body onLoad="buscar()">
<form name="form1" id="form1" method="post" action="frame_clientes.php" target="frame_resultado" onSubmit="buscar();">
<div id="frmBusqueda2">
 <div align="center">
	<table class="fuente8" align="center">
     <tr>
		<td class="busqueda">Código:</td>
	    <td><input name="codcliente" type="text" id="codcliente" size="20" class="cajaMedia"></td></tr>
		<tr><td class="busqueda">Descripci&oacute;n:</td>
	    <td><input name="nombre" type="text" id="nombre" size="50" class="cajaGrande"></td>
		</tr>
		<tr>

		  <td colspan="4" align="center"><img id="botonBusqueda" src="../img/botonbuscar.jpg" width="69" height="22" border="1" onClick="enviar();" onMouseOver="style.cursor=cursor"></td>
	  </tr>
</table>
</div>
</div>




  <table width="95%" id="tabla_resultado" name="tabla_resultado" style="display:none" align="center">
	<tr>
  		<td>
			<iframe width="100%" height="300" id="frame_resultado" name="frame_resultado">
				<ilayer width="100%" height="300" id="frame_resultado" name="frame_resultado"></ilayer>
			</iframe>
		</td>
	</tr>
</table>
<input type="hidden" id="iniciopagina" name="iniciopagina">
<table width="100%" border="0">
  <tr>
    <td><div align="center">
      <img id="botonBusqueda" src="../img/botoncerrar.jpg" width="70" height="22" onClick="parent.$('idOfDomElement').colorbox.close();" border="1" onMouseOver="style.cursor=cursor">
    </div></td>
  </tr>
</table>

</form>
</body>
</html>
