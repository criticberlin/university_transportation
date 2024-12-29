<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Driver') {
    header("Location: login.html");
    exit();
}

include 'db.php';

$driverID = $_SESSION['UserID'];

// Fetch messages
$stmt = $pdo->prepare("
    SELECT 
        C.MessageID,
        C.SenderID,
        C.MessageText,
        C.SentDate,
        U.FullName AS SenderName,
        U.Email AS SenderEmail
    FROM Communication C
    INNER JOIN Users U ON C.SenderID = U.UserID
    WHERE C.ReceiverID = ?
    ORDER BY C.SentDate DESC
");
$stmt->execute([$driverID]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_message'], $_POST['message_id'], $_POST['sender_id'])) {
    $replyMessage = trim($_POST['reply_message']);
    $messageID = (int)$_POST['message_id'];
    $senderID = (int)$_POST['sender_id'];

    if (!empty($replyMessage)) {
        $stmt = $pdo->prepare("
            INSERT INTO Communication (SenderID, ReceiverID, MessageText, SentDate)
            VALUES (?, ?, ?, NOW())
        ");
        if ($stmt->execute([$driverID, $senderID, $replyMessage])) {
            $success = "Reply sent successfully.";
            // Refresh messages after sending reply
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error = "Failed to send the reply.";
        }
    } else {
        $error = "Reply message cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUTSwift - Messages</title>
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
                    <li class="nav-item"><a href="drivers.php" class="nav-link">Back to Dashboard</a></li>
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
                        <h1 class="mb-4">Messages</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($messages)): ?>
                                <p class="text-center">No messages found.</p>
                            <?php else: ?>
                                <?php foreach ($messages as $message): ?>
                                    <div class="message-container mb-4 p-3 border rounded">
                                        <div class="message-header d-flex justify-content-between">
                                            <strong><?= htmlspecialchars($message['SenderName']) ?></strong>
                                            <small><?= htmlspecialchars($message['SentDate']) ?></small>
                                        </div>
                                        <div class="message-body my-2">
                                            <?= nl2br(htmlspecialchars($message['MessageText'])) ?>
                                        </div>
                                        <div class="message-footer">
                                            <button class="btn btn-sm btn-primary reply-btn" 
                                                    onclick="showReplyForm(<?= $message['MessageID'] ?>, <?= $message['SenderID'] ?>)">
                                                Reply
                                            </button>
                                        </div>
                                        <div id="reply-form-<?= $message['MessageID'] ?>" class="reply-form mt-3" style="display: none;">
                                            <form method="POST" action="">
                                                <input type="hidden" name="message_id" value="<?= $message['MessageID'] ?>">
                                                <input type="hidden" name="sender_id" value="<?= $message['SenderID'] ?>">
                                                <div class="form-group">
                                                    <textarea name="reply_message" class="form-control" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Send Reply</button>
                                                <button type="button" class="btn btn-secondary" 
                                                        onclick="hideReplyForm(<?= $message['MessageID'] ?>)">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
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
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg></div>

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
    
    <script>
    function showReplyForm(messageId, senderId) {
        document.getElementById('reply-form-' + messageId).style.display = 'block';
    }

    function hideReplyForm(messageId) {
        document.getElementById('reply-form-' + messageId).style.display = 'none';
    }
    </script>
</body>
</html>