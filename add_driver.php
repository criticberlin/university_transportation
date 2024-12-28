<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    // استعلام لإضافة السائق
    $sql = "INSERT INTO Users (FullName, Email, PhoneNumber, UserType, PasswordHash) 
            VALUES (:fullName, :email, :phoneNumber, 'Driver', :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fullName' => $fullName,
        ':email' => $email,
        ':phoneNumber' => $phoneNumber,
        ':password' => $password,
    ]);

    // إعادة التوجيه إلى صفحة إدارة السائقين
    header("Location: manage_drivers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Driver</title>
</head>

<body>
    <h1>Add New Driver</h1>
    <form method="POST" action="add_driver.php">
        <label for="FullName">Full Name:</label>
        <input type="text" id="FullName" name="FullName" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" required><br><br>

        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" id="PhoneNumber" name="PhoneNumber"><br><br>

        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password" required><br><br>

        <button type="submit">Add Driver</button>
    </form>

    <p><a href="manage_drivers.php">Back to Manage Drivers</a></p>
</body>

</html>