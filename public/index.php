<?php
/**
 * FRONT CONTROLLER
 * Point d'entrée unique du site
 */

// ============================================
// 1. DÉFINIR LES CONSTANTES
// ============================================
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', __DIR__);
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('VIEW_PATH', APP_PATH . '/views');

// ============================================
// 2. CONFIGURATION & AUTOLOADER
// ============================================
require_once APP_PATH . '/config/app.php';
require_once APP_PATH . '/core/Autoloader.php';

// Démarrer l'autoloader
new Autoloader();

// ============================================
// 3. GESTION DES ERREURS
// ============================================
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    Logger::error("[$errno] $errstr in $errfile:$errline");
    if (APP_ENV !== 'production') {
        echo "<div style='background: #fee; padding: 10px; border: 1px solid #f00; margin: 10px;'>";
        echo "<b>Erreur:</b> $errstr<br>";
        echo "<small>$errfile:$errline</small></div>";
    }
});

// ============================================
// 4. DÉMARRER LA SESSION
// ============================================
session_start();

// ============================================
// 5. ROUTER PRINCIPAL
// ============================================
try {
    $router = new Router();
    
    // Charger les routes
    require APP_PATH . '/routes/web.php';
    
    $router->dispatch();
} catch (Exception $e) {
    Logger::error($e->getMessage());
    http_response_code(500);
    if (APP_ENV !== 'production') {
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    } else {
        echo "Une erreur est survenue. Contactez l'administrateur.";
    }
}
?>
