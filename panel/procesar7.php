<?php
include_once('php_lib/config.ini.php');
$link = mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);
if (!$link) {
    trigger_error('Error al conectar al servidor mysql: ');
}
// Seleccionar la base de datos activa
$db_selected = mysqli_select_db($link, BASE_DATOS);
if (!$db_selected) {
    trigger_error('Error al conectar a la base de datos: ');
}
mysqli_set_charset($link, "utf8");

$nombres = $_REQUEST['nombres'];
$codigo = $_REQUEST['codigo'];
$visible = $_REQUEST['visible'];

// Procesar la imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    $fotoTmpPath = $foto['tmp_name'];
    $fotoSize = $foto['size'];
    $fotoType = $foto['type'];

    // Verificar si el archivo es una imagen v���lida (agregamos 'image/svg+xml')
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
    if (in_array($fotoType, $allowedMimeTypes)) {
        // Crear la ruta del archivo en la carpeta uploads/category/
         $uploadDir = '../../ebook/uploads/tags/';
        /*if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crear el directorio si no existe
        }*/

        // Generar un nombre ���nico para la imagen para evitar conflictos
        $fileName = uniqid('img_', true) . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
        $uploadFilePath = $uploadDir . $fileName;

        // Mover la imagen de la carpeta temporal a la carpeta uploads/category/
        if (move_uploaded_file($fotoTmpPath, $uploadFilePath)) {
            // Guardar solo el nombre de la imagen (o la ruta relativa) en la base de datos
            $query = "INSERT INTO provincia (name, status, image, codigo) VALUES ('$nombres', '$visible', '$fileName', '$codigo')";
            mysqli_query($link, $query) or die(mysqli_error($link));
        } else {
            echo "Error: No se pudo guardar la imagen en el servidor.";
            exit;
        }
    } else {
        echo "Error: El archivo seleccionado no es una imagen v���lida. Solo se aceptan JPEG, PNG, GIF o SVG.";
        exit;
    }
} else {
    // Si no se sube imagen, se guarda la categor���a sin la columna 'image'
    $query = "INSERT INTO provincia (name, status, codigo) VALUES ('$nombres', '$visible', '$codigo')";
    mysqli_query($link, $query) or die(mysqli_error($link));
}

header("Location: provincia.php");
mysqli_close($link);
?>