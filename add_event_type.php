<?php
session_start();
include 'db.php';

// Check for admin privileges
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

// Initialize message variable
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventTypeName = trim($_POST['EventTypeName']); // Trim whitespace
    
    if (!empty($eventTypeName)) {
        try {
            // Check if event type already exists
            $checkSql = "SELECT COUNT(*) FROM EventTypes WHERE EventTypeName = ?";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([$eventTypeName]);
            
            if ($checkStmt->fetchColumn() > 0) {
                $message = '<div class="alert alert-danger">This event type already exists!</div>';
            } else {
                // Insert new event type
                $sql = "INSERT INTO EventTypes (EventTypeName) VALUES (?)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute([$eventTypeName])) {
                    $message = '<div class="alert alert-success">Event Type added successfully!</div>';
                    // Optional: Redirect after successful addition
                    // header("Location: manage_trips.php");
                    // exit();
                } else {
                    $message = '<div class="alert alert-danger">Error adding Event Type.</div>';
                }
            }
        } catch (PDOException $e) {
            $message = '<div class="alert alert-danger">Database error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Please enter an Event Type name.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUTSwift - Add Event Type</title>
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
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="pricing.html" class="nav-link">Prices</a></li>
                    <li class="nav-item"><a href="car.html" class="nav-link">Our Goal</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Reviews</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact Us</a></li>
                    <li class="nav-item"><a href="manage_trips.php" class="nav-link">Back to Trips</a></li>
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
                        <h1 class="mb-4">Add Event Type</h1>
                        <p style="font-size: 18px;">Create a new event type category</p>
                    </div>
                </div>
                <div class="col-lg-2 col"></div>
                <div class="col-lg-4 col-md-6 mt-0 mt-md-5">
                    <?php if (!empty($message)) echo $message; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="request-form ftco-animate">
                        <h2>Add Event Type</h2>
                        <div class="form-group">
                            <input type="text" name="EventTypeName" class="form-control" placeholder="Event Type Name" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Event Type" class="btn btn-primary py-3 px-4">
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