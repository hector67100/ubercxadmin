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

$idProducto = $_REQUEST['id']; // Obtener el ID del producto a editar
$category_id = $_REQUEST['category_id'];
$tag_id = $_REQUEST['tag_id'];
$name = $_REQUEST['name'];
$status = $_REQUEST['status'];
$type = $_REQUEST['type'];
$language_id = $_REQUEST['language_id'];
$city = $_REQUEST['city'];
$audio_link = $_REQUEST['audio_link'];
$description = $_REQUEST['description'];
$author_name = $_REQUEST['author_name'];
$p_length = $_REQUEST['p_length'];
$book_count = $_REQUEST['book_count'];

// Primero obtener la ruta del archivo PDF actual del producto
$query = "SELECT upload_data FROM products WHERE id = '$idProducto'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$currentFile = $row['upload_data'];

// Procesar el archivo PDF si es que se sube uno nuevo
if (isset($_FILES['upload_data']) && $_FILES['upload_data']['error'] == 0) {
    $upload_data = $_FILES['upload_data'];
    $uploadTmpPath = $upload_data['tmp_name'];
    $uploadFileName = $upload_data['name'];
    $uploadFileType = $upload_data['type'];
    $uploadFileSize = $upload_data['size'];

    // Verificar si el archivo es un PDF válido
    if ($uploadFileType == 'application/pdf') {
        // Crear la ruta del archivo en la carpeta uploads/pdf/
        $uploadDir = '../../ebook/uploads/pdf/';

        // Generar un nombre único para el archivo para evitar conflictos
        $fileName = uniqid('pdf_', true) . '.pdf';
        $uploadFilePath = $uploadDir . $fileName;

        // Mover el archivo de la carpeta temporal a la carpeta uploads/pdf/
        if (move_uploaded_file($uploadTmpPath, $uploadFilePath)) {
            // Si ya existía un archivo PDF, eliminarlo del servidor
            if ($currentFile && file_exists($uploadDir . $currentFile)) {
                unlink($uploadDir . $currentFile); // Eliminar el archivo anterior
            }

            // Actualizar los datos del producto en la base de datos, incluyendo el nuevo archivo
            $query = "UPDATE products SET 
                        category_id = '$category_id', 
                        tag_id = '$tag_id',
                        name = '$name',
                        status = '$status',
                        type = '$type',
                        language_id = '$language_id',
                        city = '$city',
                        audio_link = '$audio_link',
                        description = '$description',
                        author_name = '$author_name',
                        upload_data = '$fileName',
                        p_length = '$p_length',
                        book_count = '$book_count'
                      WHERE id = '$idProducto'";
            mysqli_query($link, $query) or die(mysqli_error($link));
        } else {
            echo "Error: No se pudo guardar el archivo en el servidor.";
            exit;
        }
    } else {
        echo "Error: Solo se aceptan archivos PDF.";
        exit;
    }
} else {
    // Si no se sube un nuevo archivo PDF, solo actualizamos los campos del producto (sin cambiar el archivo)
    $query = "UPDATE products SET 
                category_id = '$category_id', 
                tag_id = '$tag_id',
                name = '$name',
                status = '$status',
                type = '$type',
                language_id = '$language_id',
                city = '$city',
                audio_link = '$audio_link',
                description = '$description',
                author_name = '$author_name',
                p_length = '$p_length',
                book_count = '$book_count'
              WHERE id = '$idProducto'";
    mysqli_query($link, $query) or die(mysqli_error($link));
}

header("Location: libros.php"); // Redirigir a la página de productos
mysqli_close($link);
?>