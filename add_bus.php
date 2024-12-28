<?php

session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}


include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plateNumber = trim($_POST['PlateNumber']);
    $capacity = (int)$_POST['Capacity'];
    $busStatus = $_POST['BusStatus'];
    $driverEmail = $_POST['DriverEmail'];

    if (!empty($plateNumber) && $capacity > 0) {

        $stmt = $pdo->prepare("SELECT UserID FROM Users WHERE Email = :email AND UserType = 'Driver'");
        $stmt->execute([':email' => $driverEmail]);
        $driver = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($driver) {

            $stmt = $pdo->prepare("INSERT INTO Buses (PlateNumber, Capacity, BusStatus, DriverID) VALUES (:plateNumber, :capacity, :busStatus, :driverID)");
            $stmt->execute([
                ':plateNumber' => $plateNumber,
                ':capacity' => $capacity,
                ':busStatus' => $busStatus,
                ':driverID' => $driver['UserID'], 
            ]);

           
            $successMessage = "Bus added successfully!";
        } else {
            
            $errorMessage = "No driver found with the provided email.";
        }
    } else {
        $errorMessage = "Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bus</title>
    <style>
      
    </style>
</head>

<body>
    <div class="container">
        <h1>Add New Bus</h1>

        
        <?php if (isset($successMessage)): ?>
            <p class="success"><?= htmlspecialchars($successMessage); ?></p>
        <?php elseif (isset($errorMessage)): ?>
            <p class="error"><?= htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

      
        <form method="POST" action="add_bus.php">
            <label for="PlateNumber">Plate Number:</label>
            <input type="text" id="PlateNumber" name="PlateNumber" placeholder="Enter Plate Number" required>

            <label for="Capacity">Capacity:</label>
            <input type="number" id="Capacity" name="Capacity" placeholder="Enter Capacity" min="1" required>

            <label for="BusStatus">Bus Status:</label>
            <select id="BusStatus" name="BusStatus" required>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>

            <label for="DriverEmail">Driver Email:</label>
            <input type="email" id="DriverEmail" name="DriverEmail" placeholder="Enter Driver's Email" required>

            <button type="submit">Add Bus</button>
        </form>

        <p><a href="manage_buses.php">Back to Manage Buses</a></p>
    </div>
</body>

</html>