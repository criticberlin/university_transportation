<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Driver') {
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
</head>

<body>
    <h1>Welcome, Driver</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['FullName']); ?>!</p>

    <h2>What would you like to do?</h2>
    <ul>
        <li><a href="assigned_trips.php">View Assigned Trips</a></li>
        <li><a href="contact_student.php">Contact Students</a></li>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>

</html>