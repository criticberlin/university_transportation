<?php
session_start();
include 'db.php';

// تأكد من أن المستخدم هو "Student"
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
    header("Location: login.html");
    exit();
}

$userID = $_SESSION['UserID'];

// التحقق من وجود متغير 'id' في الرابط والذي يمثل الـ TripID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Trip ID.";
    exit();
}

$tripID = $_GET['id'];

// التحقق من عدم وجود حجز لهذا المستخدم لهذا الـ Trip
$stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM eventreservations WHERE UserID = ? AND TripID = ? AND Status = 'Confirmed'");
$stmtCheck->execute([$userID, $tripID]);
$isAlreadyReserved = $stmtCheck->fetchColumn();

if ($isAlreadyReserved) {
    echo "You have already reserved this trip.";
    exit();
}

// إدخال الحجز الجديد في جدول eventreservations
$stmtInsert = $pdo->prepare("
    INSERT INTO eventreservations (UserID, TripID, ReservationDate, Status)
    VALUES (?, ?, NOW(), 'Confirmed')
");

if ($stmtInsert->execute([$userID, $tripID])) {
    echo "Reservation successful!";
    header("Location: my_reservations.php");  // بعد الحجز الناجح، قم بإعادة التوجيه إلى صفحة الحجز
    exit();
} else {
    echo "Error processing your reservation.";
}
?>
