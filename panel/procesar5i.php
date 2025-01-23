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

$idCategoria = $_REQUEST['idus']; // Obtener el ID de la categoría a editar
$nombres = $_REQUEST['nombres'];
$descripcion = $_REQUEST['descripcion'];
$visible = $_REQUEST['visible'];

// Primero obtener la imagen actual de la categoría
$query = "SELECT image FROM categories WHERE id = '$idCategoria'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$currentImage = $row['image'];

// Procesar la nueva imagen si es que se sube una nueva
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    $fotoTmpPath = $foto['tmp_name'];
    $fotoSize = $foto['size'];
    $fotoType = $foto['type'];

    // Verificar si el archivo es una imagen válida
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
    if (in_array($fotoType, $allowedMimeTypes)) {
        // Crear la ruta del archivo en la carpeta uploads/category/
         $uploadDir = '../../ebook/uploads/category/';
        /*if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crear el directorio si no existe
        }*/

        // Generar un nombre único para la imagen para evitar conflictos
        $fileName = uniqid('img_', true) . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
        $uploadFilePath = $uploadDir . $fileName;

        // Mover la imagen de la carpeta temporal a la carpeta uploads/category/
        if (move_uploaded_file($fotoTmpPath, $uploadFilePath)) {
            // Si ya existía una imagen, eliminarla del servidor
            if ($currentImage && file_exists($uploadDir . $currentImage)) {
                unlink($uploadDir . $currentImage); // Eliminar la imagen anterior
            }

            // Actualizar los datos de la categoría en la base de datos, incluyendo la nueva imagen
            $query = "UPDATE categories SET name = '$nombres', description = '$descripcion', status = '$visible', image = '$fileName' WHERE id = '$idCategoria'";
            mysqli_query($link, $query) or die(mysqli_error($link));
        } else {
            echo "Error: No se pudo guardar la imagen en el servidor.";
            exit;
        }
    } else {
        echo "Error: El archivo seleccionado no es una imagen válida. Solo se aceptan JPEG, PNG, GIF o SVG.";
        exit;
    }
} else {
    // Si no se sube una nueva imagen, solo actualizamos los campos de la categoría (sin cambiar la imagen)
    $query = "UPDATE categories SET name = '$nombres', description = '$descripcion', status = '$visible' WHERE id = '$idCategoria'";
    mysqli_query($link, $query) or die(mysqli_error($link));
}

header("Location: categorias.php"); // Redirigir a la página de categorías
mysqli_close($link);
?>