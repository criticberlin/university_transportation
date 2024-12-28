<?php
session_start();


if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            color: #4CAF50;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin: 10px 0;
        }

        ul li a {
            text-decoration: none;
            color: #007BFF;
        }

        ul li a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .logout {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h1>Welcome, Admin</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['FullName']); ?>!</p>

    <h2>Manage System</h2>
    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_drivers.php">Manage Drivers</a></li>
        <li><a href="manage_routes.php">Manage Routes</a></li>
        <li><a href="manage_buses.php">Manage Buses</a></li>
        <li><a href="manage_trips.php">Manage Trips</a></li>
        <li><a href="view_reports.php">View Reports</a></li>
        <li><a href="admin_messages.php">View Messages</a></li>

    </ul>

    <p class="logout"><a href="logout.php">Logout</a></p>
</body>

</html>