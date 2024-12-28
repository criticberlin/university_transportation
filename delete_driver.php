<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php'; 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Driver ID.";
    exit();
}

$driverID = $_GET['id'];


$sql = "DELETE FROM Users WHERE UserID = :driverID AND UserType = 'Driver'";
$stmt = $pdo->prepare($sql);
$stmt->execute([':driverID' => $driverID]);

header("Location: manage_drivers.php");
exit();
