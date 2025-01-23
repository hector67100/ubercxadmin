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

// Obtener el ID del producto a eliminar
$idProducto = $_GET['id_producto']; // Obtener el id del producto desde la URL

if (isset($idProducto) && is_numeric($idProducto)) {
    // Eliminar el producto de la base de datos
    $query = "DELETE FROM products WHERE id = '$idProducto'";

    if (mysqli_query($link, $query)) {
        // Redirigir a la página de productos después de la eliminación
        header("Location: libros.php?message=Producto eliminado exitosamente");
    } else {
        // Si ocurre un error al eliminar, mostrar el error
        echo "Error al eliminar el producto: " . mysqli_error($link);
    }
} else {
    echo "ID de producto inválido.";
}

mysqli_close($link);
?>