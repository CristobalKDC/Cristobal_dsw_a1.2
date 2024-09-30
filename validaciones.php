<?php

// Función validar correo
function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
}

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

// Función validarasunto
function validarAsunto($asunto) {
    return strlen($asunto) <= 50 && !preg_match('/\d/', $asunto);
}

// Función validar descripción
function validarDescripcion($descripcion) {
    return strlen($descripcion) <= 300;
}

// Función validar temas 
function validarTemas($temas) {
    return count($temas) >= 1 && count($temas) <= 3;
}
?>
