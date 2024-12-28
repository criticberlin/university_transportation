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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <!-- Header Section -->
        <header class="mb-5 text-center">
            <h1 class="display-4 text-primary">Manage Routes</h1>
            <p class="lead">Easily manage all transportation routes for the university system</p>
        </header>

        <!-- Display Messages -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-success text-center">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Add Route Button -->
        <div class="d-flex justify-content-end mb-4">
            <a href="add_route.php" class="btn btn-success btn-lg shadow">
                <i class="icon-plus"></i> Add New Route
            </a>
        </div>

        <!-- Routes Table -->
        <?php if (!empty($routes)): ?>
            <div class="table-responsive bg-white p-3 rounded shadow">
                <table class="table table-hover">
                    <thead class="thead-primary">
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
                                    <a href="edit_route.php?id=<?php echo htmlspecialchars($route['RouteID']); ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-edit"></i> Edit
                                    </a>
                                    <a href="delete_route.php?id=<?php echo htmlspecialchars($route['RouteID']); ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this route?');">
                                        <i class="icon-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                No routes found.
            </div>
        <?php endif; ?>

        <!-- Back to Dashboard -->
        <div class="text-center mt-5">
            <a href="admin.php" class="btn btn-secondary btn-lg shadow">
                <i class="icon-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="main.js"></script>
</body>

</html>