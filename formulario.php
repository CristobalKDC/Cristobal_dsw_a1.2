<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    
    <h2>Formulario de Dudas - 2º DAW</h2>

    <form action="registra_dudas.php" method="POST">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <br>
        <br>

        <label for="modulo">Módulo:</label>
        <select id="modulo" name="modulo" required>
            <option value="">Seleccione un módulo</option>
            <option value="Programación">Programación</option>
            <option value="Base de Datos">Base de Datos</option>
            <option value="Sistemas">Sistemas</option>
            <option value="Entornos de Desarrollo">Entornos de Desarrollo</option>
            <option value="Desarrollo Web">Desarrollo Web</option>
        </select>
        <br>
        <br>

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required>
        <br>
        <br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="5" required></textarea>
        <br>
        <br>

        <button type="submit">Enviar Duda</button>
    </form>
</body>

</html>