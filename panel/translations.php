<?php

// Ruta del archivo JSON donde se almacenan las traducciones
define('TRANSLATIONS_FILE', '../../web/translations.json');

function getTranslations() {
    if (!file_exists(TRANSLATIONS_FILE)) {
        return [
            "es" => [],
            "en" => [],
            "fr" => []
        ]; // Devolver un JSON vacío para cada idioma si el archivo no existe
    }

    $json = file_get_contents(TRANSLATIONS_FILE);
    return json_decode($json, true);
}

// Función para guardar las traducciones en el archivo JSON
function saveTranslations($translations) {
    $json = json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(TRANSLATIONS_FILE, $json);
}

// Función para obtener la traducción de una clave específica
function getTranslation($key, $lang) {
    $translations = getTranslations();
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    }
    return null;  // Retorna null si la traducción no existe
}

// Función para actualizar o agregar una traducción
function updateTranslation($key, $lang, $newTranslation) {
    $translations = getTranslations();

    // Verifica que el idioma exista
    if (!isset($translations[$lang])) {
        $translations[$lang] = []; // Si no existe, lo inicializa
    }

    // Actualiza o agrega la traducción para la clave dada
    $translations[$lang][$key] = $newTranslation;

    // Guarda el archivo con las nuevas traducciones
    saveTranslations($translations);
}

$translations = getTranslations();

?>