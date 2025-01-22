<?php
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php';

$sql = "
    SELECT 
        ER.EventReservationID AS ReservationID,
        U.FullName AS UserName, 
        T.EventName AS EventName,
        T.EventDate AS EventDate,
        Rt.StartPoint,
        Rt.EndPoint,
        ER.Status,
        ER.ReservationDate
    FROM eventreservations ER
    INNER JOIN Users U ON ER.UserID = U.UserID
    INNER JOIN Trips T ON ER.TripID = T.TripID
    INNER JOIN Routes Rt ON T.RouteID = Rt.RouteID
";

try {
    $stmt = $pdo->query($sql);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error fetching reservations: " . $e->getMessage() . "</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bakisena - Admin Reports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/Bakisenalogo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php" class="logo">
                <img src="images/Bakisena.png" alt="Bakisena Logo" style="height: 85px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="pricing.php" class="nav-link">Prices</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact Us</a></li>
                    <li class="nav-item"><a href="admin.php" class="nav-link">Back to Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center">
                <div class="col-lg-6 col-md-6 ftco-animate d-flex align-items-end">
                    <div class="text">
                        <h1 class="mb-4">View Reports</h1>
                    </div>
                </div>
                <div class="col-lg-2 col"></div>
                <!-- NEW BUTTONS SECTION -->
                <div class="col-lg-4 col-md-6 mt-0 mt-md-5 d-flex">
                    <div class="request-form ftco-animate">
                        <h2>Admin Dashboard</h2>
                        <div class="dashboard-buttons">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <a href="manage_users.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-shield mr-2"></i>Manage Users</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="manage_drivers.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-cog mr-2"></i>Manage Drivers</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="manage_routes.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-shield mr-2"></i>Manage Routes</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="manage_buses.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-cog mr-2"></i>Manage Buses</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="manage_trips.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-shield mr-2"></i>Manage Trips</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="admin_messages.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-shield mr-2"></i>View Messages</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($stmt->rowCount() > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Reservation ID</th>
                                                <th>User Name</th>
                                                <th>Event Name</th>
                                                <th>Event Date</th>
                                                <th>Route</th>
                                                <th>Status</th>
                                                <th>Reservation Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['ReservationID']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['UserName']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['EventName']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['EventDate']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['StartPoint'] . " → " . $row['EndPoint']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['Status']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['ReservationDate']); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">No reservations found.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p> Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="index.php" target="_blank">Bakisena</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>