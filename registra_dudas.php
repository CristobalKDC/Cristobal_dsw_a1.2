<?php

require 'validaciones.php';

// Verificamos si hay datos enviados
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
    exit("Acceso no autorizado.");
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

if (!validarTemas($temas)) {
    $errores[] = "Debe seleccionar entre 1 y 3 temas.";
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


// Proteger Contra Ataques XSS
$correo = htmlspecialchars($correo);
$modulo = htmlspecialchars($modulo);
$asunto = htmlspecialchars($asunto);
$descripcion = htmlspecialchars($descripcion);
$temasSeleccionados = '"' . implode(',', array_map('htmlspecialchars', $temas)) . '"'; 

// Crear la línea en formato CSV
$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\";$temasSeleccionados\n";

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

