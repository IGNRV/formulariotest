<?php
// Obtener los datos enviados desde el formulario
$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];

// Conexión a la base de datos

require_once("conexion.php");

// Construir la consulta SQL
$sql = "SELECT * FROM customer WHERE 1=1";

if (!empty($rut)) {
    $sql .= " AND rut = '$rut'";
}

if (!empty($nombre)) {
    $sql .= " AND name = '$nombre'";
}

if (!empty($direccion)) {
    $sql .= " AND address = '$direccion'";
}

// Ejecutar la consulta SQL
$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontraron resultados
if (mysqli_num_rows($resultado) > 0) {
    // Mostrar los clientes encontrados
    echo "<h1>Clientes encontrados:</h1>";
    echo "<table>";
    echo "<tr><th>Rut</th><th>Nombre</th><th>Dirección</th></tr>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr><td>" . $fila['rut'] . "</td><td>" . $fila['name'] . "</td><td>" . $fila['address'] . "</td></tr>";
    }
    echo "</table>";
} else {
    // Mostrar un mensaje de error si no se encontraron clientes
    echo "<h1>No se encontraron clientes</h1>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
