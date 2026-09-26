<?php
/**
 * Application readiness endpoint
 */

require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/logger.php';

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('X-Content-Type-Options: nosniff');
header('Allow: GET');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$readinessChecks = [
    'email_configuration' => defined('RESEND_API_KEY')
        && !empty(RESEND_API_KEY)
        && RESEND_API_KEY !== 'your_resend_api_key_here'
        && defined('CONTACT_EMAIL')
        && filter_var(CONTACT_EMAIL, FILTER_VALIDATE_EMAIL) !== false,
    'composer_dependencies' => file_exists(__DIR__ . '/../../vendor/autoload.php'),
    'log_directory' => is_dir(__DIR__ . '/../../logs') && is_writable(__DIR__ . '/../../logs'),
];

$isReady = !in_array(false, $readinessChecks, true);

if (!$isReady) {
    logError('Health check failed', [
        'failed_checks' => array_keys(array_filter(
            $readinessChecks,
            static function ($checkPassed) {
                return !$checkPassed;
            }
        )),
    ]);

    http_response_code(503);
    echo json_encode(['status' => 'unhealthy']);
    exit;
}

http_response_code(200);
echo json_encode(['status' => 'ok']);