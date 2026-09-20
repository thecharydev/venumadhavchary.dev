<?php
/**
 * Email functions using Resend API
 */

require_once __DIR__ . '/config.php';

function sendContactEmail($fromEmail, $message) {
    $apiKey = RESEND_API_KEY;
    
    if (empty($apiKey) || $apiKey === 'your_resend_api_key_here') {
        logError('Resend API key not configured');
        return ['success' => false, 'error' => 'Email service not configured'];
    }
    
    // Check if vendor autoload exists (Composer installed)
    $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    if (file_exists($autoloadPath)) {
        require_once $autoloadPath;
        return sendViaResendSDK($fromEmail, $message, $apiKey);
    } else {
        // Fallback: Use direct API call with cURL
        return sendViaResendAPI($fromEmail, $message, $apiKey);
    }
}

function sendViaResendSDK($fromEmail, $message, $apiKey) {
    try {
        $resend = Resend::client($apiKey);
        
        $result = $resend->emails->send([
            'from' => 'Portfolio Contact <noreply@venumadhavchary.dev>',
            'to' => [CONTACT_EMAIL],
            'reply_to' => $fromEmail,
            'subject' => 'New Portfolio Contact Form Submission',
            'html' => sprintf(
                '<h2>New Contact Form Submission</h2>
                <p><strong>From:</strong> %s</p>
                <p><strong>Message:</strong></p>
                <p>%s</p>
                <hr>
                <p><em>Sent from venumadhavchary.dev portfolio</em></p>',
                htmlspecialchars($fromEmail),
                nl2br(htmlspecialchars($message))
            )
        ]);
        
        return ['success' => true, 'id' => $result->id];
    } catch (Exception $e) {
        logError('Resend SDK error: ' . $e->getMessage());
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

function sendViaResendAPI($fromEmail, $message, $apiKey) {
    $url = 'https://api.resend.com/emails';
    
    $data = [
        'from' => 'Portfolio Contact <noreply@venumadhavchary.dev>',
        'to' => [CONTACT_EMAIL],
        'reply_to' => $fromEmail,
        'subject' => 'New Portfolio Contact Form Submission',
        'html' => sprintf(
            '<h2>New Contact Form Submission</h2>
            <p><strong>From:</strong> %s</p>
            <p><strong>Message:</strong></p>
            <p>%s</p>
            <hr>
            <p><em>Sent from venumadhavchary.dev portfolio</em></p>',
            htmlspecialchars($fromEmail),
            nl2br(htmlspecialchars($message))
        )
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        logError('cURL error: ' . $error);
        return ['success' => false, 'error' => $error];
    }
    
    if ($httpCode >= 200 && $httpCode < 300) {
        $result = json_decode($response, true);
        return ['success' => true, 'id' => $result['id'] ?? null];
    } else {
        logError('Resend API error', ['http_code' => $httpCode, 'response' => $response]);
        return ['success' => false, 'error' => "API returned status $httpCode"];
    }
}
