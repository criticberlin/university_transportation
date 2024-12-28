<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
    header("Location: login.html");
    exit();
}

include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Trip ID.";
    exit();
}

$tripID = $_GET['id'];
$userID = $_SESSION['UserID'];

$stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM EventReservations WHERE UserID = ? AND TripID = ? AND Status = 'Confirmed'");
$stmtCheck->execute([$userID, $tripID]);
$isAlreadyReserved = $stmtCheck->fetchColumn();

if ($isAlreadyReserved) {
    echo "You have already reserved this trip.";
    exit();
}

$stmtInsert = $pdo->prepare("
    INSERT INTO EventReservations (UserID, TripID, ReservationDate, Status)
    VALUES (?, ?, NOW(), 'Confirmed')
");

if ($stmtInsert->execute([$userID, $tripID])) {
    echo "Reservation successful!";
    header("Location: my_reservations.php");
    exit();
} else {
    echo "Error processing your reservation.";
}
