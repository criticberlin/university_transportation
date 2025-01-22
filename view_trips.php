<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
  header("Location: login.html");
  exit();
}

include 'db.php';

$stmt = $pdo->query("SELECT t.TripID, t.EventName, t.EventDate, r.StartPoint, r.EndPoint, b.PlateNumber
                     FROM Trips t
                     JOIN Routes r ON t.RouteID = r.RouteID
                     JOIN Buses b ON t.BusID = b.BusID");
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include database connection or user data retrieval logic here
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Student';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>SUTSwift - View Trips</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

  <!-- Stylesheets -->
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
          <li class="nav-item"><a href="students.php" class="nav-link">Back to Dashboard</a></li>
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
            <h1 class="mb-4">
              <p>View Your Current Trips</p>
            </h1>
            <p style="font-size: 18px;">you can see all the trips you are registered in</p>
          </div>
        </div>
        <div class="col-lg-2 col"></div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <title>Available Trips</title>
      </head>

      <body>
        <h1>Available Trips</h1>
        <table border="1">
          <thead>
            <tr>
              <th>TripID</th>
              <th>Event Name</th>
              <th>Event Date</th>
              <th>Start Point</th>
              <th>End Point</th>
              <th>Bus Plate Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($trips as $trip): ?>
              <tr>
                <td><?php echo htmlspecialchars($trip['TripID']); ?></td>
                <td><?php echo htmlspecialchars($trip['EventName']); ?></td>
                <td><?php echo htmlspecialchars($trip['EventDate']); ?></td>
                <td><?php echo htmlspecialchars($trip['StartPoint']); ?></td>
                <td><?php echo htmlspecialchars($trip['EndPoint']); ?></td>
                <td><?php echo htmlspecialchars($trip['PlateNumber']); ?></td>
                <td>
                  <a href="reservation.php?id=<?php echo $trip['TripID']; ?>">Reserve</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="row">
  </section>

  <footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About SUTSwift</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Information</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">About</a></li>
              <li><a href="#" class="py-2 d-block">Services</a></li>
              <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
              <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
              <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Customer Support</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">FAQ</a></li>
              <li><a href="#" class="py-2 d-block">Payment Option</a></li>
              <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
              <li><a href="#" class="py-2 d-block">How it works</a></li>
              <li><a href="#" class="py-2 d-block">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="index.php" target="_blank">Bakisena</a>
          </p>
        </div>
      </div>
    </div>
  </footer>


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/scrollax.min.js"></script>
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
  <script src="js/main.js"></script>

</body>

</html>