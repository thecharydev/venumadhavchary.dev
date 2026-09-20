<?php
/**
 * Configuration loader
 * Loads environment variables from .env file
 */

// Load environment variables from .env file
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            $value = trim($value, '"\'');
            
            // Set environment variable if not already set
            if (getenv($key) === false) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
            } else {
                $_ENV[$key] = getenv($key);
            }
        }
    }
}

// Configuration constants
define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('APP_DEBUG', filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN));
define('SITE_NAME', getenv('SITE_NAME') ?: getenv('site_name') ?: ($_ENV['SITE_NAME'] ?? $_ENV['site_name'] ?? 'venumadhavchary.dev'));
define('SITE_ICON', getenv('SITE_ICON') ?: getenv('site_icon') ?: ($_ENV['SITE_ICON'] ?? $_ENV['site_icon'] ?? strtoupper(substr(SITE_NAME, 0, 1))));
define('RESEND_API_KEY', getenv('RESEND_API_KEY'));
define('CONTACT_EMAIL', getenv('CONTACT_EMAIL') ?: 'thecharydev@gmail.com');
define('RATE_LIMIT_MAX', getenv('RATE_LIMIT_MAX_REQUESTS') ?: 5);
define('RATE_LIMIT_WINDOW', getenv('RATE_LIMIT_WINDOW_HOURS') ?: 1);

// Error reporting
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/../logs/error.log');
}

// Timezone
date_default_timezone_set('Asia/Kolkata'); // IST

/**
 * Cache-busting asset URL helper
 */
if (!function_exists('asset_url')) {
    function asset_url($path) {
        $real = __DIR__ . '/../public/' . ltrim($path, '/');
        $ver = file_exists($real) ? filemtime($real) : '1.0.2';
        return htmlspecialchars($path . '?v=' . $ver);
    }
}

