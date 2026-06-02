<?php
/**
 * CONFIGURATION DE L'APPLICATION
 */

// ============================================
// ENVIRONNEMENT
// ============================================
define('APP_ENV', 'development'); // 'development' ou 'production'
define('APP_DEBUG', APP_ENV === 'development');

// ============================================
// BASE DE DONNÉES
// ============================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'modern_living');
define('DB_PORT', 3306);
define('DB_CHARSET', 'utf8mb4');

// ============================================
// CHEMINS
// ============================================
define('UPLOAD_DIR', ROOT_PATH . '/storage/uploads');
define('TEMP_DIR', ROOT_PATH . '/storage/temp');
define('LOG_DIR', ROOT_PATH . '/storage/logs');

// ============================================
// CONFIGURATION GÉNÉRALE
// ============================================
define('APP_NAME', 'Modern Living');
define('APP_URL', 'http://localhost:8080');
define('ITEMS_PER_PAGE', 12);
define('SESSION_TIMEOUT', 3600); // 1 heure

// ============================================
// DEVISE & LOCALISATION
// ============================================
define('CURRENCY', 'XAF'); // Franc CFA
define('CURRENCY_SYMBOL', 'F');
define('LANG', 'fr');

// ============================================
// CLÉS API (à remplir avec les vraies clés)
// ============================================
define('AIRTEL_MONEY_API_KEY', 'your_airtel_key_here');
define('MPESA_API_KEY', 'your_mpesa_key_here');
define('ORANGE_MONEY_API_KEY', 'your_orange_key_here');

// ============================================
// EMAIL
// ============================================
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'your_email@gmail.com');
define('MAIL_PASSWORD', 'your_app_password');
define('MAIL_FROM', 'noreply@modern-living.com');

// Créer les répertoires s'ils n'existent pas
$dirs = array(UPLOAD_DIR, TEMP_DIR, LOG_DIR);
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}
?>
