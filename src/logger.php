<?php
/**
 * Logging functions
 */

function logRequest() {
    $logFile = __DIR__ . '/../logs/access.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    // If multiple IPs in forwarded header, pick the first
    if (strpos($ip, ',') !== false) {
        $ip = trim(explode(',', $ip)[0]);
    }
    $method = $_SERVER['REQUEST_METHOD'] ?? 'unknown';
    $uri = $_SERVER['REQUEST_URI'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    $entry = sprintf(
        "[%s] %s %s %s | UA: %s\n",
        $timestamp,
        $ip,
        $method,
        $uri,
        substr($userAgent, 0, 100)
    );
    
    @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
}

function logContact($email, $message, $ip) {
    $logFile = __DIR__ . '/../logs/contact.log';
    $timestamp = date('Y-m-d H:i:s');
    
    $entry = sprintf(
        "[%s] IP: %s | Email: %s | Message: %s\n",
        $timestamp,
        $ip,
        $email,
        substr(str_replace(["\r", "\n"], ' ', $message), 0, 150)
    );
    
    @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
}

function checkRateLimit($ip) {
    $logFile = __DIR__ . '/../logs/contact.log';
    
    if (!file_exists($logFile)) {
        return true;
    }
    
    $logs = @file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$logs) {
        return true;
    }
    
    $recentSubmissions = 0;
    $windowSeconds = RATE_LIMIT_WINDOW * 3600;
    $cutoffTime = time() - $windowSeconds;
    
    foreach ($logs as $line) {
        if (strpos($line, "IP: $ip") !== false) {
            // Extract timestamp from log line [YYYY-MM-DD HH:MM:SS]
            if (preg_match('/\[(.+?)\]/', $line, $matches)) {
                $logTime = strtotime($matches[1]);
                if ($logTime && $logTime > $cutoffTime) {
                    $recentSubmissions++;
                }
            }
        }
    }
    
    return $recentSubmissions < RATE_LIMIT_MAX;
}

function logError($message, $context = []) {
    $logFile = __DIR__ . '/../logs/error.log';
    $timestamp = date('Y-m-d H:i:s');
    
    $contextStr = empty($context) ? '' : ' | Context: ' . json_encode($context);
    $entry = sprintf("[%s] %s%s\n", $timestamp, $message, $contextStr);
    
    @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
}
