<?php

session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}


include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plateNumber = trim($_POST['PlateNumber']);
    $capacity = (int)$_POST['Capacity'];
    $busStatus = $_POST['BusStatus'];
    $driverEmail = $_POST['DriverEmail'];

    if (!empty($plateNumber) && $capacity > 0) {

        $stmt = $pdo->prepare("SELECT UserID FROM Users WHERE Email = :email AND UserType = 'Driver'");
        $stmt->execute([':email' => $driverEmail]);
        $driver = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($driver) {

            $stmt = $pdo->prepare("INSERT INTO Buses (PlateNumber, Capacity, BusStatus, DriverID) VALUES (:plateNumber, :capacity, :busStatus, :driverID)");
            $stmt->execute([
                ':plateNumber' => $plateNumber,
                ':capacity' => $capacity,
                ':busStatus' => $busStatus,
                ':driverID' => $driver['UserID'], 
            ]);

           
            $successMessage = "Bus added successfully!";
        } else {
            
            $errorMessage = "No driver found with the provided email.";
        }
    } else {
        $errorMessage = "Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUTSwift - Add Bus</title>
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
                    <li class="nav-item"><a href="manage_buses.php" class="nav-link">Back to Buses</a></li>
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
                        <h1 class="mb-4">Add New Bus</h1>
                        <p style="font-size: 18px;">Create a new Bus</p>
                    </div>
                </div>
                <div class="col-lg-2 col"></div>
                <div class="col-lg-4 col-md-6 mt-0 mt-md-5">
                    <form action="add_user.php" method="post" class="request-form ftco-animate">
                        <h2>Add Bus</h2>
                        <div class="form-group">
                            <input type="text" name="PlateNumber" class="form-control" placeholder="PlateNumber" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="Capacity" class="form-control" placeholder="Capacity" required>
                        </div>
                        <div class="form-group">
                            <select name="BusStatus" class="form-control" required>
                                <option value="">Select User Type</option>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email" name="DriverEmail" class="form-control" placeholder="DriverEmail" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Bus" class="btn btn-primary py-3 px-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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