<?php
include 'db.php';
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}



$message = "";

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'added') {
        $message = "Route added successfully!";
    } elseif ($_GET['status'] === 'deleted') {
        $message = "Route deleted successfully!";
    } elseif ($_GET['status'] === 'edited') {
        $message = "Route updated successfully!";
    }
}

$routes = [];
try {
    $sql = "SELECT * FROM Routes";
    $stmt = $pdo->query($sql);
    $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Routes</title>
</head>

<body>
    <h1>Manage Routes</h1>

    <?php if (!empty($message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <a href="add_route.php">Add New Route</a><br><br>

    <?php if (!empty($routes)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Route ID</th>
                    <th>Start Point</th>
                    <th>End Point</th>
                    <th>Distance (KM)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($routes as $route): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($route['RouteID']); ?></td>
                        <td><?php echo htmlspecialchars($route['StartPoint']); ?></td>
                        <td><?php echo htmlspecialchars($route['EndPoint']); ?></td>
                        <td><?php echo htmlspecialchars($route['DistanceKM']); ?></td>
                        <td>
                            <a href="edit_route.php?id=<?php echo htmlspecialchars($route['RouteID']); ?>">Edit</a> |
                            <a href="delete_route.php?id=<?php echo htmlspecialchars($route['RouteID']); ?>"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="admin.php">Back to Dashboard</a></p>
    <?php else: ?>
        <p>No routes found.</p>
    <?php endif; ?>
</body>

</html>