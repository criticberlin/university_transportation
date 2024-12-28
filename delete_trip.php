<?php
include 'db.php';
session_start();


if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['tripID']) || empty($_GET['tripID'])) {
    echo "Invalid trip ID.";
    exit();
}

$tripID = $_GET['tripID'];

if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "Invalid CSRF token.";
    exit();
}

try {

    $pdo->beginTransaction();


    $sqlDelete = "DELETE FROM Trips WHERE TripID = ?";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(1, $tripID, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {

        $sqlDeleteEventTypes = "DELETE FROM TripEventTypes WHERE TripID = ?";
        $stmtDeleteEventTypes = $pdo->prepare($sqlDeleteEventTypes);
        $stmtDeleteEventTypes->execute([$tripID]);


        $pdo->commit();


        header("Location: manage_trips.php?status=deleted");
        exit();
    } else {

        $pdo->rollBack();
        echo "Error deleting trip.";
    }
} catch (PDOException $e) {

    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
