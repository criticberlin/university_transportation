<?php

session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}





if (!isset($_GET['busid']) || empty($_GET['busid'])) {
    header("Location: manage_buses.php");
    exit();
}

$busID = (int)$_GET['busid'];

$stmt = $pdo->prepare("DELETE FROM Buses WHERE BusID = :busID");
$result = $stmt->execute([':busID' => $busID]);


if ($result) {
    $successMessage = "Bus deleted successfully.";
    header("Location: manage_buses.php?success=" . urlencode($successMessage));
    exit();
} else {
    $errorMessage = "Failed to delete the bus.";
    header("Location: manage_buses.php?error=" . urlencode($errorMessage));
    exit();
}
