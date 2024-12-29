<?php
include 'db.php'; // Assuming your PDO connection is set in this file
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startPoint = $_POST['StartPoint'];
    $endPoint = $_POST['EndPoint'];
    $distance = $_POST['DistanceKM'];
    $description = $_POST['RouteDescription'];

    $sql = "INSERT INTO Routes (StartPoint, EndPoint, DistanceKM, RouteDescription) VALUES (:startPoint, :endPoint, :distance, :description)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters using PDO's bindParam method
    $stmt->bindParam(':startPoint', $startPoint, PDO::PARAM_STR);
    $stmt->bindParam(':endPoint', $endPoint, PDO::PARAM_STR);
    $stmt->bindParam(':distance', $distance, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Route added successfully!";
        header("Location: manage_routes.php");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Route</title>
</head>

<body>
    <h1>Add New Route</h1>
    <form method="POST">
        <label>Start Point:</label>
        <input type="text" name="StartPoint" required><br>

        <label>End Point:</label>
        <input type="text" name="EndPoint" required><br>

        <label>Distance (KM):</label>
        <input type="number" step="0.01" name="DistanceKM" required><br>

        <label>Description:</label>
        <textarea name="RouteDescription"></textarea><br>

        <button type="submit">Add Route</button>
    </form>
    <a href="manage_routes.php">Back to Routes</a>
</body>

</html>
<?php
include 'db.php'; // Assuming your PDO connection is set in this file
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startPoint = $_POST['StartPoint'];
    $endPoint = $_POST['EndPoint'];
    $distance = $_POST['DistanceKM'];
    $description = $_POST['RouteDescription'];

    $sql = "INSERT INTO Routes (StartPoint, EndPoint, DistanceKM, RouteDescription) VALUES (:startPoint, :endPoint, :distance, :description)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters using PDO's bindParam method
    $stmt->bindParam(':startPoint', $startPoint, PDO::PARAM_STR);
    $stmt->bindParam(':endPoint', $endPoint, PDO::PARAM_STR);
    $stmt->bindParam(':distance', $distance, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Route added successfully!";
        header("Location: manage_routes.php");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Route</title>
</head>

<body>
    <h1>Add New Route</h1>
    <form method="POST">
        <label>Start Point:</label>
        <input type="text" name="StartPoint" required><br>

        <label>End Point:</label>
        <input type="text" name="EndPoint" required><br>

        <label>Distance (KM):</label>
        <input type="number" step="0.01" name="DistanceKM" required><br>

        <label>Description:</label>
        <textarea name="RouteDescription"></textarea><br>

        <button type="submit">Add Route</button>
    </form>
    <a href="manage_routes.php">Back to Routes</a>
</body>

</html>
