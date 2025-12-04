<?php

declare(strict_types=1);

// Einfacher Autoloader für das Namespace 'App\' -> Dateien in src/classes
// Diese Datei registriert den Autoloader direkt beim Einbinden.

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if ( ! str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file = __DIR__ . '/classes/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

