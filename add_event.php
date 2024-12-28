<?php
include 'db.php';
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventTypeName = $_POST['EventTypeName'];

    $sql = "INSERT INTO EventTypes (EventTypeName) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $eventTypeName);

    if ($stmt->execute()) {
        echo "Event Type added successfully!";
        header("Location: manage_events.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event Type</title>
</head>

<body>
    <h1>Add New Event Type</h1>
    <form method="POST">
        <label>Event Type Name:</label>
        <input type="text" name="EventTypeName" required><br>

        <button type="submit">Add Event Type</button>
    </form>
    <a href="manage_events.php">Back to Events</a>
</body>

</html>