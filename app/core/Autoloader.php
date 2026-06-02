<?php
/**
 * AUTOLOADER - Chargement automatique des classes
 */

class Autoloader
{
    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    public function autoload($class)
    {
        // Remplacer les backslashes par des slashes
        $path = str_replace('\\', '/', $class);
        
        // Chercher dans app/core
        $file = APP_PATH . '/core/' . $path . '.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        
        // Chercher dans app/models
        $file = APP_PATH . '/models/' . $path . '.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        
        // Chercher dans app/controllers
        $file = APP_PATH . '/controllers/' . $path . '.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        
        // Chercher dans app/traits
        $file = APP_PATH . '/traits/' . $path . '.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        
        return false;
    }
}
?>