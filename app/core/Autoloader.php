<?php
/**
 * AUTOLOADER - Chargement automatique des classes
 */
class Autoloader {
    public function __construct() {
        spl_autoload_register([$this, 'load']);
    }

    public function load($class) {
        // Remplacer les namespaces par des slashes
        $file = str_replace('\\', '/', $class);
        $path = APP_PATH . '/' . $file . '.php';

        if (file_exists($path)) {
            require_once $path;
        }
    }
}
?>
