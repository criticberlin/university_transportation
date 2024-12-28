<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>

<body>
    <h1>Welcome, Student</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['FullName']); ?>!</p>

    <h2>What would you like to do?</h2>
    <ul>
        <li><a href="view_trips.php">View Available Trips</a></li>
        <li><a href="my_reservation.php">My Reservations</a></li>
        <li><a href="contact_driver.php">Contact driver</a></li>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>

</html>