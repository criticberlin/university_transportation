<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Driver') {
    header("Location: login.php");
    exit();
}

include 'db.php';

try {
    $stmtBus = $pdo->prepare("SELECT BusID FROM Buses WHERE DriverID = :driverID");
    $stmtBus->execute(['driverID' => $_SESSION['UserID']]);
    $bus = $stmtBus->fetch(PDO::FETCH_ASSOC);

    if (!$bus) {
        $nobus_error = "No bus assigned to you.";
    } else {
        $stmtTrips = $pdo->prepare("
            SELECT t.TripID, t.EventName, t.EventDate, r.StartPoint, r.EndPoint
            FROM Trips t
            JOIN Routes r ON t.RouteID = r.RouteID
            WHERE t.BusID = :busID
        ");
        $stmtTrips->execute(['busID' => $bus['BusID']]);
        $trips = $stmtTrips->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $db_error = "Database error: " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUTSwift - Assigned Trips</title>
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
    <link rel="icon" type="image/png" href="images/SUTlogo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">SUT<span>Swift</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="pricing.php" class="nav-link">Prices</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact Us</a></li>
                    <li class="nav-item"><a href="driver.php" class="nav-link">Back to Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center">
                <div class="col-lg-12 ftco-animate">
                    <div class="text w-100 mb-4 mt-5">
                        <h1 class="mb-4">Assigned Trips</h1>
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
                            <?php if (isset($db_error)): ?>
                                <div class="alert alert-danger"><?php echo $db_error; ?></div>
                            <?php elseif (isset($nobus_error)): ?>
                                <div class="alert alert-warning"><?php echo $nobus_error; ?></div>
                            <?php elseif (empty($trips)): ?>
                                <div class="alert alert-info">No trips assigned to you.</div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Trip ID</th>
                                                <th>Event Name</th>
                                                <th>Event Date</th>
                                                <th>Start Point</th>
                                                <th>End Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($trips as $trip): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($trip['TripID']) ?></td>
                                                    <td><?= htmlspecialchars($trip['EventName']) ?></td>
                                                    <td><?= htmlspecialchars($trip['EventDate']) ?></td>
                                                    <td><?= htmlspecialchars($trip['StartPoint']) ?></td>
                                                    <td><?= htmlspecialchars($trip['EndPoint']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
                    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://sut.edu.eg/" target="_blank">SutSwift Team</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
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