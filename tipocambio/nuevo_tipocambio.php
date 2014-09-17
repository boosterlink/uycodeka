<?php include ("../conectar.php"); ?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="js/colorbox.css" />
		<script src="js/jquery.colorbox.js"></script>

<script type="text/javascript">
$(document).ready( function()
{
$("form:not(.filter) :input:visible:enabled:first").focus();

		$(".callbacks").colorbox({
			iframe:true, width:"98px", height:"98%",
			onCleanup:function(){ window.location.reload();	}
		});

});
</script>
<script type="text/javascript">
function OpenNote(noteId){

	$.colorbox({
	   	href: noteId, open:true,
			iframe:true, width:"95%", height:"95%",
			
	});

}
function OpenList(noteId){

	$.colorbox({
	   	href: noteId, open:true,
			iframe:true, width:"99%", height:"99%",
			
	});

}

</script>	
		<script language="javascript">
		
		function cancelar() {
			parent.$('idOfDomElement').colorbox.close();
		}
		
		function limpiar() {
			document.getElementById("fecha").value="";
			document.getElementById("valor").value="";
		}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function validar() 
			{
				var mensaje="";
				if (document.getElementById("fecha").value=="") mensaje="  - Fecha\n";
				if (document.getElementById("valor").value=="") mensaje+="  - Valor\n";
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
				document.getElementById("formulario").submit();
				}
			
			}		
			
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">INSERTAR tipocambio </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_tipocambio.php">
				  <table class="fuente8" cellspacing=0 cellpadding=3 border=0>
						<?php $hoy=date("d/m/Y"); ?>
                    <tr>
							<td>Fecha</td>
						    <td><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" value="<?php echo $hoy?>" readonly>
						    <td><img src="../img/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'"></td>
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
				            <td>Valor</td>
				            <td><input NAME="valor" type="text" class="cajaPequena" id="valor" size="7" maxlength="7" value="<?php echo $valor; ?>"></td>
						</tr>

                  </table>
				  </div>
				<div>
					<img id="botonBusqueda" src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">
					<img id="botonBusqueda" src="../img/botonlimpiar.jpg" width="69" height="22" onClick="limpiar()" border="1" onMouseOver="style.cursor=cursor">
					<img id="botonBusqueda" src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
					<input id="accion" name="accion" value="alta" type="hidden">
					<input id="id" name="id" value="" type="hidden">
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
