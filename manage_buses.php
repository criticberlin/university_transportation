<?php

include 'db.php';


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
    <title>Manage Buses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, Admin: <?php echo htmlspecialchars($_SESSION['FullName']); ?></h1>

        <h2>Manage Buses</h2>

        <?php

$stmt = $pdo->prepare("SELECT * FROM Buses");
        $stmt->execute();
        $buses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($buses) {
            echo "<table>
                    <tr>
                        <th>Bus ID</th>
                        <th>Plate Number</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>";

            foreach ($buses as $bus) {
                echo "<tr>
                        <td>" . htmlspecialchars($bus['BusID']) . "</td>
                        <td>" . htmlspecialchars($bus['PlateNumber']) . "</td>
                        <td>" . htmlspecialchars($bus['Capacity']) . "</td>
                        <td>" . htmlspecialchars($bus['BusStatus']) . "</td>
                        <td>
                            <a href='edit_bus.php?busid=" . urlencode($bus['BusID']) . "'>Edit</a> |
                            <a href='delete_bus.php?busid=" . urlencode($bus['BusID']) . "' onclick=\"return confirm('Are you sure you want to delete this bus?')\">Delete</a>
                        </td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No buses found.</p>";
        }
        ?>

        <br>
        <a href="add_bus.php">Add New Bus</a>

        <br><br>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>