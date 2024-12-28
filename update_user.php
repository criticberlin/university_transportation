<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$userId = $data['userId'];
$fullName = $data['fullName'];
$email = $data['email'];
$phone = $data['phone'];

if (empty($userId) || empty($fullName) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    exit();
}

try {
    $sql = "UPDATE Users SET FullName = :fullName, Email = :email, PhoneNumber = :phone WHERE UserID = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fullName' => $fullName,
        ':email' => $email,
        ':phone' => $phone,
        ':userId' => $userId
    ]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

?>