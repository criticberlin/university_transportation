<?php
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php'; 


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Route ID.";
    exit();
}

$routeID = $_GET['id'];

try {
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");

    
    $sqlReservations = "DELETE FROM Reservations WHERE TimingID IN (SELECT TimingID FROM Timings WHERE RouteID = :routeID)";
    $stmtReservations = $pdo->prepare($sqlReservations);
    $stmtReservations->execute([':routeID' => $routeID]);


    $sqlTimings = "DELETE FROM Timings WHERE RouteID = :routeID";
    $stmtTimings = $pdo->prepare($sqlTimings);
    $stmtTimings->execute([':routeID' => $routeID]);


    $sqlRoute = "DELETE FROM Routes WHERE RouteID = :routeID";
    $stmtRoute = $pdo->prepare($sqlRoute);
    $stmtRoute->execute([':routeID' => $routeID]);


    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");


    header("Location: manage_routes.php?status=deleted");
    exit();
} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
    exit();
}
