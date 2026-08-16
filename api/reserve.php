<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed. Use POST.']);
    exit;
}

$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);

if (!$data) {
    $data = $_POST;
}

$bookingType    = isset($data['booking_type']) ? trim($data['booking_type']) : 'Dining Table';
$guestName      = isset($data['guest_name']) ? trim($data['guest_name']) : '';
$phone          = isset($data['phone']) ? trim($data['phone']) : '';
$email          = isset($data['email']) ? trim($data['email']) : '';
$guestsCount    = isset($data['guests_count']) ? intval($data['guests_count']) : 2;
$reservationDate= isset($data['reservation_date']) ? trim($data['reservation_date']) : '';
$reservationTime= isset($data['reservation_time']) ? trim($data['reservation_time']) : '';
$eventType      = isset($data['event_type']) ? trim($data['event_type']) : 'Dining';
$specialRequest = isset($data['special_request']) ? trim($data['special_request']) : '';

if (empty($guestName) || empty($phone) || empty($reservationDate) || empty($reservationTime)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please fill in all required fields (Name, Phone, Date, Time).'
    ]);
    exit;
}

$bookingId = 'NAT-' . rand(1000, 9999);
$pdo = getPDOConnection();

if ($pdo !== null) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO reservations 
            (booking_type, guest_name, phone, email, guests_count, reservation_date, reservation_time, event_type, special_request, status) 
            VALUES (:type, :name, :phone, :email, :guests, :rdate, :rtime, :event, :request, 'Confirmed')
        ");
        $stmt->execute([
            ':type'    => $bookingType,
            ':name'    => $guestName,
            ':phone'   => $phone,
            ':email'   => $email,
            ':guests'  => $guestsCount,
            ':rdate'   => $reservationDate,
            ':rtime'   => $reservationTime,
            ':event'   => $eventType,
            ':request' => $specialRequest
        ]);
        $dbId = $pdo->lastInsertId();
        $bookingId = 'NAT-' . (1000 + $dbId);
    } catch (Exception $e) {
        error_log("Database insertion failed: " . $e->getMessage());
    }
}

echo json_encode([
    'status' => 'success',
    'message' => 'Your reservation request at Hotel Nataraj has been confirmed successfully!',
    'booking_id' => $bookingId,
    'details' => [
        'booking_type' => $bookingType,
        'guest_name' => $guestName,
        'phone' => $phone,
        'guests' => $guestsCount,
        'date' => $reservationDate,
        'time' => $reservationTime,
        'event_type' => $eventType
    ]
]);
