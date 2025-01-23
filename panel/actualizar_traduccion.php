<?php
// Asegurarse de que se recibió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'], $_POST['lang'], $_POST['translation'])) {
    $key = $_POST['key'];  // La clave de la traducción
    $lang = $_POST['lang'];  // El idioma seleccionado
    $translation = $_POST['translation'];  // La nueva traducción

    // Obtener las traducciones actuales desde el archivo JSON
    $translations = json_decode(file_get_contents('../../web/translations.json'), true);

    // Verificar si el idioma existe en las traducciones, si no, crearlo
    if (!isset($translations[$lang])) {
        $translations[$lang] = [];
    }

    // Actualizar la traducción de la clave en el idioma seleccionado
    $translations[$lang][$key] = $translation;

    // Guardar las traducciones actualizadas en el archivo JSON
    file_put_contents('../../web/translations.json', json_encode($translations, JSON_PRETTY_PRINT));

    // Redirigir a la página de traducciones después de editar
    header("Location: traducciones.php");
    exit();
} else {
    echo "<p>Error: Los datos no son válidos.</p>";
}
?>