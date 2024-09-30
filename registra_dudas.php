<?php

$modulosPermitidos = ['Programación', 'Sistemas', 'Redes', 'Base de Datos', 'Entornos de Desarrollo'];

$errores = [];

$correo = $_POST["correo"] ?? '';
$modulo = $_POST["modulo"] ?? '';
$asunto = $_POST["asunto"] ?? '';
$descripcion = $_POST["descripcion"] ?? '';

// Validar el correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El correo no tiene un formato válido.";
}

// Validar que el módulo sea uno de los permitidos
if (!in_array($modulo, $modulosPermitidos)) {
    $errores[] = "El módulo seleccionado no es válido.";
}

// Validar el asunto
if (strlen($asunto) > 50 || preg_match('/\d/', $asunto)) {
    $errores[] = "El asunto no puede tener más de 50 caracteres ni contener números.";
}

// Validar la descripción
if (strlen($descripcion) > 300) {
    $errores[] = "La descripción no puede tener más de 300 caracteres.";
}

// Si hay errores, mostrar la página de errores
if (!empty($errores)) {
    echo "<h1>Errores de validación</h1>";
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<a href="formulario.php">Volver al formulario</a>';
    exit();
}

// Crear la línea en formato CSV
$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\n";

// Especificar la ruta del archivo
$archivo = 'data/dudas.csv';

// Abrir el archivo en modo de adición
$file = fopen($archivo, 'a');

// Comprobar si el archivo se abrió correctamente
if ($file) {
    // Escribir la línea en el archivo
    fwrite($file, $linea);
    // Cerrar el archivo
    fclose($file);

    // Mostrar mensaje de éxito
    echo "<h1>Duda registrada exitosamente.</h1>";
    echo '<a href="formulario.php">Volver a enviar otro formulario</a>';
} else {
    echo "Error al abrir el archivo.";
}

?>
