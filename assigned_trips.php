<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Driver') {
    header("Location: login.php");
    exit();
}

include 'db.php';

try {
    $stmtBus = $pdo->prepare("SELECT BusID FROM Buses WHERE DriverID = :driverID");
    $stmtBus->execute(['driverID' => $_SESSION['UserID']]);
    $bus = $stmtBus->fetch(PDO::FETCH_ASSOC);

    if (!$bus) {
        echo "No bus assigned to you.";
        exit();
    }
} catch (PDOException $e) {
    echo "Database error: " . htmlspecialchars($e->getMessage());
    exit();
}

$stmtTrips = $pdo->prepare("
    SELECT t.TripID, t.EventName, t.EventDate, r.StartPoint, r.EndPoint
    FROM Trips t
    JOIN Routes r ON t.RouteID = r.RouteID
    WHERE t.BusID = :busID
");
$stmtTrips->execute(['busID' => $bus['BusID']]);
$trips = $stmtTrips->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Trips</title>
</head>

<body>
    <h1>Assigned Trips</h1>

    <?php if (count($trips) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>TripID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Start Point</th>
                    <th>End Point</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trips as $trip): ?>
                    <tr>
                        <td><?= htmlspecialchars($trip['TripID']); ?></td>
                        <td><?= htmlspecialchars($trip['EventName']); ?></td>
                        <td><?= htmlspecialchars($trip['EventDate']); ?></td>
                        <td><?= htmlspecialchars($trip['StartPoint']); ?></td>
                        <td><?= htmlspecialchars($trip['EndPoint']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No trips assigned to you.</p>
    <?php endif; ?>

    <p><a href="driver.php">Back to Dashboard</a></p>
</body>

</html>