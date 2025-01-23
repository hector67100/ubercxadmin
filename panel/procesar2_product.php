<?php
include_once('php_lib/config.ini.php');
$link = mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);

if (!$link) {
    trigger_error('Error al conectar al servidor MySQL');
}

// Seleccionar la base de datos activa
$db_selected = mysqli_select_db($link, BASE_DATOS);
if (!$db_selected) {
    trigger_error('Error al conectar a la base de datos');
}

mysqli_set_charset($link, "utf8");

// Obtener los datos del formulario
$category_id = $_POST['category_id'];
$tag_id = $_POST['tag_id'];
$name = $_POST['name'];
$status = $_POST['status'];
$type = $_POST['type'];
$language_id = $_POST['language_id'];
$city = $_POST['city'];
$audio_link = $_POST['audio_link'];
$description = $_POST['description'];
$author_name = $_POST['author_name'];
$p_length = $_POST['p_length'];
$book_count = $_POST['book_count'];

// Procesar la imagen de portada
if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
    $cover_image = $_FILES['cover_image'];
    $coverImageTmpPath = $cover_image['tmp_name'];
    $coverImageSize = $cover_image['size'];
    $coverImageType = $cover_image['type'];

    // Verificar si el archivo es una imagen válida
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
    if (in_array($coverImageType, $allowedMimeTypes)) {
        // Crear la ruta del archivo en la carpeta uploads/product/
        $uploadDir = '../../ebook/uploads/product/';
        
        // Generar un nombre único para la imagen para evitar conflictos
        $fileName = uniqid('img_', true) . '.' . pathinfo($cover_image['name'], PATHINFO_EXTENSION);
        $uploadFilePath = $uploadDir . $fileName;

        // Mover la imagen de la carpeta temporal a la carpeta uploads/product/
        if (move_uploaded_file($coverImageTmpPath, $uploadFilePath)) {
            // Insertar los datos del producto en la base de datos, incluyendo la nueva imagen
            $query = "INSERT INTO products 
                      (category_id, tag_id, name, status, type, language_id, city, audio_link, description, author_name, cover_image, p_length, book_count) 
                      VALUES ('$category_id', '$tag_id', '$name', '$status', '$type', '$language_id', '$city', '$audio_link', '$description', '$author_name', '$fileName', '$p_length', '$book_count')";

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
    // Si no se sube una imagen, insertamos el producto sin imagen
    $query = "INSERT INTO products 
              (category_id, tag_id, name, status, type, language_id, city, audio_link, description, author_name, p_length, book_count) 
              VALUES ('$category_id', '$tag_id', '$name', '$status', '$type', '$language_id', '$city', '$audio_link', '$description', '$author_name', '$p_length', '$book_count')";

    mysqli_query($link, $query) or die(mysqli_error($link));
}

// Procesar el archivo PDF (upload_data)
if (isset($_FILES['upload_data']) && $_FILES['upload_data']['error'] == 0) {
    $uploadData = $_FILES['upload_data'];
    $uploadDataTmpPath = $uploadData['tmp_name'];
    $uploadDataSize = $uploadData['size'];
    $uploadDataType = $uploadData['type'];

    // Verificar si el archivo es un PDF
    if ($uploadDataType === 'application/pdf') {
        // Crear la ruta del archivo en la carpeta uploads/pdf/
        $uploadDir = '../../ebook/uploads/pdf/';
        
        // Generar un nombre único para el PDF para evitar conflictos
        $pdfFileName = uniqid('pdf_', true) . '.pdf';
        $uploadPdfPath = $uploadDir . $pdfFileName;

        // Mover el archivo PDF de la carpeta temporal a la carpeta uploads/pdf/
        if (move_uploaded_file($uploadDataTmpPath, $uploadPdfPath)) {
            // Insertar los datos del producto en la base de datos, incluyendo el PDF
            $query = "INSERT INTO products 
                      (category_id, tag_id, name, status, type, language_id, city, audio_link, description, author_name, pdf_file, p_length, book_count) 
                      VALUES ('$category_id', '$tag_id', '$name', '$status', '$type', '$language_id', '$city', '$audio_link', '$description', '$author_name', '$pdfFileName', '$p_length', '$book_count')";

            mysqli_query($link, $query) or die(mysqli_error($link));
        } else {
            echo "Error: No se pudo guardar el archivo PDF en el servidor.";
            exit;
        }
    } else {
        echo "Error: El archivo seleccionado no es un PDF válido.";
        exit;
    }
}

header("Location: libros.php"); // Redirigir a la página de productos
mysqli_close($link);
?>