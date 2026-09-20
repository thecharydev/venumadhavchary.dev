<?php
/**
 * Resume download endpoint
 * Serves the resume PDF with proper headers
 */

$resumePath = __DIR__ . '/../assets/resume/VenuMadhavs_Resume.pdf';

// Check if file exists
if (!file_exists($resumePath)) {
    http_response_code(404);
    echo 'Resume not found';
    exit;
}

// Set headers for PDF download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="VenuMadhavs_Resume.pdf"');
header('Content-Length: ' . filesize($resumePath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Output file
readfile($resumePath);
exit;
