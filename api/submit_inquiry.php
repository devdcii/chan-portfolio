<?php
// api/submit_inquiry.php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Sanitize inputs
$full_name = trim(strip_tags($_POST['full_name'] ?? ''));
$email     = trim(strip_tags($_POST['email'] ?? ''));
$phone     = trim(strip_tags($_POST['phone'] ?? ''));
$subject   = trim(strip_tags($_POST['subject'] ?? ''));
$message   = trim(strip_tags($_POST['message'] ?? ''));
$ip        = $_SERVER['REMOTE_ADDR'] ?? '';

// Validation
if (!$full_name || !$email || !$subject || !$message) {
    jsonResponse(['success' => false, 'message' => 'Please fill in all required fields.'], 400);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['success' => false, 'message' => 'Please enter a valid email address.'], 400);
}
if (strlen($message) < 10) {
    jsonResponse(['success' => false, 'message' => 'Message is too short.'], 400);
}

// Rate limit: max 3 submissions per IP per hour
try {
    $db = getDB();
    $stmt = $db->prepare("SELECT COUNT(*) FROM inquiries WHERE ip_address = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $stmt->execute([$ip]);
    if ($stmt->fetchColumn() >= 3) {
        jsonResponse(['success' => false, 'message' => 'Too many submissions. Please try again later.'], 429);
    }

    $stmt = $db->prepare("INSERT INTO inquiries (full_name, email, phone, subject, message, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $phone, $subject, $message, $ip]);

    jsonResponse(['success' => true, 'message' => 'Inquiry submitted successfully.']);
} catch (Exception $e) {
    jsonResponse(['success' => false, 'message' => 'Server error. Please try again.'], 500);
}
?>