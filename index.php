<!DOCTYPE html>
<html>
<head>
	<title>Buscar cliente</title>
    <script>
function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    var cuerpo = valor.slice(0,-1);
    var dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Expresión regular para validar RUT
    var regex = /^[0-9]+[-]?[0-9kK]{1}$/;
    if(!regex.test(rut.value)) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Calcular Dígito Verificador
    var suma = 0;
    var multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(var i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        var index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    var dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}

	</script>
</head>
<body>
	<h1>Buscar cliente</h1>
	<form action="buscar.php" method="post" >
		<label for="rut">Rut:</label>
		<input type="text" name="rut" id="rut" required onInput="checkRut(this)"><br>

		<label for="nombre">Nombre:</label>
		<input type="text" name="nombre" id="nombre" ><br>

		<label for="direccion">Dirección:</label>
		<input type="text" name="direccion" id="direccion" ><br>

		<input type="submit" value="Buscar">
	</form>
</body>
</html>
