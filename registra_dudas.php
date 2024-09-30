<?php



// Recibimos los datos del formulario
$correo = $_POST["correo"];
$modulo = $_POST["modulo"];
$asunto = $_POST["asunto"];
$descripcion = $_POST["descripcion"];
$temas = isset($_POST["temas"]) ? $_POST["temas"] : []; 


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

