# Routing-System - Implementierungsübersicht

## Was wurde umgesetzt?

Deine Anwendung nutzt jetzt ein **modernes Routing-System mit Front-Controller-Pattern**. Alle Anfragen laufen über die `public/index.php` und werden vom Router an die entsprechenden Controller weitergeleitet.

## Neue Struktur

### 1. Router (`src/classes/Router.php`)
- Verwaltet alle Routes der Anwendung
- Unterstützt URL-Parameter (z.B. `/article/edit/{id}`)
- Unterscheidet zwischen GET und POST Requests
- Verwendet RegEx für flexibles URL-Matching

### 2. Controller (`src/classes/Controller/`)
- **BaseController**: Basis-Klasse mit gemeinsamen Funktionen (render, redirect, etc.)
- **HomeController**: Startseite mit Artikelliste
- **ArticleController**: CRUD-Operationen für Artikel

### 3. .htaccess (`public/.htaccess`)
- Leitet alle Requests zur index.php um (außer existierende Dateien/Ordner)
- Ermöglicht saubere URLs ohne `.php` Endung

### 4. Front-Controller (`public/index.php`)
- Zentrale Einstiegsdatei für alle Requests
- Definiert alle verfügbaren Routes
- Initialisiert Router und verarbeitet Requests

## Verfügbare Routes

```php
GET  /                          → HomeController::index()        // Artikelliste
GET  /article/create            → ArticleController::create()    // Formular zum Erstellen
POST /article/create            → ArticleController::create()    // Artikel speichern
GET  /article/edit/{id}         → ArticleController::edit()      // Formular zum Bearbeiten
POST /article/edit/{id}         → ArticleController::edit()      // Artikel aktualisieren
GET  /article/delete/{id}       → ArticleController::delete()    // Artikel löschen
```

## Vorteile

✅ **Saubere URLs**: `/article/edit/5` statt `form.php?id=5`
✅ **Zentrale Verwaltung**: Alle Routes an einem Ort
✅ **Wartbar**: Controller-Klassen statt verstreute PHP-Dateien
✅ **Erweiterbar**: Neue Routes einfach hinzufügen
✅ **Best Practice**: Moderne MVC-Struktur

## Wie du neue Routes hinzufügst

1. Öffne `public/index.php`
2. Füge eine neue Route hinzu:
```php
$router->get('/deine/route', DeinController::class, 'methode');
```
3. Erstelle den Controller in `src/classes/Controller/`
4. Der Controller erbt von `BaseController` und hat Zugriff auf:
   - `$this->render($template, $data)` - Template rendern
   - `$this->redirect($url)` - Weiterleitung
   - `$this->isPostRequest()` - POST-Request prüfen

## Migration der alten Dateien

### ✅ Migriert:
- `public/form.php` → `ArticleController::create()` und `ArticleController::edit()`
- `public/delete.php` → `ArticleController::delete()`
- Alte `index.php` → `HomeController::index()`

### ⚠️ Alte Dateien können gelöscht werden:
Du kannst die alten Dateien behalten als Backup oder löschen:
- `public/form.php` (nicht mehr benötigt)
- `public/delete.php` (nicht mehr benötigt)

## Testen

1. Stelle sicher, dass mod_rewrite in Apache aktiviert ist
2. Rufe `http://localhost/gfu/` auf
3. Die Artikelliste sollte erscheinen
4. Teste "Artikel erstellen" und "Bearbeiten"

## Troubleshooting

### Problem: 404 Fehler
**Lösung**: Prüfe, ob mod_rewrite aktiviert ist:
```apache
# In httpd.conf
LoadModule rewrite_module modules/mod_rewrite.so
```

### Problem: Controller nicht gefunden
**Lösung**: Prüfe den Namespace in deinem Controller:
```php
namespace App\Controller;
```

### Problem: Template nicht gefunden
**Lösung**: Prüfe den Template-Pfad in `BaseController`

