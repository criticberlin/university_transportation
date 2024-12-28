<?php
include 'db.php';
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $routeID = $_POST['RouteID'];
    $busID = $_POST['BusID'];
    $eventName = $_POST['EventName'];
    $eventDate = $_POST['EventDate'];
    $description = $_POST['Description'];
    $eventTypes = $_POST['EventTypes'];


    $checkBusSQL = "SELECT COUNT(*) FROM Trips WHERE BusID = ?";
    $stmtCheckBus = $pdo->prepare($checkBusSQL);
    $stmtCheckBus->bindParam(1, $busID, PDO::PARAM_INT);
    $stmtCheckBus->execute();
    $busCount = $stmtCheckBus->fetchColumn();

    if ($busCount > 0) {
        echo "The bus is already assigned to another trip. Please choose another bus.";
    } else {

        $sql = "INSERT INTO Trips (RouteID, BusID, EventName, EventDate, Description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $routeID, PDO::PARAM_INT);
        $stmt->bindParam(2, $busID, PDO::PARAM_INT);
        $stmt->bindParam(3, $eventName, PDO::PARAM_STR);
        $stmt->bindParam(4, $eventDate, PDO::PARAM_STR);
        $stmt->bindParam(5, $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $tripID = $pdo->lastInsertId(); 


            $sqlEventType = "INSERT INTO TripEventTypes (TripID, EventTypeID) VALUES (?, ?)";
            $stmtEventType = $pdo->prepare($sqlEventType);

            foreach ($eventTypes as $eventTypeID) {
                $stmtEventType->bindParam(1, $tripID, PDO::PARAM_INT);
                $stmtEventType->bindParam(2, $eventTypeID, PDO::PARAM_INT);
                $stmtEventType->execute();
            }

            echo "Trip and associated event types added successfully!";
            header("Location: manage_trips.php");
            exit();
        } else {
            echo "Error inserting trip: " . $stmt->errorInfo()[2];
        }
    }
}


$routes = $pdo->query("SELECT RouteID, StartPoint, EndPoint FROM Routes");
$buses = $pdo->query("SELECT BusID, PlateNumber FROM Buses");
$eventTypes = $pdo->query("SELECT EventTypeID, EventTypeName FROM EventTypes");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Trip</title>
</head>

<body>
    <h1>Add New Trip</h1>
    <form method="POST">
        <label>Route:</label>
        <select name="RouteID" required>
            <option value="">Select Route</option>
            <?php while ($route = $routes->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $route['RouteID'] ?>"><?= $route['StartPoint'] ?> - <?= $route['EndPoint'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <label>Bus:</label>
        <select name="BusID" required>
            <option value="">Select Bus</option>
            <?php while ($bus = $buses->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $bus['BusID'] ?>"><?= $bus['PlateNumber'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <label>Event Name:</label>
        <input type="text" name="EventName" required><br>

        <label>Event Date:</label>
        <input type="datetime-local" name="EventDate" required><br>

        <label>Description:</label>
        <textarea name="Description"></textarea><br>

        <label>Event Types:</label><br>
        <select name="EventTypes[]" multiple required>
            <?php while ($eventType = $eventTypes->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $eventType['EventTypeID'] ?>"><?= $eventType['EventTypeName'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit">Add Trip</button>
    </form>
    <a href="manage_trips.php">Back to Trips</a>
</body>

</html>