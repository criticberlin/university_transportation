<?php
session_start();

include 'db.php'; 

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['tripID']) || empty($_GET['tripID'])) {
    echo "Invalid trip ID. Please ensure the trip ID is passed in the URL.";
    exit();
}

$tripID = $_GET['tripID'];

$message = "";

try {
   
    $sqlTrip = "SELECT t.TripID, t.RouteID, t.BusID, t.EventName, t.EventDate, t.Description
                FROM Trips t
                WHERE t.TripID = ?";
    $stmtTrip = $pdo->prepare($sqlTrip);
    $stmtTrip->execute([$tripID]);
    $trip = $stmtTrip->fetch(PDO::FETCH_ASSOC);

    if (!$trip) {
        echo "Trip not found in the database with ID: " . htmlspecialchars($tripID);
        exit();
    }

   
    $routes = $pdo->query("SELECT RouteID, StartPoint, EndPoint FROM Routes")->fetchAll(PDO::FETCH_ASSOC);
    $buses = $pdo->query("SELECT BusID, PlateNumber FROM Buses")->fetchAll(PDO::FETCH_ASSOC);
    $eventTypes = $pdo->query("SELECT EventTypeID, EventTypeName FROM EventTypes")->fetchAll(PDO::FETCH_ASSOC);


    $sqlEventTypes = "SELECT EventTypeID FROM TripEventTypes WHERE TripID = ?";
    $stmtEventTypes = $pdo->prepare($sqlEventTypes);
    $stmtEventTypes->execute([$tripID]);
    $selectedEventTypes = $stmtEventTypes->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $routeID = $_POST['RouteID'];
    $busID = $_POST['BusID'];
    $eventName = $_POST['EventName'];
    $eventDate = $_POST['EventDate'];
    $description = $_POST['Description'];
    $eventTypes = $_POST['EventTypes'];

    try {
        $pdo->beginTransaction();

        $sqlUpdateTrip = "UPDATE Trips 
                          SET RouteID = ?, BusID = ?, EventName = ?, EventDate = ?, Description = ? 
                          WHERE TripID = ?";
        $stmtUpdateTrip = $pdo->prepare($sqlUpdateTrip);
        $stmtUpdateTrip->execute([$routeID, $busID, $eventName, $eventDate, $description, $tripID]);


        $sqlDeleteEventTypes = "DELETE FROM TripEventTypes WHERE TripID = ?";
        $stmtDeleteEventTypes = $pdo->prepare($sqlDeleteEventTypes);
        $stmtDeleteEventTypes->execute([$tripID]);


        $sqlInsertEventTypes = "INSERT INTO TripEventTypes (TripID, EventTypeID) VALUES (?, ?)";
        $stmtInsertEventTypes = $pdo->prepare($sqlInsertEventTypes);
        foreach ($eventTypes as $eventTypeID) {
            $stmtInsertEventTypes->execute([$tripID, $eventTypeID]);
        }


        $pdo->commit();
        $message = "Trip updated successfully!";
        header("Location: manage_trips.php?status=edited");
        exit();
    } catch (PDOException $e) {

        $pdo->rollBack();
        $message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trip</title>
</head>

<body>
    <h1>Edit Trip</h1>

    <?php if (!empty($message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Route:</label>
        <select name="RouteID" required>
            <option value="">Select Route</option>
            <?php foreach ($routes as $route): ?>
                <option value="<?= htmlspecialchars($route['RouteID']) ?>" <?= $route['RouteID'] == $trip['RouteID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($route['StartPoint']) ?> - <?= htmlspecialchars($route['EndPoint']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Bus:</label>
        <select name="BusID" required>
            <option value="">Select Bus</option>
            <?php foreach ($buses as $bus): ?>
                <option value="<?= htmlspecialchars($bus['BusID']) ?>" <?= $bus['BusID'] == $trip['BusID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($bus['PlateNumber']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Event Name:</label>
        <input type="text" name="EventName" value="<?= htmlspecialchars($trip['EventName']) ?>" required><br>

        <label>Event Date:</label>
        <input type="datetime-local" name="EventDate" value="<?= date('Y-m-d\TH:i', strtotime($trip['EventDate'])) ?>" required><br>

        <label>Description:</label>
        <textarea name="Description"><?= htmlspecialchars($trip['Description']) ?></textarea><br>

        <label>Event Types:</label><br>
        <select name="EventTypes[]" multiple required>
            <?php foreach ($eventTypes as $eventType): ?>
                <option value="<?= htmlspecialchars($eventType['EventTypeID']) ?>" <?= in_array($eventType['EventTypeID'], $selectedEventTypes) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($eventType['EventTypeName']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Update Trip</button>
    </form>

    <a href="manage_trips.php">Back to Trips</a>
</body>

</html>