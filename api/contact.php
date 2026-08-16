<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    exit;
}

$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);

if (!$data) {
    $data = $_POST;
}

$name    = isset($data['name']) ? trim($data['name']) : '';
$phone   = isset($data['phone']) ? trim($data['phone']) : '';
$email   = isset($data['email']) ? trim($data['email']) : '';
$subject = isset($data['subject']) ? trim($data['subject']) : 'General Inquiry';
$message = isset($data['message']) ? trim($data['message']) : '';

if (empty($name) || empty($phone) || empty($message)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please provide your Name, Phone Number, and Message.'
    ]);
    exit;
}

$pdo = getPDOConnection();
if ($pdo !== null) {
    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (name, phone, email, subject, message) VALUES (:name, :phone, :email, :subject, :msg)");
        $stmt->execute([
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email,
            ':subject' => $subject,
            ':msg' => $message
        ]);
    } catch (Exception $e) {
        error_log("Inquiry insertion error: " . $e->getMessage());
    }
}

echo json_encode([
    'status' => 'success',
    'message' => 'Thank you for contacting Hotel Nataraj! Our team will call you shortly on ' . htmlspecialchars($phone) . '.'
]);
