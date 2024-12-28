<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php'; 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Driver ID.";
    exit();
}

$driverID = $_GET['id'];


$sql = "SELECT * FROM Users WHERE UserID = :driverID AND UserType = 'Driver'";
$stmt = $pdo->prepare($sql);
$stmt->execute([':driverID' => $driverID]);
$driver = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$driver) {
    echo "Driver not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];

    $sql = "UPDATE Users SET FullName = :fullName, Email = :email, PhoneNumber = :phoneNumber WHERE UserID = :driverID AND UserType = 'Driver'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fullName' => $fullName,
        ':email' => $email,
        ':phoneNumber' => $phoneNumber,
        ':driverID' => $driverID,
    ]);

    header("Location: manage_drivers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Driver</title>
</head>

<body>
    <h1>Edit Driver</h1>
    <form method="POST" action="edit_driver.php?id=<?php echo $driverID; ?>">
        <label for="FullName">Full Name:</label>
        <input type="text" id="FullName" name="FullName" value="<?php echo htmlspecialchars($driver['FullName']); ?>" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" value="<?php echo htmlspecialchars($driver['Email']); ?>" required><br><br>

        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" id="PhoneNumber" name="PhoneNumber" value="<?php echo htmlspecialchars($driver['PhoneNumber']); ?>"><br><br>

        <button type="submit">Update Driver</button>
    </form>

    <p><a href="manage_drivers.php">Back to Manage Drivers</a></p>
</body>

</html>