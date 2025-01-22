<?php
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Execute the query
$sql = "SELECT t.TripID, r.StartPoint, r.EndPoint, b.PlateNumber, t.EventName, t.EventDate, t.Description
        FROM Trips t
        JOIN Routes r ON t.RouteID = r.RouteID
        JOIN Buses b ON t.BusID = b.BusID";
$result = $pdo->query($sql);

if (!$result) {
    die("Error executing query: " . $pdo->errorInfo()[2]);
}

// Fetch all rows and assign to $trips
$trips = $result->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bakisena - Manage Trips</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <!-- Template CSS -->
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

    <!-- Custom styles -->
    <style>
        .editable {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
        }

        .table-custom {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom th {
            background: rgb(255, 34, 0);
            color: #fff;
            border: none;
        }

        .table-custom td {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .btn-custom {
            background: rgb(255, 34, 0);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: rgb(143, 19, 0);
            color: #fff;
        }
    </style>
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
                        <h1 class="mb-4">Manage Trips</h1>
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
                                    <a href="view_reports.php" class="btn btn-admin btn-lg btn-block d-flex align-items-center justify-content-between">
                                        <span><i class="icon-cog mr-2"></i>View Reports</span>
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
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Trip ID</th>
                                    <th>StartPoint</th>
                                    <th>EndPoint</th>
                                    <th>Bus</th>
                                    <th>Event Name</th>
                                    <th>Event Date</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trips as $trip): ?>
                                    <tr data-tripid="<?php echo $trip['TripID']; ?>">
                                        <td><?php echo htmlspecialchars($trip['TripID']); ?></td>
                                        <td contenteditable="false" class="user-name">
                                            <?php echo htmlspecialchars($trip['StartPoint']); ?>
                                        </td>
                                        <td contenteditable="false" class="user-email">
                                            <?php echo htmlspecialchars($trip['EndPoint']); ?>
                                        </td>
                                        <td contenteditable="false" class="user-phone">
                                            <?php echo htmlspecialchars($trip['PlateNumber']); ?>
                                        </td>
                                        <td contenteditable="false" class="user-3">
                                            <?php echo htmlspecialchars($trip['EventName']); ?>
                                        </td>
                                        <td contenteditable="false" class="user-4">
                                            <?php echo htmlspecialchars($trip['EventDate']); ?>
                                        </td>
                                        <td contenteditable="false" class="user-5">
                                            <?php echo htmlspecialchars($trip['Description']); ?>
                                        </td>
                                        <td>
                                            <a href="delete_trip.php?id=<?php echo $trip['TripID']; ?>"
                                                onclick="return confirm('Are you sure you want to delete this Trip?')"
                                                class="btn btn-custom">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <a class="btn btn-custom mr-2" href="add_event_type.php">Add New Event Type</a>
                    </div>
                    <div class="text-center mt-4">
                        <a class="btn btn-custom mr-2" href="add_trip.php">Add New Trip</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">About Bakisena</h2>
                        <p>Our Smart Parking System ensures you find the best parking spots quickly and efficiently. No more circling around looking for space!</p>
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
                                <li><span class="icon icon-map-marker"></span><span class="text">6PM4+7C, Cairo Governorate Desert, Al-Sharqia Governorate 7060010</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 010 70919637</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">hesham.sakr@sut.edu.eg</span></a></li>
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



    <!-- Scripts -->
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

    <!-- User Management Scripts -->
    <script>
        const table = document.querySelector('table');
        let selectedRow = null;

        table.addEventListener('click', (event) => {
            const cell = event.target.closest('td');
            const row = cell?.closest('tr');

            if (row && cell.hasAttribute('contenteditable')) {
                if (selectedRow) {
                    makeCellsUneditable(selectedRow);
                }
                selectedRow = row;
                makeCellsEditable(selectedRow);
                cell.focus();
            }
        });

        function makeCellsEditable(row) {
            const editableCells = row.querySelectorAll('.user-name, .user-email, .user-phone, .user-5, .user-4, .user-3');
            editableCells.forEach(cell => {
                cell.contentEditable = 'true';
                cell.classList.add('editable');
            });
        }

        function makeCellsUneditable(row) {
            const editableCells = row.querySelectorAll('.user-name, .user-email, .user-phone, .user-5, .user-4, .user-3');
            editableCells.forEach(cell => {
                cell.contentEditable = 'false';
                cell.classList.remove('editable');
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && selectedRow) {
                event.preventDefault();
                const TripId = selectedRow.dataset.userid;
                const StartPoint = selectedRow.querySelector('.user-name').textContent.trim();
                const EndPoint = selectedRow.querySelector('.user-email').textContent.trim();
                const PlateNumber = selectedRow.querySelector('.user-phone').textContent.trim();
                const description = selectedRow.querySelector('.user-5').textContent.trim();
                const eventDate = selectedRow.querySelector('.user-4').textContent.trim();
                const eventName = selectedRow.querySelector('.user-3').textContent.trim();

                fetch('edit_trip.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            userId,
                            fullName,
                            email,
                            phone
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Changes saved successfully!');
                            makeCellsUneditable(selectedRow);
                        } else {
                            alert(`Error: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Error saving changes.');
                    });
            }
        });
    </script>

</body>

</html>