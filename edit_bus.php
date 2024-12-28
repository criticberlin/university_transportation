<?php

session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}


include 'db.php';


if (!isset($_GET['busid']) || empty($_GET['busid'])) {
    header("Location: manage_buses.php");
    exit();
}

$busID = (int)$_GET['busid'];


$stmt = $pdo->prepare("SELECT * FROM Buses WHERE BusID = :busID");
$stmt->execute([':busID' => $busID]);
$bus = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$bus) {
    echo "Bus not found.";
    exit();
}


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

            $updateStmt = $pdo->prepare("
                UPDATE Buses 
                SET PlateNumber = :plateNumber, Capacity = :capacity, BusStatus = :busStatus, DriverID = :driverID 
                WHERE BusID = :busID
            ");
            $updateStmt->execute([
                ':plateNumber' => $plateNumber,
                ':capacity' => $capacity,
                ':busStatus' => $busStatus,
                ':driverID' => $driver['UserID'], 
                ':busID' => $busID,
            ]);

            $successMessage = "Bus updated successfully!";
            header("Location: manage_buses.php?success=" . urlencode($successMessage));
            exit();
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
    <title>Edit Bus</title>
    <style>

</style>
</head>

<body>
    <div class="container">
        <h1>Edit Bus</h1>


        <?php if (isset($errorMessage)): ?>
            <p class="error"><?= htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="PlateNumber">Plate Number:</label>
            <input type="text" id="PlateNumber" name="PlateNumber" value="<?= htmlspecialchars($bus['PlateNumber']); ?>" required>

            <label for="Capacity">Capacity:</label>
            <input type="number" id="Capacity" name="Capacity" value="<?= htmlspecialchars($bus['Capacity']); ?>" min="1" required>

            <label for="BusStatus">Bus Status:</label>
            <select id="BusStatus" name="BusStatus" required>
                <option value="Available" <?= $bus['BusStatus'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                <option value="Unavailable" <?= $bus['BusStatus'] == 'Unavailable' ? 'selected' : ''; ?>>Unavailable</option>
            </select>

            <label for="DriverEmail">Driver Email:</label>
            <input type="email" id="DriverEmail" name="DriverEmail" value="<?= htmlspecialchars($bus['DriverEmail']); ?>" required>

            <button type="submit">Update Bus</button>
        </form>

        <p><a href="manage_buses.php">Back to Manage Buses</a></p>
    </div>
</body>

</html>