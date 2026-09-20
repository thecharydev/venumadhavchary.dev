<?php
/**
 * Contact form API endpoint
 * Handles form submissions, validates input, logs, and sends email
 */

require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/mailer.php';
require_once __DIR__ . '/../../src/logger.php';

// Set JSON response header
header('Content-Type: application/json');

// CORS headers (for local development)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

// Validate input exists
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Extract and validate email
$email = isset($input['email']) ? trim($input['email']) : '';
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

if (!$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Extract and validate message
$message = isset($input['message']) ? trim($input['message']) : '';

if (empty($message) || strlen($message) < 10) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Message must be at least 10 characters']);
    exit;
}

// Check message length
if (strlen($message) > 5000) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Message too long (max 5000 characters)']);
    exit;
}

// Get client IP
$clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Rate limiting check
if (!checkRateLimit($clientIp)) {
    http_response_code(429);
    echo json_encode([
        'success' => false, 
        'message' => 'Too many requests. Please try again in an hour.'
    ]);
    exit;
}

// Log the contact submission
logContact($email, $message, $clientIp);

// Send email via Resend
$result = sendContactEmail($email, $message);

if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'success' => true, 
        'message' => 'Message sent successfully! I\'ll get back to you within 24 hours.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to send message. Please email me directly at ' . CONTACT_EMAIL
    ]);
}
