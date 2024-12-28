<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

include 'db.php'; 

$userID = $_GET['id'];

$sql = "DELETE FROM Users WHERE UserID = :userID";
$stmt = $pdo->prepare($sql);
$stmt->execute([':userID' => $userID]);

header("Location: manage_users.php");
exit();
