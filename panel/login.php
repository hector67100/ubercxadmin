<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // ¿Nos mandan datos por el formulario?
    include('php_lib/config.ini.php'); // incluimos configuración
    include('php_lib/login.lib.php'); // incluimos las funciones

    // verificamos el usuario y contraseña mandados
    if (login($_POST['email'], $_POST['password'])) {
        // Acciones a realizar cuando un usuario se identifica
        header('Content-Type: application/json');
        echo json_encode(['success' => true]); // Respuesta JSON de éxito
        exit;
    } else {
        // Respuesta JSON de error
        header('Content-Type: application/json');
        echo json_encode(['success' => false]); // Respuesta JSON de fallo
        exit;
    }
}
?>