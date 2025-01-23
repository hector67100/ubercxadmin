<?php
// Asegurarse de que se recibió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'], $_POST['lang'], $_POST['translation'])) {
    $key = $_POST['key'];  // La clave de la traducción
    $lang = $_POST['lang'];  // El idioma seleccionado
    $translation = $_POST['translation'];  // La traducción proporcionada

    // Obtener las traducciones actuales desde el archivo JSON
    $translations = json_decode(file_get_contents('../../web/translations.json'), true);

    // Verificar si el idioma ya existe en el JSON, si no, crearlo
    if (!isset($translations[$lang])) {
        $translations[$lang] = [];
    }

    // Agregar la nueva traducción para la clave y el idioma seleccionados
    $translations[$lang][$key] = $translation;

    // Guardar las traducciones actualizadas en el archivo JSON
    file_put_contents('../../web/translations.json', json_encode($translations, JSON_PRETTY_PRINT));

    // Redirigir a la página de traducciones después de crear la nueva traducción
    header("Location: traducciones.php");
    exit();
} else {
    echo "<p>Error: Los datos no son válidos.</p>";
}
?>