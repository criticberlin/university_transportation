<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
    header("Location: login.html");
    exit();
}

include 'db.php'; 

$stmt = $pdo->query("SELECT t.TripID, t.EventName, t.EventDate, r.StartPoint, r.EndPoint, b.PlateNumber
                     FROM Trips t
                     JOIN Routes r ON t.RouteID = r.RouteID
                     JOIN Buses b ON t.BusID = b.BusID");
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Trips</title>
</head>

<body>
    <h1>Available Trips</h1>
    <table border="1">
        <thead>
            <tr>
                <th>TripID</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Start Point</th>
                <th>End Point</th>
                <th>Bus Plate Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trips as $trip): ?>
                <tr>
                    <td><?php echo htmlspecialchars($trip['TripID']); ?></td>
                    <td><?php echo htmlspecialchars($trip['EventName']); ?></td>
                    <td><?php echo htmlspecialchars($trip['EventDate']); ?></td>
                    <td><?php echo htmlspecialchars($trip['StartPoint']); ?></td>
                    <td><?php echo htmlspecialchars($trip['EndPoint']); ?></td>
                    <td><?php echo htmlspecialchars($trip['PlateNumber']); ?></td>
                    <td>
                        <a href="reservation.php?id=<?php echo $trip['TripID']; ?>">Reserve</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="students.php">Back to Dashboard</a></p>
</body>

</html>