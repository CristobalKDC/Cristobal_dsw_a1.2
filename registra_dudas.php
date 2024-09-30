<?php

// Función para validar el correo
function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
}

// Módulos disponibles en 2º DAW almacenados en un array
// Función para validar el módulo
function validarModulo($modulo) {
    $modulosValidos = [
        "Programación",
        "Base de Datos",
        "Sistemas",
        "Entornos de Desarrollo",
        "Desarrollo Web"
    ];
    return in_array($modulo, $modulosValidos);
}

// Función para validar el asunto
function validarAsunto($asunto) {
    return strlen($asunto) <= 50 && !preg_match('/\d/', $asunto);
}

// Función para validar la descripción
function validarDescripcion($descripcion) {
    return strlen($descripcion) <= 300;
}


// Recibimos los datos del formulario
$correo = $_POST["correo"];
$modulo = $_POST["modulo"];
$asunto = $_POST["asunto"];
$descripcion = $_POST["descripcion"];
$temas = isset($_POST["temas"]) ? $_POST["temas"] : []; 
 
$errores = [];

// Validaciones

if (!validarCorreo($correo)) {
    $errores[] = "El correo proporcionado no es válido.";
}

if (!validarModulo($modulo)) {
    $errores[] = "El módulo seleccionado no es válido.";
}

if (!validarAsunto($asunto)) {
    $errores[] = "El asunto no puede tener más de 50 caracteres y no puede ser numérico.";
}

if (!validarDescripcion($descripcion)) {
    $errores[] = "La descripción no puede tener más de 300 caracteres.";
}


// Si hay errores, mostrar la página de errores
if (!empty($errores)) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Errores de Validación</title>
    </head>
    <body>
        <h1>Se encontraron errores en su envío</h1>
        <ul>";
    
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    
    echo "</ul>
        <a href='formulario.php'>Volver al formulario</a>
    </body>
    </html>";
    exit();
}


// Si no hay errores, guardar los datos en el archivo


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
    echo "Duda registrada exitosamente.";
    
    // Redirigir a la página enviado.php
    header('Location: enviado.php');
    exit();

} else {
    echo "Error al abrir el archivo.";
}




//Comprobamos que recibio los datos
// echo "<pre></pre>";
// echo "Correo: $correo" ;
// echo "<pre></pre>";
// echo "Modulo: $modulo" ;
// echo "<pre></pre>";
// echo "Asunto: $asunto" ;
// echo "<pre></pre>";
// echo "Descripcion: $descripcion" ;



?>

