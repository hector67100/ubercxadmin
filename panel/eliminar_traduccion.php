<?php
// Código PHP para eliminar traducción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'])) {
    $key = $_POST['key'];

    // Obtener las traducciones actuales desde el archivo JSON
    $translations = json_decode(file_get_contents('../../web/translations.json'), true);

    // Eliminar la traducción si existe en los idiomas
    foreach ($translations as $lang => $langData) {
        if (isset($translations[$lang][$key])) {
            unset($translations[$lang][$key]);
        }
    }

    // Guardar las traducciones actualizadas en el archivo JSON
    file_put_contents('../../web/translations.json', json_encode($translations, JSON_PRETTY_PRINT));

    // Redirigir a la página principal de traducciones después de la eliminación
    header("Location: traducciones.php");
    exit();
} else {
    echo "<p>Error: No se ha seleccionado ninguna clave para eliminar.</p>";
}
?>