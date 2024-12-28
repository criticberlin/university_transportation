<?php
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

include 'db.php';

$sql = "SELECT t.TripID, r.StartPoint, r.EndPoint, b.PlateNumber, t.EventName, t.EventDate, t.Description
        FROM Trips t
        JOIN Routes r ON t.RouteID = r.RouteID
        JOIN Buses b ON t.BusID = b.BusID";
$result = $pdo->query($sql); 

if (!$result) {
    die("Error executing query: " . $pdo->errorInfo()[2]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trips</title>
</head>

<body>
    <h1>Manage Trips</h1>
    <a href="add_trip.php">Add New Trip</a><br><br>

    <?php if ($result->rowCount() > 0): ?>
        <table border="1">
            <tr>
                <th>Trip ID</th>
                <th>Route</th>
                <th>Bus</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($trip = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $trip['TripID'] ?></td>
                    <td><?= $trip['StartPoint'] ?> - <?= $trip['EndPoint'] ?></td>
                    <td><?= $trip['PlateNumber'] ?></td>
                    <td><?= $trip['EventName'] ?></td>
                    <td><?= $trip['EventDate'] ?></td>
                    <td><?= $trip['Description'] ?></td>
                    <td>
                        <a href="edit_trip.php?tripid=<?= $trip['TripID'] ?>">Edit</a> |
                        <a href="delete_trip.php?tripid=<?= $trip['TripID'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No trips found.</p>
    <?php endif; ?>
</body>

</html>