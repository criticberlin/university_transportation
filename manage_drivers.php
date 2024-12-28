<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php';

// Fetch users of type "Student"
$stmt = $pdo->query("SELECT * FROM Users WHERE UserType = 'Driver'");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUTSwift - Manage Drivers</title>
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
    <link rel="icon" type="image/png" href="images/SUTlogo.png">
    
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
            background: #ff6952;
            color: #fff;
            border: none;
        }
        .table-custom td {
            border-color: rgba(255, 255, 255, 0.1);
        }
        .btn-custom {
            background: #ff6952;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background: #ff6952;
            color: #fff;
        }
    </style>
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
                    <h1 class="mb-4">Manage Users</h1>
                    <p style="font-size: 18px;">Manage student accounts and their information</p>
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
                                <th>UserID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Date Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr data-userid="<?php echo $user['UserID']; ?>">
                                    <td><?php echo htmlspecialchars($user['UserID']); ?></td>
                                    <td contenteditable="false" class="user-name">
                                        <?php echo htmlspecialchars($user['FullName']); ?>
                                    </td>
                                    <td contenteditable="false" class="user-email">
                                        <?php echo htmlspecialchars($user['Email']); ?>
                                    </td>
                                    <td contenteditable="false" class="user-phone">
                                        <?php echo htmlspecialchars($user['PhoneNumber']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['DateJoined']); ?></td>
                                    <td>
                                        <a href="delete_user.php?id=<?php echo $user['UserID']; ?>" 
                                           onclick="return confirm('Are you sure you want to delete this user?')" 
                                           class="btn btn-custom">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a class="btn btn-custom mr-2" href="add_user.php">Add New User</a>
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
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart SutSwift Team" aria-hidden="true"></i> by <a href="https://sut.edu.eg/" target="_blank">SutSwift Team</a>
    </p>
          </div>
        </div>
      </div>
    </footer>


    <!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>



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
        const editableCells = row.querySelectorAll('.user-name, .user-email, .user-phone');
        editableCells.forEach(cell => {
            cell.contentEditable = 'true';
            cell.classList.add('editable');
        });
    }

    function makeCellsUneditable(row) {
        const editableCells = row.querySelectorAll('.user-name, .user-email, .user-phone');
        editableCells.forEach(cell => {
            cell.contentEditable = 'false';
            cell.classList.remove('editable');
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && selectedRow) {
            event.preventDefault();
            const userId = selectedRow.dataset.userid;
            const fullName = selectedRow.querySelector('.user-name').textContent.trim();
            const email = selectedRow.querySelector('.user-email').textContent.trim();
            const phone = selectedRow.querySelector('.user-phone').textContent.trim();

            fetch('update_user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId, fullName, email, phone })
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